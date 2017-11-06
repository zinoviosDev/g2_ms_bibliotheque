<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use MS\GestionBibliothequeBundle\Entity\Livre;
use MS\GestionBibliothequeBundle\Form\LivreType;
use MS\GestionBibliothequeBundle\Entity\Exemplaire;

class LivreController extends Controller {
    
    public function findAction(Request $request) {
        $logger = $this->get('logger');
        $livre = new Livre();
        $form = $this->get('form.factory')->create(LivreType::class, $livre);
        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $livres = $em->getRepository('MSGestionBibliothequeBundle:Livre')
                ->findByMultiCriteres($livre);
            }
            $request->getSession()->getFlashBag()->add('notice', 'Recherche par titre ou auteur effectuée.');
            
            return $this->render('MSGestionBibliothequeBundle:Livre:find_results.html.twig',
                array('listeLivres' => $livres));
        }
        return $this->render('MSGestionBibliothequeBundle:Livre:find.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function viewAction($id) {
        $em = $this->getDoctrine()->getManager();
        $livreRepository = $em->getRepository('MSGestionBibliothequeBundle:Livre');
        $livre = $livreRepository->find($id);
        if (null === $livre) {
            throw new NotFoundHttpException("Le livre d'id ".$id." n'existe pas.");
        }
        $exemplaires = $livre->getExemplaires();
        $nbreExemplaires = count($exemplaires);
        $ex = new Exemplaire();
        $ex->setOeuvre($livre);
        $empruntsEchus = $em->getRepository('MSGestionBibliothequeBundle:Exemplaire')->findEmpruntsEchus($ex);
        $emprunts = $em->getRepository('MSGestionBibliothequeBundle:Exemplaire')->findAllEmprunts();
        $nbreExemplairesDisponibles = $nbreExemplaires - (count($emprunts) - count($empruntsEchus));
        return $this->render('MSGestionBibliothequeBundle:Livre:view.html.twig',
            array('livre' => $livre,
                'nbreExemplaires' => $nbreExemplaires,
                'nbreExemplairesDisponibles' => $nbreExemplairesDisponibles
            )
        );
    }
}

