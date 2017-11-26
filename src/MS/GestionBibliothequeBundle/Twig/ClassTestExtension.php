<?php
namespace MS\GestionBibliothequeBundle\Twig;

use MS\GestionBibliothequeBundle\Entity\Livre;
use MS\GestionBibliothequeBundle\Entity\DVD;

/**
 *
 * @author marc
 *        
 */
class ClassTestExtension extends \Twig_Extension {

    public function getTests()
    {
        return [
            new \Twig_SimpleTest('instanceOfLivre', function($event) { return $event instanceof Livre; }),
            new \Twig_SimpleTest('instanceOfDVD', function($event) { return $event instanceof DVD; })
            ];
    }
    
    
    public function getName()
    {
        return 'class_test__extension';
    }
}

