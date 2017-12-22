<?php

class ProduitDB extends Produit {

    private $_db;
    private $_infoArray = array();
    private $_variable = "valeur";

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function updateProduit($champ, $nouveau, $id) {
        try {
            $query = "UPDATE PRODUIT set " . $champ . " = '" . $nouveau . "' where ID_PRODUIT ='" . $id . "'";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function SearchProduit($nouveau) {
        try {
            $query = "SELECT nom FROM PRODUIT WHERE nom LIKE %'" . $nouveau . "'%";
            $resultset = $this->_db->prepare($query);
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
        return $_infoArray;
    }
    
    public function addProduit(array $data) {
        $query = "insert into PRODUIT (ID_TYPE_PRODUIT,NOM,PRIX,DESCRIPTION,IMAGE)"
                . " values (:id,:nom,:prix,:description,:image)";

        try {
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $data['id_type_produit'], PDO::PARAM_STR);
            $resultset->bindValue(':nom', $data['nom'], PDO::PARAM_STR);
            $resultset->bindValue(':prix', $data['prix'], PDO::PARAM_STR);
            $resultset->bindValue(':description', $data['description'], PDO::PARAM_STR);
            $resultset->bindValue(':image', $data['image'], PDO::PARAM_STR);
            $resultset->execute();
            $retour = $resultset->fetchColumn(0);
            //return $retour;
        } catch (PDOException $e) {
            print "<br/>Echec de l'insertion";
            print $e->getMessage();
        }
        
        
    }
    public function modifProduit(array $data) {
        try {
            $query = "UPDATE PRODUIT set ID_TYPE_PRODUIT = :id_type,NOM = :nom, PRIX = :prix, DESCRIPTION = :description, IMAGE = :image where ID_PRODUIT = :id";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $data['id_prod'], PDO::PARAM_STR);
            $resultset->bindValue(':id_type', $data['id_type_produit'], PDO::PARAM_STR);
            $resultset->bindValue(':nom', $data['nom'], PDO::PARAM_STR);
            $resultset->bindValue(':prix', $data['prix'], PDO::PARAM_STR);
            $resultset->bindValue(':description', $data['description'], PDO::PARAM_STR);
            $resultset->bindValue(':image', $data['image'], PDO::PARAM_STR);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

}
