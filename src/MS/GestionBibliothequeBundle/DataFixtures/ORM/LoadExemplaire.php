<?php
namespace src\MS\GestionBibliothequeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MS\GestionBibliothequeBundle\Entity\Exemplaire;

class LoadExemplaire implements FixtureInterface
{

    public function load(ObjectManager $manager) {
        $arrayFields = array(
            array("ModeAcces" => Exemplaire::ACCES_EMPRUNT,
                "Cote" => "A810",
                "Etat" => Exemplaire::ETAT_NEUF
            )
        );
        foreach ($arrayFields as $data) {
            $ex = new Exemplaire();
            $ex->hydrate($data);
            $livre = $manager->getRepository('MSGestionBibliothequeBundle:Livre')->find(1);
            $adresse = $manager->getRepository('MSGestionBibliothequeBundle:Adresse')->find(1);
            $arrayAdresses = array();
            array_push($arrayAdresses, $adresse);
            $ex->setOeuvre($livre);
            $ex->setAdresses($arrayAdresses);
            $manager->persist($ex);
            break;
        }
        $manager->flush();
    }
}

