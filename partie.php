<?php
/**
 * Created by PhpStorm.
 * User: Lukas Lepez
 * Date: 21/08/2018
 * Time: 14:17
 */

include 'bddHuman.php';

class Partie extends BddHuman
{
    protected $_date;

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->_date = $date;
    }

    public function enregistrerPartie()
    {
        $enregistre = $this->_bdd->prepare("INSERT INTO partie (date_partie) VALUES (NOW())");
        $enregistre->execute();
    }

    public function recupStatsPartie()
    {
        $select = $this->_bdd->prepare("SELECT espvie, croissance, taille, date_partie, partie.id_partie, personnage.id_perso FROM partie_perso INNER JOIN personnage ON partie_perso.id_perso = personnage.id_perso INNER JOIN partie ON partie_perso.id_partie = partie.id_partie");
        $select->execute();
        $recup = $select->fetch();

        return $recup;
    }

}

$test = new Partie();

var_dump($test->enregistrerPartie());