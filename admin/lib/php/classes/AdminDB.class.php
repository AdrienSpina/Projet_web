<?php

class AdminDB extends Admin {

    private $_db;
    private $_infoArray = array();

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getLogAdmin($login, $mp) {
        try {
            $query = "select * from ADMIN where LOGIN= :login and MP= :mp";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':login', $login, PDO::PARAM_STR);
            $resultset->bindValue(':mp', $mp, PDO::PARAM_STR);
            $resultset->execute();
            //$data = $resultset->fetchAll();
            //var_dump($data);
            while ($data = $resultset->fetch()) {
                $_infoArray[] = new Admin($data);
            }
            return $_infoArray;
        } catch (PDOException $e) {
            print "Admin inconnu";
        }
    }

    public function addClient(array $data) {
        $query = "insert into CLIENT (NOM,PRENOM,ADRESSE,VILLE,CP,EMAIL,LOGIN,MP,TEL)"
                . " values (:nom,:prenom,:adresse,:ville,:cp,:email,:login,:mp,:tel)";

        try {
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':nom', $data['nom'], PDO::PARAM_STR);
            $resultset->bindValue(':prenom', $data['prenom'], PDO::PARAM_STR);
            $resultset->bindValue(':adresse', $data['adresse'], PDO::PARAM_STR);
            $resultset->bindValue(':ville', $data['ville'], PDO::PARAM_STR);
            $resultset->bindValue(':cp', $data['cp'], PDO::PARAM_STR);
            $resultset->bindValue(':email', $data['email'], PDO::PARAM_STR);
            $resultset->bindValue(':login', $data['login'], PDO::PARAM_STR);
            $resultset->bindValue(':mp', $data['mp'], PDO::PARAM_STR);
            $resultset->bindValue(':tel', $data['tel'], PDO::PARAM_STR);
            $resultset->execute();
            $retour = $resultset->fetchColumn(0);
            return $retour;
        } catch (PDOException $e) {
            print "<br/>Echec de l'insertion";
            print $e->getMessage();
        }
        
        
    }

}
