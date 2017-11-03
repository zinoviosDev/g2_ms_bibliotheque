<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class OeuvreController extends Controller {
    
    public function indexAction() {
        $content = $this->get('templating')->render('MSGestionBibliothequeBundle:Oeuvre:index.html.twig',
            array('listOeuvres' => array())
        );
        return new Response($content);
    }
    
    public function viewAction($id) { 
        return $this->render('MSGestionBibliothequeBundle:Oeuvre:view.html.twig', array(
            'id' => $id
        ));
    }
}
