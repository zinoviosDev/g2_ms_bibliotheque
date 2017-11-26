<?php
namespace src\MS\GestionBibliothequeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MS\GestionBibliothequeBundle\Entity\Adherent;
use MS\UserBundle\Entity\User;
use MS\GestionBibliothequeBundle\Entity\Adresse;
use MS\GestionBibliothequeBundle\Utils\FakerHelper;

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
        $adherentsArray = array(
            array(
                "Prenom" => "John",
                "Nom" => "Doe",
                "DateNaissance" => date_create_from_format("d/m/Y", "16/08/2002"),
                "Genre" => "male",
                "Email" => "john.doe@gmail.com",
                "NumTelephone" => "+33608654232",
                "NbreEmpruntsAuthorises" => (int)10
            ),
            array(
                "Prenom" => "Louise",
                "Nom" => "Fournier",
                "DateNaissance" => date_create_from_format("d/m/Y", "16/08/2002"),
                "Genre" => "female",
                "Email" => "louise.fournier@gmail.com",
                "NumTelephone" => "0491010203",
                "NbreEmpruntsAuthorises" => (int)10
            ),
            array(
                "Prenom" => "Amélie",
                "Nom" => "Rousset",
                "DateNaissance" => date_create_from_format("d/m/Y", "16/08/2002"),
                "Genre" => "female",
                "Email" => "amelie.rousset@gmail.com",
                "NumTelephone" => "0491010203",
                "NbreEmpruntsAuthorises" => (int)10
            ),
            array(
                "Prenom" => "Anna",
                "Nom" => "Guillou",
                "DateNaissance" => date_create_from_format("d/m/Y", "16/08/2002"),
                "Genre" => "female",
                "Email" => "anna.guillou@gmail.com",
                "NumTelephone" => "0491010203",
                "NbreEmpruntsAuthorises" => (int)10
            )
        );
        // adresse + carte bibliotheque
        $adresseFields = array(
            array(
                "Numero" => 7,
                "LibelleVoie" => "Rue d'Endoume",
                "CodePostal" => "13007",
                "Ville" => "Marseille"
            )
        );
        $carteBibliothequeFields = array(
            array(
                "NumeroCarte" => "E100275542",
                "MotDePasse" => "" // unused but causes bug in alice fixture is suppressed
            )
        );
        foreach ($adherentsArray as $data) {
            $adherent = new Adherent();
            $adherent->hydrate($data);
            $user = new User();
            $user->setUsername($adherent->getPrenom());
            $user->setPassword($adherent->getPrenom());
            $user->setSalt('');
            $user->setEmail($adherent->getPrenom() ."@gmail.com");
            $user->setRoles(array('ROLE_ADHERENT'));
            $adherent->setUserCredentials($user);
            $adresse = new Adresse();
            $adresse->setNumero(7);
            $adresse->setLibelleVoie("Rue d'Endoume");
            $adresse->setCodePostal(13007);
            $adresse->setVille("Marseille");
            $adherent->addAdress($adresse);
            $adherent->setEmail($adherent->getPrenom() ."@gmail.com");
            $adherent->setNumCarte(FakerHelper::generateKey(10));
//             $manager->persist($user);
//             $manager->persist($adresse);
            $manager->persist($adherent);
        }
        $manager->flush();
    }
}
