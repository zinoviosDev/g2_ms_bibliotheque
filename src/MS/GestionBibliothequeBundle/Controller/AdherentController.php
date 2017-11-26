<?php
namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 *
 * @author marc
 *        
 */
class AdherentController extends Controller {

    public function viewProfilAction($id) {
        $adherent = $this->getDoctrine()->getManager()
                    ->getRepository('MSGestionBibliothequeBundle:Adherent')
                    ->find($id);
        
        return $this->render('MSGestionBibliothequeBundle:Adherent:profil.html.twig',
            array('adherent' => $adherent
            )
            );
    }
}

