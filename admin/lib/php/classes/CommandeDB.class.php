<?php

class CommandeDB extends Commande {

    private $_db;
    private $_infoArray = array();

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function addCommande($id, $id2) {
        $query = "insert into COMMANDE (ID_PANIER,PRIX_TOTAL,DATE_COMMANDE)"
                . " values (:id_pan, :id_total, SYSDATE())";

        try {
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id_pan', $id, PDO::PARAM_STR);
            $resultset->bindValue(':id_total', $id2, PDO::PARAM_STR);
            $resultset->execute();
            $retour = $resultset->fetchColumn(0);
            return $retour;
        } catch (PDOException $e) {
            print "<br/>Echec de l'insertion";
            print $e->getMessage();
        }
        
        
    }
    
}
