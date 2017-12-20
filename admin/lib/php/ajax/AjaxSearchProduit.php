<?php

header('Content-type: application/json');
require '../dbConnectMysql.php';
require '../classes/Connexion.class.php';
require '../classes/Produit.class.php';
require '../classes/ProduitDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $pass);

try {
    $update = new ProduitDB($cnx);
    extract($_GET, EXTR_OVERWRITE);
    $param = '&nouveau=' . $nouveau;
    $update->SearchProduit($nouveau);
} catch (Exception $e) {
    print $e->getMessage();
}
