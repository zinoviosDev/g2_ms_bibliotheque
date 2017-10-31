<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EmpruntController extends Controller {
    
    public function indexAction() {
        
        $content = $this->get('templating')->render('MSGestionBibliothequeBundle:Emprunt:index.html.twig');
        
        return new Response($content);
    }
    
    public function viewAction($id) {
        return new Response("Affichage de l'emprunt d'id : ".$id);
    }
}
