<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MS\GestionBibliothequeBundle\Entity\Reservation;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReservationController extends Controller {
    
    public function indexAction() {
        $content = $this->get('templating')->render('MSGestionBibliothequeBundle:Reservation:index.html.twig',
            array('listReservations' => array())
        );
        return new Response($content);
    }
    
    public function viewAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('MSGestionBibliothequeBundle:Reservation');
        $reservation = $repository->find($id);
        if(null === $reservation) {
            throw new NotFoundHttpException("La réservation d'id ".$id." n'existe pas.");
        }       
        return $this->render('MSGestionBibliothequeBundle:Reservation:view.html.twig', array(
            'reservation' => $reservation
        ));
    }
    
    public function annulationAction($id) {
        return $this->render('MSGestionBibliothequeBundle:Reservation:annulation.html.twig', array(
            'id' => $id
        ));
    }
    
    public function addAction(Request $request) {
        $reservation = new Reservation();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $reservation);
        $formBuilder->add('dateReservation', DateType::class)
                    ->add('save', SubmitType::class)
        ;
        $form = $formBuilder->getForm();
        /* $fields = array(
            "DateReservation" => date_create_from_format("d/m/Y", "16/08/2002")
        );
        $reservation->hydrate($fields);
        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->flush(); */
        
        if ($request->isMethod('POST')) {            
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            // Puis on redirige vers la page de visualisation de cettte annonce
            return $this->redirectToRoute('g2_ms_gestion_bibliotheque_reservations_view', array('id' => 5));
        }
        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('MSGestionBibliothequeBundle:Reservation:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
