<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MS\GestionBibliothequeBundle\Entity\Adherent;
use Symfony\Component\HttpFoundation\Request;
use MS\GestionBibliothequeBundle\Form\AdherentSearchType;
use MS\GestionBibliothequeBundle\Form\AdherentEditType;
use MS\GestionBibliothequeBundle\Form\AdherentAddType;

class GestionnaireController extends Controller {
    
    /**
     * Lists all gestionnaire actions.
     *
     */
    public function indexAction() {
        return $this->render('MSGestionBibliothequeBundle:Gestionnaire:index.html.twig', array(
            
        ));
    }
    
    public function searchAdherentAction(Request $request) {
//         $logger = $this->get('logger');
        $adherent = new Adherent();
        $form = $this->get('form.factory')->create(AdherentSearchType::class, $adherent);
        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if($form->isSubmitted() /*&& $form->isValid()*/) {
                if($adherent->getNom() == "" && $adherent->getPrenom() == "" && $adherent->getDateNaissance() == "" 
                    && $adherent->getEmail() == "" && $adherent->getNumCarte() == ""){
                    return $this->render('MSGestionBibliothequeBundle:Adherent:search.html.twig', array(
                        'form' => $form->createView(),
                    ));
                }
                $findFilter = array();
                if(!empty($adherent->getNom())) { $findFilter['nom'] = $adherent->getNom(); }
                if(!empty($adherent->getPrenom())) { $findFilter['prenom'] = $adherent->getPrenom(); }
                if(!empty($adherent->getDateNaissance())) { $findFilter['dateNaissance'] = $adherent->getDateNaissance(); }
                if(!empty($adherent->getEmail())) { $findFilter['email'] = $adherent->getEmail(); }
                if(!empty($adherent->getNumCarte())) { $findFilter['numCarte'] = $adherent->getNumCarte(); }
                $em = $this->getDoctrine()->getManager();
                $adherents = $em->getRepository('MSGestionBibliothequeBundle:Adherent')->findBy($findFilter);
            }
            $request->getSession()->getFlashBag()->add('notice', "Recherche d'adhérent(s) effectuée.");
            
            return $this->render('MSGestionBibliothequeBundle:Adherent:search_results.html.twig',
                array('listeAdherents' => $adherents));
        }
        return $this->render('MSGestionBibliothequeBundle:Adherent:search.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * Recherche de reservations selon differents criteres
     * - oeuvre
     * - adherent
     * - demande de reservation en cours
     * - reservation en cours
     * - reservation annulee
     * - reservation terminee (oeuvre empruntée)
     */
    public function searchReservationAction(Request $request) {
        
        return $this->render('');
    }
    
    public function addAdherentAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $adherent = new Adherent();
        $form = $this->get('form.factory')->create(AdherentAddType::class, $adherent);
        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if($form->isSubmitted() /*&& $form->isValid()*/) {
                if(empty($adherent->getNom()) || empty($adherent->getPrenom())                  /* || empty($adherent->getDateNaissance()) */
                    || empty($adherent->getEmail()) || empty($adherent->getNumCarte())) {
                        return $this->render('MSGestionBibliothequeBundle:Adherent:add.html.twig', array(
                            'form' => $form->createView(),
                        ));
                }
                $em->persist($adherent);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', "Ajout de l'adhérent effectué.");
                return $this->render('MSGestionBibliothequeBundle:Adherent:saved.html.twig');
            }
        }
        return $this->render('MSGestionBibliothequeBundle:Adherent:add.html.twig',
            array('form' => $form->createView()));
    }
    
    public function editAdherentAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('MSGestionBibliothequeBundle:Adherent');
        $adherent = $repo->find($id);
        $form = $this->get('form.factory')->create(AdherentEditType::class, $adherent);
        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if($form->isSubmitted() /*&& $form->isValid()*/) {
                if($adherent->getNom() == "" && $adherent->getPrenom() == "" && $adherent->getDateNaissance() == ""
                    && $adherent->getEmail() == "" && $adherent->getNumCarte() == ""){
                        return $this->render('MSGestionBibliothequeBundle:Adherent:edit.html.twig', array(
                            'form' => $form->createView(),
                        ));
                }
                $em->persist($adherent);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', "Modification de l'adhérent effectuée.");
                return $this->render('MSGestionBibliothequeBundle:Adherent:saved.html.twig');
            }
        }
        return $this->render('MSGestionBibliothequeBundle:Adherent:edit.html.twig',
            array('form' => $form->createView()));
    }
}