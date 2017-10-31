<?php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;

class LoadAdherentFromSQL implements ContainerAwareInterface {
    
    private $container;
    
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        // Bundle to manage file and directories
        $finder = new Finder();
        $finder->in('src/MS/GestionBibliothequeBundle/Resources/sql');
        $finder->name('adherents.sql');
        
        foreach( $finder as $file ){
            $content = $file->getContents();
            
            $stmt = $this->container->get('doctrine.orm.entity_manager')->getConnection()->prepare($content);
            $stmt->execute();
        }
    }
    
}