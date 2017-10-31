<?php namespace MS\GestionBibliothequeBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class AdresseTest extends TestCase {
    
    public function testHydrateAdresse(){
        $adresse1 = new Adresse();
        $adresse1->setNum(1);
        $adresse1->setCodeNatureVoie("Rue");
        $adresse1->setLibelleVoie("Adolphe Thiers");
        $adresse1->setCodePostal(13001);
        $adresse1->setVille("Marseille");
        $adresse1->setExemplaire(null);
        
        $adresse2 = new Adresse();
        $data = array("Num" => 1, 
                "CodeNatureVoie" => "Rue",
                "LibelleVoie" => "Adolphe Thiers",
                "CodePostal" => 13001,
                "Ville" => "Marseille");
        $adresse2->hydrate($data);
       $this->assertEquals($adresse2, $adresse1);
    }
    
    public function testAdresseToString() {
        $adresse1 = new Adresse();
        $adresse1->setNum(1);
        $adresse1->setCodeNatureVoie("Rue");
        $adresse1->setLibelleVoie("Adolphe Thiers");
        $adresse1->setCodePostal(13001);
        $adresse1->setVille("Marseille");
        $adresse1->setExemplaire(null);
//         $this->expectOutputString(''); // tell PHPUnit to expect '' as output
        print_r($adresse1->toString() . "ping");
    }
}
