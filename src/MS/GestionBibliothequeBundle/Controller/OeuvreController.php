<?php namespace MS\GestionBibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use MS\GestionBibliothequeBundle\Entity\Livre;
use MS\GestionBibliothequeBundle\Entity\Auteur;


class OeuvreController extends Controller {
    
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
       $oeuvres = $em->getRepository('MSGestionBibliothequeBundle:Oeuvre')->findAll();
       $oeuvresArray = array();
       $uneOeuvre = new Livre();
       $unAuteur = new Auteur();
       $unAuteur->setPrenom("Henri");
       $unAuteur->setNom("Dufresnes");
       $unAuteur->setDateNaissance(date_create_from_format("d/m/Y", "16/08/2002"));
       $arrayFields = array(
           array(
               "Id" => 1,
               "Titre" => "Mon Titre",
               "Sujet" => "Mon Sujet",
               "DateDePublication" => date_create_from_format("d/m/Y", "16/08/2002"),
               "Langue" => "Ma Langue",
               "Isbn" => "Mon ISBN",
               "NbrePages" => 1000,
               "Description" => "La la la la la",
               "Resume" => "aaaaaaaaaaaaaaaaaaaaaaaaa",
               "Format" => "4096x2000",
               "Auteur" => $unAuteur
           )
       );
       $uneOeuvre->hydrate($arrayFields);
       array_push($oeuvresArray, $uneOeuvre);
        return $this->render('MSGestionBibliothequeBundle:Oeuvre:index.html.twig',
            array('listeOeuvres' => $oeuvres)
        );
    }
    
    public function viewAction($id) { 
        return $this->render('MSGestionBibliothequeBundle:Oeuvre:view.html.twig', array(
            'id' => $id
        ));
    }
}
