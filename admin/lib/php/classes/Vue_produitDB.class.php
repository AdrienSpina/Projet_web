<?php

class Vue_produitDB {

    private $_db;

    function __construct($_db) {
        $this->_db = $_db;
    }

//liste des produits correspondant au choix du type dans liste déroulante
    function getVue_produitType($id) {
        try {
            $query = "SELECT * FROM VUE_PRODUIT where id_type_produit=:id_type_produit";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_type_produit', $id);
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
        return $_infoArray;
    }

    function getVue_produit() {
        try {
            $query = "SELECT * FROM VUE_PRODUIT order by type_produit,nom";
            $resultset = $this->_db->prepare($query);
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
        return $_infoArray;
    }

    function getVue_ProduitById($id) {
        try {
            $query = "SELECT * FROM VUE_PRODUIT where id_produit=:id_produit";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_produit', $id);
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
        return $_infoArray;
    }

}
