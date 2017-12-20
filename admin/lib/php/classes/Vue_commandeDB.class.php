<?php

class Vue_commandeDB {

    private $_db;

    function __construct($_db) {
        $this->_db = $_db;
    }

    function getRecup_commande($id) {
        try {
            $query = "SELECT * FROM VUE_COMMANDE where id_client = :id ORDER BY DATE_COMMANDE desc";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $id,PDO::PARAM_STR);
            $resultset->execute();
            //$data = $resultset->fetchAll();
            //var_dump($data);
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
    function getChoose_commande($id) {
        try {
            $query = "SELECT * FROM VUE_COMMANDE where ID_COMMANDE = :id";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $id, PDO::PARAM_STR);
            $resultset->execute();
            //$data = $resultset->fetchAll();
            //var_dump($data);
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
