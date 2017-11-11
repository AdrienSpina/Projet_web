<?php

class InfoclientDB extends Infoclient {

    private $_db;
    private $_infoArray = array();

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getInfoClient($page) {
        try {
            $query = "select * from TEXTE where page=:page";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':page',$page,PDO::PARAM_STR);
            $resultset->execute();
            //$data = $resultset->fetchAll();
            //var_dump($data);
            while($data = $resultset->fetch()){
                $_infoArray[] = new Infoclient($data);
            }
            return $_infoArray;
        } catch (PDOException $e) {
            print "Erreur " . $e->getMessage();
        }
        
    }

}
