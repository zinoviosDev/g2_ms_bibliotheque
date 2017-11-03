<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OeuvreController extends Controller {
    
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $livres = $em->getRepository('MSGestionBibliothequeBundle:Livre')
                      ->findLivresByDatePublication(3);
        $dvds = $em->getRepository('MSGestionBibliothequeBundle:DVD')
                      ->findDVDByDatePublication(3);

        return $this->render('MSGestionBibliothequeBundle:Oeuvre:index.html.twig',
            array('listeLivres' => $livres,
                  'listeDVDs' => $dvds
            )
            );
    }
}
