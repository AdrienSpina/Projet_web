<?php

class PanierDB extends Panier {

    private $_db;
    private $_infoArray = array();

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getPanier($id) {
        try {
            $query = "select * from PANIER where id_client= :id and actif = 1";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $id, PDO::PARAM_STR);
            $resultset->execute();
            //$data = $resultset->fetchAll();
            //var_dump($data);
            while ($data = $resultset->fetch()) {
                $_infoArray[] = new Panier($data);
            }
            if (!empty($_infoArray)) {
                return $_infoArray;
            }
        } catch (PDOException $e) {
            print "Panier inconnu";
        }
    }

    public function create_Panier($id) {
        $query = "insert into PANIER (id_client, actif)"
                . " values (:id, 1)";

        try {
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $id, PDO::PARAM_STR);
            $resultset->execute();
            //$retour = $resultset->fetchColumn(0);
            //return $retour;
        } catch (PDOException $e) {
            print "<br/>Echec de l'insertion";
            print $e->getMessage();
        }
    }

    public function inactiv_Panier($id) {
        $query = "UPDATE PANIER set actif = 0 WHERE id_client = :id";

        try {
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $id, PDO::PARAM_STR);
            $resultset->execute();
            //$retour = $resultset->fetchColumn(0);
            //return $retour;
        } catch (PDOException $e) {
            print "<br/>Echec de la desactivation du panier";
            print $e->getMessage();
        }
    }

}
