<?php
require 'bddHuman.php';
class Partie extends BddHuman
{
    protected $_idPartie;
    public function __construct()
    {
        Parent::__construct();
        $enregistre = $this->_bdd->prepare("INSERT INTO partie (date_partie) VALUES (NOW())");
        $enregistre->execute();
        $_idPartie = $this->_bdd->prepare("SELECT id_partie from partie ORDER BY id_partie DESC LIMIT 1");
        $_idPartie->execute();
        $rsltidPartie= $_idPartie->fetch();
        $this->_idPartie = $rsltidPartie[0];
    }

    /**
     * @return mixed
     */
    public function getPartie(){
        return $this->_idPartie; 
    }

    public function globalStat(){

        
    }
    public function partieGlo()
    {

    }
    
}
