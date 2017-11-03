<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LivreController extends Controller {
    
    public function viewAction($id) {
        $repository = $this->getDoctrine()->getManager()
            ->getRepository('MSGestionBibliothequeBundle:Livre');
        $livre = $repository->find($id);
        if (null === $livre) {
            throw new NotFoundHttpException("Le livre d'id ".$id." n'existe pas.");
        }
        
        return $this->render('MSGestionBibliothequeBundle:Livre:view.html.twig',
            array('livre' => $livre
            )
        );
    }
}

