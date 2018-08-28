<?php
/**
 * Created by PhpStorm.
 * User: Lukas Lepez
 * Date: 21/08/2018
 * Time: 14:54
 */

class BddHuman
{
    protected $_bdd;

    /**
     * Bdd constructor.
     */
    public function __construct()
    {
        $this->_bdd = new PDO('mysql:host=localhost;dbname=human;charset=utf8', 'root', '');
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
}

$test = new BddHuman();