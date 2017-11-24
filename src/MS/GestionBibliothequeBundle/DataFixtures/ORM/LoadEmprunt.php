<?php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MS\GestionBibliothequeBundle\Entity\Emprunt;

class LoadEmprunt implements FixtureInterface {
    public function load(ObjectManager $manager) {
        $repoAdherent = $manager->getRepository("MSGestionBibliothequeBundle:Adherent");
        $adherent = $repoAdherent->find(77);
        $emprunts = $repoAdherent->findOwnEmprunts($adherent);
        //var_dump($adherent);
        //var_dump($adherent->getEmprunts());
        foreach($emprunts as $emprunt) {
            var_dump($emprunt);
            break;
        }
        
//         $emprunt->setAdherent();
//         $emprunt->setExemplaire($ex);
//         $emprunt->setDateEmprunt(new  \DateTime());
//         $emprunt->setDateRetourTheorique($emprunt->getDateEmprunt()->modify('+'.Emprunt::DUREE_LIMITE_EMPRUNT.' day'));
//         $emprunt->setOeuvre($ex->getOeuvre());
//         $adherent->addEmprunt($emprunt);
    }

    
}