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
class LoadAdherent implements FixtureInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
     *
     */
    public function load(ObjectManager $manager) {
        $arrayFields = array(
            array("DateNaissance" => date_create_from_format("d/m/Y", "16/08/2002"),
                "Email" => "john.doe@gmail.com",
                "Genre" => "male",
                "NbreEmpruntsAuthorises" => (int)10,
                "Nom" => "Doe",
                "NumTelephone" => "+33608654232",
                "Prenom" => "John"
            )
        );
        $adherent = new Adherent();
        $adherent->setNom("Doe");
        $adherent->setPrenom("John");
        $adherent->setGenre("male");
        $adherent->setNbreEmpruntsAuthorises("10");
        $adherent->setNumTelephone("33608654232");
        $adherent->setEmail("john.doe@gmail.com");
        $adherent->setDateNaissance(date_create_from_format("d/m/Y", "06/08/2008"));
        $manager->persist($adherent);
        
        foreach ($arrayFields as $data) {
            $adherent2 = new Adherent();
            $adherent2->hydrate($data);
            $manager->persist($adherent2);
        }
        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();

    }
}

