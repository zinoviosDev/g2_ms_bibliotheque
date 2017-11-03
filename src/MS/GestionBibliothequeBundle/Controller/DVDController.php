<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DVDController extends Controller {
    
    public function viewAction($id) {
        $repository = $this->getDoctrine()->getManager()
            ->getRepository('MSGestionBibliothequeBundle:DVD');
        $dvd = $repository->find($id);
        if (null === $dvd) {
            throw new NotFoundHttpException("Le dvd d'id ".$id." n'existe pas.");
        }
        
        return $this->render('MSGestionBibliothequeBundle:DVD:view.html.twig',
            array('dvd' => $dvd
            )
        );
    }
}

