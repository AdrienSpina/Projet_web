<?php

header('Content-type: application/json');
require '../dbConnectMysql.php';
require '../classes/Connexion.class.php';
require '../classes/Pan_prod.class.php';
require '../classes/Pan_prodDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $pass);

try {
    $update = new Pan_prodDB($cnx);
    extract($_GET, EXTR_OVERWRITE);
    $param = 'id=' . $id . '&champ=' . $champ . '&nouveau=' . $nouveau;
    $update->updatePan_prod($champ, $nouveau, $id);
} catch (Exception $e) {
    print $e->getMessage();
}

