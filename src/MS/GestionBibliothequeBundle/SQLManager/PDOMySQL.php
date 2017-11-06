<?php
namespace src\MS\GestionBibliothequeBundle\SQLManager;

class PDOMySQL {
    
    private static $instance = null;
    private $dbh;
    
    private function __construct($host, $database, $user, $pass) {
        try {
            $dbh = new \PDO('mysql:host=' .$host.';dbname='.$database.', '.$user.', '.$pass);
        } catch (\PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    public static function getInstance() {
        if(null == $instance ){
            $instance = new PDOMySQL();
        }
        return $instance;
    }
    
    public function getDbh() {
        return $this->getInstance()->getDbh();
    }
}
