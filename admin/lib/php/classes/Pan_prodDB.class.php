<?php

class Pan_prodDB extends Pan_prod {

    private $_db;
    private $_infoArray = array();

    public function __construct($cnx) {
        $this->_db = $cnx;
    }

    public function getProduits($id) {
        try {
            $query = "select b.NOM, b.IMAGE, b.PRIX, a.quantite from PAN_PROD a, PRODUIT b where a.id_panier= :id";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $id, PDO::PARAM_STR);
            $resultset->execute();
            //$data = $resultset->fetchAll();
            //var_dump($data);
            while ($data = $resultset->fetch()) {
                $_infoArray[] = new Client($data);
            }
            return $_infoArray;
        } catch (PDOException $e) {
            print "Panier inconnu";
        }
    }

    public function ajout_Produit($id, $id2, $qte) {
        $query = "insert into PAN_PROD (id_panier, id_produit, quantite)"
                . " values (:id, :id2, :qte)";

        try {
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $id, PDO::PARAM_STR);
            $resultset->bindValue(':id2', $id2, PDO::PARAM_STR);
            $resultset->bindValue(':qte', $qte, PDO::PARAM_STR);
            $resultset->execute();
            //$retour = $resultset->fetchColumn(0);
            //return $retour;
        } catch (PDOException $e) {
            print "<br/>Echec de l'insertion";
            print $e->getMessage();
        }
    }

}
