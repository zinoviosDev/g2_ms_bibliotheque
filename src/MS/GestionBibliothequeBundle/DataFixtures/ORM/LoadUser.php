<?php
namespace MS\GestionBibliothequeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use MS\UserBundle\Entity\User;

class LoadUser extends Fixture implements FixtureInterface
{

    public function load(ObjectManager $manager) {
        $repo = $manager->getRepository('MSGestionBibliothequeBundle:Adherent');
        $adherents= $repo->findAll();
        foreach($adherents as $adherent) {
            $user = new User();
            $user->setUsername(mb_strtolower($adherent->getPrenom()) . "." . mb_strtolower($adherent->getNom()) );
            $user->setPassword($adherent->getPrenom());
            $user->setSalt('');
            $roles = array();
            $roles[] = "ROLE_ADHERENT";
            $user->setRoles($roles);
            $adherent->setUserCredentials($user);
            $manager->persist($adherent);
        }
        $manager->flush();
    }

}

