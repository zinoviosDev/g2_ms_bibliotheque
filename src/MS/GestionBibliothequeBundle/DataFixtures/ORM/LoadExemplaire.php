<?php
namespace src\MS\GestionBibliothequeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MS\GestionBibliothequeBundle\Entity\Exemplaire;
use MS\GestionBibliothequeBundle\Entity\Livre;
use MS\GestionBibliothequeBundle\Entity\Auteur;

class LoadExemplaire implements FixtureInterface
{

    public function load(ObjectManager $manager) {
        $arrayFields = array(
            array("ModeAcces" => Exemplaire::ACCES_EMPRUNT,
                "Cote" => "A810",
                "Etat" => Exemplaire::ETAT_NEUF
            )
        );
        $repoAdresse = $manager->getRepository('MSGestionBibliothequeBundle:Adresse');
        $adresse13001 = $repoAdresse->findOneBy(array('codePostal' => 13001));
        $adresse13002 = $repoAdresse->findOneBy(array('codePostal' => 13002));
        $adresse13003 = $repoAdresse->findOneBy(array('codePostal' => 13003));
        $adresse13004 = $repoAdresse->findOneBy(array('codePostal' => 13004));
        $adresse13005 = $repoAdresse->findOneBy(array('codePostal' => 13005));
        $adresse13006 = $repoAdresse->findOneBy(array('codePostal' => 13006));
        $adresses = array($adresse13001, $adresse13002, $adresse13003, $adresse13004, $adresse13005, $adresse13006);
        $auteur = new Auteur();
        $auteur->setNom('Delannoy');
        $livreFilter = new Livre();
        $livreFilter->setAuteur($auteur);
//         $livres = $manager->getRepository('MSGestionBibliothequeBundle:Livre')->findByMultiCriteres($livreFilter);
        $livres = $manager->getRepository('MSGestionBibliothequeBundle:Livre')->findAll();
        $dvds = $manager->getRepository('MSGestionBibliothequeBundle:DVD')->findAll();
        
        foreach($livres as $livre) {
            $exemplaireArray = array();
            foreach ($arrayFields as $data) {
                $exemplaire = new Exemplaire();
                $exemplaire->hydrate($data);
                $nbExemplaire = rand (2, 6);
                $adresseKeyArray = array_rand($adresses, $nbExemplaire);
                foreach($adresseKeyArray as $adresseKey) {
                    if(null !== $adresses[$adresseKey]) {
                        $exemplaire->setAdresse($adresses[$adresseKey]);
                        break;
                    }
                }
                $exemplaireArray[] = $exemplaire;
            }
            foreach ($exemplaireArray as $myex) {
                $livre->addExemplaire($myex);
            }
            $manager->persist($livre);
        }
        foreach($dvds as $dvd) {
            $exemplaireArray = array();
            foreach ($arrayFields as $data) {
                $exemplaire = new Exemplaire();
                $exemplaire->hydrate($data);
                $nbExemplaire = rand (2, 6);
                $adresseKeyArray = array_rand($adresses, $nbExemplaire);
                foreach($adresseKeyArray as $adresseKey) {
                    if(null !== $adresses[$adresseKey]) {
                        $exemplaire->setAdresse($adresses[$adresseKey]);
                        break;
                    }
                }
                $exemplaireArray[] = $exemplaire;
            }
            foreach ($exemplaireArray as $myex) {
                $dvd->addExemplaire($myex);
            }
            $manager->persist($dvd);
        }
        $manager->flush();
    }
}

