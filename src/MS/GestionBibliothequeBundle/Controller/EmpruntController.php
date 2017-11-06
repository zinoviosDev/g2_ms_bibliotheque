<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use MS\GestionBibliothequeBundle\Entity\Emprunt;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class EmpruntController extends Controller {
    
    public function indexAction() {
        
        $content = $this->get('templating')->render('MSGestionBibliothequeBundle:Emprunt:index.html.twig');
        
        return new Response($content);
    }
    
    public function viewAction($id) {
        return new Response("Affichage de l'emprunt d'id : ".$id);
    }
    
    public function addAction($id) {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_AUTEUR')) {
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
            $em = $this->getDoctrine()->getManager();
            $livreRepository = $em->getRepository('MSGestionBibliothequeBundle:Livre');
            $livre = $livreRepository->find($id);
            if (null === $livre) {
                throw new NotFoundHttpException("Le livre d'id ".$id." n'existe pas.");
            }
            $exemplaires = $livre->getExemplaires();
            $exemplaireRepository = $em->getRepository('MSGestionBibliothequeBundle:Livre');
            foreach($exemplaires as $ex) {
                $empruntsEnCours = $ex->empruntsEnCours($ex);
                if(count($empruntsEnCours) == 0) {
                    $emprunt = new Emprunt();
                    $emprunt->setAdherent();
                    $emprunt->setExemplaire($ex);
                    $emprunt->setDateEmprunt(new  \DateTime());
                    $emprunt->setDateRetourTheorique('dateEmprunt+15');
                    $emprunt->setOeuvre($ex->getOeuvre());
                }
                break;
            }
        }
        else {
            // erreur adherent inconnu
        }
        
        return new Response("Ajout de l'emprunt d'id : ".$id);
    }
}
