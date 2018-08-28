<?php 
class BddHuman
{
    protected $_bdd;

    /**
     * Bdd constructor.
     */
    public function __construct()
    {
        $this->_bdd = new PDO('mysql:host=localhost;dbname=human;charset=utf8', 'admin', 'admin');
    }

    /**
     * @return PDO
     */
    public function getBdd()
    {
        return $this->_bdd;
    }

    /**
     * @param PDO $bdd
     */
    public function setBdd($bdd)
    {
        $this->_bdd = $bdd;
    }

    public function recupererStatsGlobale()
    {

    }
    public function recupererStatsPartie(){

    }
}

// $test = new BddHuman();