<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MS\GestionBibliothequeBundle\Entity\Reservation;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ReservationController extends Controller {
    
    public function indexAction() {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADHERENT')) {
            throw new AccessDeniedException('Accès limité aux adhérents.');
        }
        $user = $this->getUser();
        $adherent = null;
        if (null === $user) {
            throw new AccessDeniedException('Accès limité aux adhérents.');
        } else {
            $adherent = $this->getDoctrine()->getManager()->getRepository('MSGestionBibliothequeBundle:Adherent')->findOneBy(array('userCredentials' => $user));
        }
        return $this->render('MSGestionBibliothequeBundle:Reservation:index.html.twig', array(
            'reservations' => $adherent->getReservations(),
        ));
    }
    
    public function viewAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('MSGestionBibliothequeBundle:Reservation');
        $reservation = $repository->find($id);
        if(null === $reservation) {
            throw new NotFoundHttpException("La réservation d'id ".$id." n'existe pas.");
        }       
        return $this->render('MSGestionBibliothequeBundle:Reservation:view.html.twig', array(
            'reservation' => $reservation
        ));
    }
    
    public function annulationAction($id) {
        return $this->render('MSGestionBibliothequeBundle:Reservation:annulation.html.twig', array(
            'id' => $id
        ));
    }
    
    public function addAction($id) {
        $logger = $this->get('logger');
        $logger->info("Entrée dans la méthode addAction");
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADHERENT')) {
            throw new AccessDeniedException('Accès limité aux adhérents.');
        }
        $user = $this->getUser();
        $adherent = null;
        if (null === $user) {
            throw new AccessDeniedException('Accès limité aux adhérents.');
        } else {
            $adherent = $this->getDoctrine()->getManager()->getRepository('MSGestionBibliothequeBundle:Adherent')->findOneBy(array('userCredentials' => $user));
        }
        dump($adherent);
        // 0. Si l'adhérent a 10 réservations non suivies d'emprunt, il ne peut plus réserver TODO plus tard
        // 1. si l'adherent a atteind le nombre d'emprunts max. -> return message d'alerte
        $nbreReservationsAdherent = count($adherent->getReservations());
        if($nbreReservationsAdherent >= $adherent->getNbreReservationsAutorisees()) {
            return $this->render('MSGestionBibliothequeBundle:Reservation:erreur.html.twig', array(
                'message' => "Vous avez atteind le nombre de réservations autorisées"
            ));
        }
        // 2. si l'adhérent a déjà réservé ou emprunté un exemplaire de l'ouvrage, -> return message d'alerte
        $em = $this->getDoctrine()->getManager();
        $livreRepository = $em->getRepository('MSGestionBibliothequeBundle:Livre');
        $livre = $livreRepository->find($id);
        if (null === $livre) {
            throw new NotFoundHttpException("Le livre d'id ".$id." n'existe pas.");
        }
        //$adherent->getReservations(); // réservation avec état en cours
        $reservationRepo = $em->getRepository('MSGestionBibliothequeBundle:Reservation');
        $reservationFilter = new Reservation();
        $reservationFilter->setAdherent($adherent);
        $reservationFilter->setOeuvre($livre);
        $reservationFilter->setSuiteReservation(Reservation::SUITE_RESERVATION_EMPRUNT); // reserve ou emprunt
        $nbreEmpruntsEnCoursSurReservation = $reservationRepo->countByEtatReservation($reservationFilter)[1];
        $reservationFilter->setSuiteReservation(Reservation::SUITE_RESERVATION_RESERVE); 
        $nbreReservationsEnCoursSurReservation = $reservationRepo->countByEtatReservation($reservationFilter)[1];
        if($nbreReservationsEnCoursSurReservation >= 1) {
            return $this->render('MSGestionBibliothequeBundle:Reservation:erreur.html.twig', array(
                'message' => "Vous n'etes pas autorisé(e) à emprunter deux exemplaires de la meme oeuvre"
            ));
        }
        if($nbreEmpruntsEnCoursSurReservation >= 1) {
            return $this->render('MSGestionBibliothequeBundle:Reservation:erreur.html.twig', array(
                'message' => "Vous n'etes pas autorisé(e) à réserver une oeuvre sur laquelle vous avez un emprunt en cours"
            ));
        }
        // 3. l'adhérent réserve
        $reservation = new Reservation();
        //$reservation->setExemplaire($ex);         //TODO attribuer un exemplaire disponible en fonction de certains criteres
                                                    //  au plus simple: si l'exemplaire n'est pas actuellement reservé ou emprunté
        $exemplaireRepository = $em->getRepository('MSGestionBibliothequeBundle:Exemplaire');
        $exemplaires = $livre->getExemplaires();
        foreach ($exemplaires as $exemplaire) {
            $nbEmprunts = $exemplaireRepository->countEmpruntsEnCours($exemplaire)[1];
            $logger->debug("Exemplaire id = ".$exemplaire->getId()." nombre d'emprunts = ".$nbEmprunts);
            $nbRes = $exemplaireRepository->countReservationsEnCours($exemplaire)[1];
            $logger->debug("Exemplaire id = ".$exemplaire->getId()." nombre de réservations = ".$nbRes);
            if($nbEmprunts == 0 && $nbRes == 0) {  //FIXME
                $reservation->setExemplaire($exemplaire);
                break;
            }
        }
        if(null == $reservation->getExemplaire()) {
            return $this->render('MSGestionBibliothequeBundle:Reservation:erreur.html.twig', array(
                'message' => "Tous les exemplaires de cette oeuvre sont déjà réservés ou empruntés"
            ));
        }
        $reservation->setDateDemandeReservation(new \DateTime());
        $reservation->setOeuvre($livre);
        $reservation->setAdherent($adherent);
        $reservation->setSuiteReservation(Reservation::SUITE_RESERVATION_RESERVE);
        $reservation->setDateReservation(new \DateTime());
        $adherent->addReservation($reservation);
        $em->persist($reservation);
        $em->persist($adherent);
        $em->flush();
        return $this->render('MSGestionBibliothequeBundle:Reservation:index.html.twig', array(
            'nbreEmprunts' => $nbreReservationsAdherent,
            'reservations' => $adherent->getReservations()
        ));
        // 4. le gestionnaire voit des réservations (état réservation) et les passe à l'état emprunt
        
        return;
    }
}
