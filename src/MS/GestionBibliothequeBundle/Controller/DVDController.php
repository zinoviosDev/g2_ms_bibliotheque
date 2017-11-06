<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use MS\GestionBibliothequeBundle\Entity\DVD;
use MS\GestionBibliothequeBundle\Form\DVDType;

class DVDController extends Controller {
    
    public function findAction(Request $request) {
        $logger = $this->get('logger');
        $dvd = new DVD();
        $form = $this->get('form.factory')->create(DVDType::class, $dvd);
        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $dvds = array();
                $dvds = $em->getRepository('MSGestionBibliothequeBundle:DVD')
                ->findByMultiCriteres($dvd);
            }
            $request->getSession()->getFlashBag()->add('notice', 'Recherche par titre ou auteur effectuée.');
            
            return $this->render('MSGestionBibliothequeBundle:DVD:find_results.html.twig',
                array('listeDVDs' => $dvds));
        }
        return $this->render('MSGestionBibliothequeBundle:DVD:find.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
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

