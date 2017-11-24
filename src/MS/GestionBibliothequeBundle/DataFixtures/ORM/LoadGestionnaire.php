<?php
namespace MS\GestionBibliothequeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MS\GestionBibliothequeBundle\Entity\Gestionnaire;
use MS\UserBundle\Entity\User;
use MS\GestionBibliothequeBundle\Entity\Adresse;

class LoadGestionnaire implements FixtureInterface {

    public function load(ObjectManager $manager) {
        $gestionnairesArray = array(
            array(
                "Prenom" => "Jason",
                "Nom" => "Doe",
                "DateNaissance" => date_create_from_format("d/m/Y", "16/08/2002"),
                "Genre" => "male"
            ),
            array(
                "Prenom" => "Enora",
                "Nom" => "Fournier",
                "DateNaissance" => date_create_from_format("d/m/Y", "16/08/2002"),
                "Genre" => "female"
            )
        );
        $adresseFields = array(
            array(
                "Numero" => 7,
                "LibelleVoie" => "Rue d'Endoume",
                "CodePostal" => "13007",
                "Ville" => "Marseille"
            )
        );
        foreach($gestionnairesArray as $data) {
            $gestionnaire = new Gestionnaire();
            $gestionnaire->hydrate($data);
            $user = new User();
            $user->setUsername($gestionnaire->getPrenom());
            $user->setPassword($gestionnaire->getPrenom());
            $user->setSalt('');
            $user->setEmail($gestionnaire->getPrenom() ."@gmail.com");
            $user->setRoles(array('ROLE_ADHERENT', 'ROLE_GESTIONNAIRE'));
            $gestionnaire->setUserCredentials($user);
            $manager->persist($gestionnaire);
        }
        $manager->flush();
    }
}

