<?php
namespace src\MS\GestionBibliothequeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MS\GestionBibliothequeBundle\Entity\Adherent;

/**
 *
 * @author user
 *
 */
class LoadAuteur implements FixtureInterface
{
    
    /**
     * (non-PHPdoc)
     *
     * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
     *
     */
    public function load(ObjectManager $manager) {
        $arrayFields = array(
            array("DateNaissance" => new \DateTime("1810-08-16"),
                "Nom" => "Doe",
                "Prenom" => "John",
                "Genre" => "male",
                "Oeuvres" => null
            )
        );
//         foreach ($arrayFields as $fields) {
//             $object = new Adherent();
//             $object->hydrate($fields);
//             $manager->persist($object);
//         }
//         // On déclenche l'enregistrement de toutes les catégories
//         $manager->flush();
    }
}

