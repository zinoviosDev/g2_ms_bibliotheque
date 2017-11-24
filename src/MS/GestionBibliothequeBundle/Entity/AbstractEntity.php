<?php namespace MS\GestionBibliothequeBundle\Entity;

abstract class AbstractEntity {
    
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }
    public function toString() {
        $objectString = "";
        $keys = array_keys(get_object_vars($this));
        var_dump($keys);
        foreach ($keys as $key) {
            $method = 'get'.ucfirst($key);
            if (method_exists($this, $method)) {
                // On appelle le get.
                $objectString = $this->$method($key) . " ";
            }
        }
        $objectString = trim($objectString);
        return $objectString;
    }
}
