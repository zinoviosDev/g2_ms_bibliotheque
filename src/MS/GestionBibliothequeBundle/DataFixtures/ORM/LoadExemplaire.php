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
            $livre = $manager->getRepository('MSGestionBibliothequeBundle:Livre')->findOneBy(array('isbn' => '5540299360751'));
            $adresse = $manager->getRepository('MSGestionBibliothequeBundle:Adresse')->findOneBy(array('codePostal' => 13001));
            $ex->setOeuvre($livre);
            $ex->setAdresse($adresse);
            $manager->persist($ex);
            break;
        }
        $manager->flush();
    }
}

