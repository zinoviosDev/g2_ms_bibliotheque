<?php

namespace MS\GestionBibliothequeBundle\Controller;

use MS\GestionBibliothequeBundle\Entity\Adherent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Adherent controller.
 *
 * @Route("adherent")
 */
class AdherentController extends Controller
{
    /**
     * Lists all adherent entities.
     *
     * @Route("/", name="adherent_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adherents = $em->getRepository('MSGestionBibliothequeBundle:Adherent')->findAll();

        return $this->render('adherent/index.html.twig', array(
            'adherents' => $adherents,
        ));
    }

    /**
     * Creates a new adherent entity.
     *
     * @Route("/new", name="adherent_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $adherent = new Adherent();
        $form = $this->createForm('MS\GestionBibliothequeBundle\Form\AdherentType', $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($adherent);
            $em->flush();

            return $this->redirectToRoute('adherent_show', array('_ID' => $adherent->get_id()));
        }

        return $this->render('adherent/new.html.twig', array(
            'adherent' => $adherent,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * Creates a new adherent entity and stores it in database
     */
    /*public function saveAdherent() {
        $adherent = new Adherent();
        $adherent->setPrenom("Jules");
        $adherent->setNom("Verne");
        $adherent->setGenre("male");
        $adherent->setEmail("jules.verne@gmail.com");
        $adherent->setNumTelephone("+33607887209");
        $adherent->setNbreEmpruntsAuthorises(10);
        
    }*/

    /**
     * Finds and displays a adherent entity.
     *
     * @Route("/{_ID}", name="adherent_show")
     * @Method("GET")
     */
    public function showAction(Adherent $adherent)
    {
        $deleteForm = $this->createDeleteForm($adherent);

        return $this->render('adherent/show.html.twig', array(
            'adherent' => $adherent,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing adherent entity.
     *
     * @Route("/{_ID}/edit", name="adherent_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Adherent $adherent)
    {
        $deleteForm = $this->createDeleteForm($adherent);
        $editForm = $this->createForm('MS\GestionBibliothequeBundle\Form\AdherentType', $adherent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adherent_edit', array('_ID' => $adherent->get_id()));
        }

        return $this->render('adherent/edit.html.twig', array(
            'adherent' => $adherent,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a adherent entity.
     *
     * @Route("/{_ID}", name="adherent_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Adherent $adherent)
    {
        $form = $this->createDeleteForm($adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($adherent);
            $em->flush();
        }

        return $this->redirectToRoute('adherent_index');
    }

    /**
     * Creates a form to delete a adherent entity.
     *
     * @param Adherent $adherent The adherent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Adherent $adherent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adherent_delete', array('_ID' => $adherent->get_id())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
