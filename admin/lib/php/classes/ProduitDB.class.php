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

}
