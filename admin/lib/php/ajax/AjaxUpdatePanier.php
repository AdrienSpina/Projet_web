<?php

header('Content-type: application/json');
require '../dbConnectMysql.php';
require '../classes/Connexion.class.php';
require '../classes/Pan_prod.class.php';
require '../classes/Pan_prodDB.class.php';
require '../classes/Vue_PanierDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $pass);
session_start();
try {
    $update = new Pan_prodDB($cnx);
    extract($_GET, EXTR_OVERWRITE);
    $param = 'id=' . $id . '&champ=' . $champ . '&nouveau=' . $nouveau;
    $update->updatePan_prod($champ, $nouveau, $id);
    $montant = new Vue_panierDB($cnx);
    $total = $montant->getMontantTotal($_SESSION['client'], $_SESSION['panier']);
    print json_encode(array("total" => $total));
    
} catch (Exception $e) {
    print $e->getMessage();
}

