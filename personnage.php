<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require 'partie.php';
class Personnage extends BddHuman
{
    protected $_espvie;
    protected $_croissance;
    protected $_taille;
    protected $_homme;
    protected $_emplacement;
    protected $_idPers;
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
        $this->_idPers = $this->_bdd->prepare("SELECT id_perso from personnage ORDER BY id_perso DESC LIMIT 1");
        $this->_idPers->execute();
        $rsltidPers = $this->_idPers->fetch();
        $this->_idPers = $rsltidPers[0];
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

    public function enregistrerPerso($idPart)
    {

        $select = $this->_bdd->prepare("SELECT id_perso FROM personnage WHERE lifespan = ? AND growth = ? AND birthsize = ? AND man = ? AND location = ?");
        $select->bindValue(1, $this->_espvie);
        $select->bindValue(2, $this->_croissance);
        $select->bindValue(3, $this->_taille);
        $select->bindValue(4, $this->_homme);
        $select->bindValue(5, $this->_emplacement);
        $select->execute();
        $result = $select->fetch();
        if ($result !== null) {
            $existPerso = $this->_bdd->prepare("INSERT INTO partie_perso(id_perso,id_partie) VALUES (?,?)");
            $select->bindValue(1, $result[0]);
            $select->bindValue(2, $idPart);
            $select->execute();
        } else {
            $this->setHomme();
            $enregistre = $this->_bdd->prepare("INSERT INTO personnage(lifespan, growth, birthsize, man, location) VALUES (?, ?, ?, ?, ?)");
            $enregistre->bindParam(1, $this->_espvie);
            $enregistre->bindParam(2, $this->_croissance);
            $enregistre->bindParam(3, $this->_taille);
            $enregistre->bindParam(4, $this->_homme);
            $enregistre->bindParam(5, $this->_emplacement);
            return $enregistre->execute();
            echo"ok";
        }
    }

    public function enregistrerPartiePerso($idPart)
    {
        $enregistre = $this->_bdd->prepare("INSERT INTO partie_perso(id_perso, id_partie) VALUES (?,?) ");
        $enregistre->bindValue(1,$this->_idPers);
        $enregistre->bindValue(2,$idPart);
        $enregistre->execute();
    }

}

// $perso = new Personnage();
// $parts = new Partie();
// $perso->enregistrerPerso($parts->getPartie());
// $perso->enregistrerPartiePerso($parts->getPartie());

function createPerso($nbPerso){
    $i=0;
    $arr=[];
    while($i<$nbPerso){
        $perso = new Personnage($i);
        array_push($arr, $perso); 
        $i++;
    }
    return json_encode($arr);
}

echo createPerso(10);
