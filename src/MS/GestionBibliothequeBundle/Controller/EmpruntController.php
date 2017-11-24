<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use MS\GestionBibliothequeBundle\Entity\Emprunt;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use MS\GestionBibliothequeBundle\Entity\Adherent;

class EmpruntController extends Controller {
    
    public function indexAction() {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADHERENT')) {
            throw new AccessDeniedException('Accès limité aux adhérents.');
        }
        $user = $this->getUser();
        $adherent = null;
        if (null === $user) {
            throw new AccessDeniedException('Accès limité aux adhérents.');
        } else {
            $adherent = $user->getAdherent();
        }
        return $this->render('MSGestionBibliothequeBundle:Emprunt:index.html.twig', array(
            'emprunts' => $adherent->getEmprunts(),
        ));
    }
    
    public function viewAction($id) {
        return new Response("Affichage de l'emprunt d'id : ".$id);
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
            $adherent = $user->getAdherent();
        }
        if(null != $adherent->getId()) {
            // on vérifie que l'adhérents n'a pas atteint la limite d'emprunts autorises
            // sinon on lui affiche un message d'erreur
            $nbreEmpruntsEnCoursAdherent = count($adherent->getEmprunts());
            if( $nbreEmpruntsEnCoursAdherent >= $adherent->getNbreEmpruntsAuthorises()) {
                return $this->render('MSGestionBibliothequeBundle:Emprunt:index.html.twig', array(
                    'nbreEmpruntsEnCours' => $nbreEmpruntsEnCoursAdherent,
                    'adherent' => $adherent
                ));
            }
            $em = $this->getDoctrine()->getManager();
            $livreRepository = $em->getRepository('MSGestionBibliothequeBundle:Livre');
            $livre = $livreRepository->find($id);
            if (null === $livre) {
                throw new NotFoundHttpException("Le livre d'id ".$id." n'existe pas.");
            }
            
            $exemplaires = $livre->getExemplaires();
            $exemplaireRepository = $em->getRepository('MSGestionBibliothequeBundle:Exemplaire');
            $emprunt = new Emprunt();
            $exAvecEmpruntEnCoursArray = array();
            foreach($exemplaires as $ex) {
                $empruntsEnCours = $exemplaireRepository->getEmpruntsEnCours($ex); // une seule valeur attendue
                array_push($exAvecEmpruntEnCoursArray, $empruntsEnCours);
                if(count($empruntsEnCours) == 0) {
                    $emprunt->setAdherent($adherent);
                    $emprunt->setExemplaire($ex);
                    $emprunt->setDateEmprunt(new  \DateTime());
                    $logger->debug("date d'emprunt setter = " . $emprunt->getDateEmprunt()->format("d/m/Y"));
                    $dateRetourTheorique = $emprunt->getDateEmprunt();
                    $dateRetourTheorique = new  \DateTime();
                    $dateRetourTheorique->add(new \DateInterval('P15D'));
                    $logger->debug("date de retour théorique + 15 jours = " . $dateRetourTheorique->format("d/m/Y"));
                    $emprunt->setDateRetourTheorique($dateRetourTheorique);
                    $logger->debug("emprunt->getDateRetourTheorique = " . $emprunt->getDateRetourTheorique()->format("d/m/Y"));
                    $emprunt->setOeuvre($ex->getOeuvre());
                    $adherent->addEmprunt($emprunt);
                    $em->persist($emprunt);
                    $em->persist($adherent);
                    $em->flush();
                    return $this->render('MSGestionBibliothequeBundle:Emprunt:index.html.twig', array(
                        'nbreEmpruntsEnCours' => $nbreEmpruntsEnCoursAdherent,
                        'emprunts' => $adherent->getEmprunts(),
                        'empruntAjoute' => $emprunt
                    ));
                }
                // a ce stade, l'emprunt n'a pu etre ajoute car aucun exemplaire n'est disponible (ts ont des emprunts en cours)
                // on averti l'utilisateur et on l'informe de la date de premiere disponiblite d'un exemplaire
                $premiereDateDispo = $exAvecEmpruntEnCoursArray[0]->getEmprunts[0]->getDateRetourTheorique();
                foreach ($exAvecEmpruntEnCoursArray as $exEmprt) {
                    $exEmprt->getEmprunts();
                    foreach ($mesEmprunts as $monEmprunt) {
                        if($monEmprunt->getDateRetourTheorique() < $premiereDateDispo) {
                            $premiereDateDispo = $monEmprunt->getDateRetourTheorique();
                        }
                    }
                }
                
                return $this->render('MSGestionBibliothequeBundle:Emprunt:index.html.twig', array(
                    'nbreEmpruntsEnCours' => $nbreEmpruntsEnCoursAdherent,
                    'emprunts' => $adherent->getEmprunts(),
                    'premiereDateDispo' => $premiereDateDispo
                ));
            }
            
        }
        else {
            throw new ServiceNotFoundException('Un problème a été constaté lors de la recherche de vos informations.');
        }
        
        
        return $this->render('MSGestionBibliothequeBundle:Emprunt:index.html.twig', array(
//             'form' => $form->createView(),
        ));
    }
}
