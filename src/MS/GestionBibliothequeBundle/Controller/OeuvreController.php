<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OeuvreController extends Controller {
    
    public function indexAction(SessionInterface $session) {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if(!is_string($user)) {
            if(in_array("ROLE_GESTIONNAIRE", $user->getRoles())) {
                $gestionnaire = $em->getRepository('MSGestionBibliothequeBundle:Gestionnaire')->findOneBy(array('userCredentials' => $user));
                // si user == anonymous, alors adherent vaut null
                $session->set('gestionnaire', $gestionnaire);
            }
            else {
                $adherent = $em->getRepository('MSGestionBibliothequeBundle:Adherent')->findOneBy(array('userCredentials' => $user));
                // si user == anonymous, alors adherent vaut null
                $session->set('adherent', $adherent);
            }
        }
        
        $livres = $em->getRepository('MSGestionBibliothequeBundle:Livre')
                      ->findByDatePublication(5);
        $dvds = $em->getRepository('MSGestionBibliothequeBundle:DVD')
                      ->findByDatePublication(5);

        return $this->render('MSGestionBibliothequeBundle:Oeuvre:index.html.twig',
            array('listeLivres' => $livres,
                  'listeDVDs' => $dvds
            )
            );
    }
    
    
}
