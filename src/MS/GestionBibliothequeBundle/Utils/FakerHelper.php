<?php
namespace MS\GestionBibliothequeBundle\Utils;

class FakerHelper {
    
    public static function generateKey($nbCar) {
            $string = "";
        $chaine = "abcdefghijklmnpqrstuvwxy";
        srand((double)microtime()*1000000);
        for($i=0; $i<$nbCar; $i++) {
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }
}

