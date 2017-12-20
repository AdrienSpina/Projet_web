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
    public function delete_Produit($id_pan, $id_prod) {
        $query = "DELETE FROM PAN_PROD WHERE id_panier = :id AND id_produit = :id2";

        try {
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $id_pan, PDO::PARAM_STR);
            $resultset->bindValue(':id2', $id_prod, PDO::PARAM_STR);
            $resultset->execute();
            //$retour = $resultset->fetchColumn(0);
            //return $retour;
        } catch (PDOException $e) {
            print "<br/>Echec de la suppression";
            print $e->getMessage();
        }
    }
    
        public function vide_Panier($id) {
        $query = "DELETE FROM PAN_PROD WHERE id_panier = :id";

        try {
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':id', $id, PDO::PARAM_STR);
            $resultset->execute();
            //$retour = $resultset->fetchColumn(0);
            //return $retour;
        } catch (PDOException $e) {
            print "<br/>Echec du vide-panier";
            print $e->getMessage();
        }
    }
       public function updatePan_prod($champ, $nouveau, $id) {
        try {
            $query = "UPDATE PAN_PROD set " . $champ . " = '" . $nouveau . "' where id_pan_prod ='" . $id . "'";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
}
