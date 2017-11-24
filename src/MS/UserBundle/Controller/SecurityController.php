<?php
namespace MS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function loginAction(Request $request) {
        $logger = $this->get('logger');
        $logger->debug("Entrée dans la fonction loginAction");
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
//         if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
//             return $this->render('MSGestionBibliothequeBundle:Gestionnaire:index.html.twig');
            if ($this->get('security.authorization_checker')->isGranted('ROLE_GESTIONNAIRE')) {
                //          $user = $this->get('security.token_storage')->getToken()->getUser();
                return $this->redirectToRoute('g2_ms_gestion_bibliotheque_gestionnaire_index');
            }
            else {
//                 return $this->redirectToRoute('g2_ms_gestion_bibliotheque_home');
            }
//         }
        // Le service authentication_utils permet de récupérer le nom d'utilisateur
        // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
        // (mauvais mot de passe par exemple)
        $authenticationUtils = $this->get('security.authentication_utils');
        
        return $this->render('MSUserBundle:Security:login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }
}
