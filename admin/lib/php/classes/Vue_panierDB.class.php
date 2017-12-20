<?php

class Vue_panierDB {

    private $_db;

    function __construct($_db) {
        $this->_db = $_db;
    }

    function getVue_panier($id_cli, $id_pan) {
        try {
            $query = "SELECT * FROM VUE_PANIER WHERE id_client = :id_cli AND id_panier = :id_pan";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_cli', $id_cli);
            $resultset->bindValue(':id_pan', $id_pan);
            $resultset->execute();
            $data = $resultset->fetchAll();
//var_dump($data);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = $data;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        if(!empty($_infoArray)){
            return $_infoArray;
        }
    }
    public function getMontantTotal($id_cli, $id_pan) {
        try {
            $query = "select SUM(PRIX*quantite) from VUE_PANIER where id_client = :id_cli and id_panier = :id_pan";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_cli', $id_cli, PDO::PARAM_STR);
            $resultset->bindValue(':id_pan', $id_pan, PDO::PARAM_STR);
            $resultset->execute();
            //$data = $resultset->fetchAll();
            //var_dump($data);
            $data = $resultset->fetch();
            return $data;
        } catch (PDOException $e) {
            print "Erreur";
        }
    }
    function getVue_panier_inactif($id_pan) {
        try {
            $query = "SELECT * FROM VUE_PANIER_INACTIF WHERE id_panier = :id_pan";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_pan', $id_pan);
            $resultset->execute();
            $data = $resultset->fetchAll();
            //var_dump($data);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            try {
                $_infoArray[] = $data;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }
        if(!empty($_infoArray)){
            return $_infoArray;
        }
    }
    
}
