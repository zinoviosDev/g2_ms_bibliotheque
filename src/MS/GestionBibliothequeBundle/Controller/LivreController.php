<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use MS\GestionBibliothequeBundle\Entity\Livre;
use MS\GestionBibliothequeBundle\Form\LivreType;
use MS\GestionBibliothequeBundle\Entity\Exemplaire;
use MS\GestionBibliothequeBundle\Entity\Reservation;

class LivreController extends Controller {
    
    public function findAction(Request $request) {
        $logger = $this->get('logger');
        $livre = new Livre();
        $form = $this->get('form.factory')->create(LivreType::class, $livre);
        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if($form->isSubmitted() /*&& $form->isValid()*/) {
                if($livre->getTitre() == "" && $livre->getIsbn() == "" && $livre->getAuteur() == null){
                    return $this->render('MSGestionBibliothequeBundle:Livre:find.html.twig', array(
                        'form' => $form->createView(),
                    ));
                }
                $em = $this->getDoctrine()->getManager();
                $livres = $em->getRepository('MSGestionBibliothequeBundle:Livre')
                ->findByMultiCriteres($livre);
            }
            $request->getSession()->getFlashBag()->add('notice', 'Recherche par titre ou auteur effectuée.');
            
            return $this->render('MSGestionBibliothequeBundle:Livre:find_results.html.twig',
                array('listeLivres' => $livres));
        }
        return $this->render('MSGestionBibliothequeBundle:Livre:find.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function viewAction($id) {
        $logger = $this->get('logger');
        $em = $this->getDoctrine()->getManager();
        $livreRepository = $em->getRepository('MSGestionBibliothequeBundle:Livre');
        $livre = $livreRepository->find($id); // requete ok
        if (null === $livre) {
            throw new NotFoundHttpException("Le livre d'id ".$id." n'existe pas.");
        }
        $exemplaires = $livre->getExemplaires(); // requete ok
        $nbreExemplaires = count($exemplaires);
        $exFilter = new Exemplaire();
        $exFilter->setOeuvre($livre);
        $reservationRepo = $em->getRepository('MSGestionBibliothequeBundle:Reservation');
        $reservationFilter = new Reservation();
        $reservationFilter->setOeuvre($livre);
        $reservationFilter->setSuiteReservation(Reservation::SUITE_RESERVATION_RESERVE);
        $nbreReservationsEnCoursSurReservation = $reservationRepo->countByEtatReservationForAllAdherents($reservationFilter)[1];
        $reservationFilter->setSuiteReservation(Reservation::SUITE_RESERVATION_EMPRUNT); // reserve ou emprunt
        $nbreEmpruntsEnCoursSurReservation = $reservationRepo->countByEtatReservationForAllAdherents($reservationFilter)[1];
        $nbreExemplairesDisponibles = $nbreExemplaires - ($nbreReservationsEnCoursSurReservation + $nbreEmpruntsEnCoursSurReservation);
        
        return $this->render('MSGestionBibliothequeBundle:Livre:view.html.twig',
            array('livre' => $livre,
                'nbreExemplaires' => $nbreExemplaires,
                'nbreExemplairesDisponibles' => $nbreExemplairesDisponibles
            )
        );
    }
}

