<?php
/**
 * Created by PhpStorm.
 * User: Lukas Lepez
 * Date: 21/08/2018
 * Time: 11:39
 */

include 'bddHuman.php';

class Personnage extends BddHuman
{
    protected $_espvie;
    protected $_croissance;
    protected $_taille;
    protected $_homme;
    protected $_emplacement;

    /**
     * Personnage constructor.
     * @param $emplacement
     */
    public function __construct($emplacement)
    {
        Parent::__construct();
        $this->_espvie = mt_rand(0, 100);
        $this->_croissance = mt_rand(8, 12)/10;
        $this->_taille = mt_rand(420, 570)/10;
        $this->_homme = mt_rand(1, 100);
        $this->_emplacement = $emplacement;

        var_dump($this->_croissance);
    }

    /**
     * @return mixed
     */
    public function getEspvie()
    {
        return $this->_espvie;
    }

    /**
     * @param mixed $espvie
     */
    public function setEspvie($espvie)
    {
        $this->_espvie = $espvie;
    }

    /**
     * @return mixed
     */
    public function getCroissance()
    {
        return $this->_croissance;
    }

    /**
     * @param mixed $croissance
     */
    public function setCroissance($croissance)
    {
        $this->_croissance = $croissance;
    }

    /**
     * @return mixed
     */
    public function getTaille()
    {
        return $this->_taille;
    }

    /**
     * @param mixed $taille
     */
    public function setTaille($taille)
    {
        $this->_taille = $taille;
    }

    /**
     * @return mixed
     */
    public function getHomme()
    {
        return $this->_homme;
    }

    public function setHomme()
    {
        if ($this->_homme < 50) {
            $this->_homme = 0;
        } else {
            $this->_homme = 1;
        }
    }

    /**
     * @return mixed
     */
    public function getEmplacement()
    {
        return $this->_emplacement;
    }

    /**
     * @param mixed $emplacement
     */
    public function setEmplacement($emplacement)
    {
        $this->_emplacement = $emplacement;
    }

    public function enregistrerPerso()
    {
        $select = $this->_bdd->prepare("SELECT * FROM personnage WHERE espvie = ? AND croissance = ? AND taille = ? AND homme = ? AND emplacement = ?");
        $select->bindValue(1, $this->_espvie);
        $select->bindValue(2, $this->_croissance);
        $select->bindValue(3, $this->_taille);
        $select->bindValue(4, $this->_homme);
        $select->bindValue(5, $this->_emplacement);
        $select->execute();
        $result = $select->fetch();

        if ($this->_espvie == $result[1] && $this->_croissance == $result[2] && $this->_taille == $result[3] && $this->_homme == $result[4] && $this->_emplacement == $result[5]) {

        } else {
            $this->setHomme();
            $enregistre = $this->_bdd->prepare("INSERT INTO personnage(espvie, croissance, taille, homme, emplacement) VALUES (?, ?, ?, ?, ?)");
            $enregistre->bindParam(1, $this->_espvie);
            $enregistre->bindParam(2, $this->_croissance);
            $enregistre->bindParam(3, $this->_taille);
            $enregistre->bindParam(4, $this->_homme);
            $enregistre->bindParam(5, $this->_emplacement);
            $enregistre->execute();
        }
    }

    public function enregistrerPartiePerso()
    {
        $enregistre = $this->_bdd->prepare("INSERT INTO partie_perso (id_perso, id_partie) SELECT * FROM (SELECT id_perso FROM personnage) r1, (SELECT id_partie FROM partie) r2");
        $enregistre->execute();
    }

}

$perso = new Personnage(1);

$perso->enregistrerPerso();