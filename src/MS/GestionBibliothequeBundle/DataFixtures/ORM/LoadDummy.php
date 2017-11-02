<?php
namespace src\MS\GestionBibliothequeBundle\DataFixtures\ORM;
      
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MS\GestionBibliothequeBundle\Entity\Dummy;
use MS\GestionBibliothequeBundle\Entity\RelatedDummy;

class LoadDummy implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
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
            $dummy = new Dummy();
            $dummy->setName($name);
            foreach ($names as $name) {
                $relatedDummy = new RelatedDummy();
                $relatedDummy->setName($name);
                $relatedDummy->setDummy($dummy);
                $manager->persist($relatedDummy);
            }
            
            // On la persiste
            $manager->persist($dummy);
        }
        
        // On déclenche l'enregistrement
        $manager->flush();
    }
}

