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
class LoadCarteBibliotheque implements FixtureInterface
{
    
    /**
     * (non-PHPdoc)
     *
     * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
     *
     */
    public function load(ObjectManager $manager) {
        $arrayFields = array(
            array(
                "NumCarte" => "32456DSDSQ654",
                "Password" => "2002JO08"
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

