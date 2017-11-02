<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadAdvert.php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Application;
use OC\PlatformBundle\Entity\Category;
use OC\PlatformBundle\Entity\Image;

class LoadAdvert implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Notre liste d'annonce en dur
        $listAdverts = array(
            array(
                'title'   => 'Recherche développpeur Symfony',
                'id'      => 1,
                'author'  => 'Alexandre',
                'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
                'date'    => new \Datetime()),
            array(
                'title'   => 'Mission de webmaster',
                'id'      => 2,
                'author'  => 'Hugo',
                'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
                'date'    => new \Datetime()),
            array(
                'title'   => 'Offre de stage webdesigner',
                'id'      => 3,
                'author'  => 'Mathieu',
                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                'date'    => new \Datetime())
        );
        
        foreach ($listAdverts as $adv) {
            // On crée l'Advert
            $advert = new Advert();
            $advert->setTitle($adv["title"]);
            $advert->setAuthor($adv["author"]);
            $advert->setContent($adv["content"]);
            $advert->setDate($adv["date"]);
            
            // Création de l'entité Image
            $image = new Image();
            $image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
            $image->setAlt('Job de rêve');
            
            // Création d'une première candidature
            $application1 = new Application();
            $application1->setAuthor('Marine');
            $application1->setContent("J'ai toutes les qualités requises.");
            
            // Création d'une deuxième candidature par exemple
            $application2 = new Application();
            $application2->setAuthor('Pierre');
            $application2->setContent("Je suis très motivé.");
            
            // On lie les candidatures à l'annonce
            $application1->setAdvert($advert);
            $application2->setAdvert($advert);
            $manager->persist($application1);
            $manager->persist($application2);
            
            // Liste des noms de catégorie à ajouter
            $names = array(
                'Développement web',
                'Développement mobile',
                'Graphisme',
                'Intégration',
                'Réseau'
            );
            
            foreach ($names as $name) {
                // On crée la catégorie
                $category = new Category();
                $category->setName($name);
                
                // On la persiste
//                 $manager->persist($category);
                $advert->addCategory($category);
            }
            
            // On lie l'image à l'annonce
            $advert->setImage($image);
            // On la persiste
            $manager->persist($advert);
        }
        
        // On déclenche l'enregistrement de tous les Advert
        $manager->flush();
    }
}