<?php

require '../lib/php/dbConnectMysql.php';
require '../lib/php/classes/Connexion.class.php';
require '../lib/php/classes/Vue_produitDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $pass);

// recuperation des données
$obj = new Vue_ProduitDB($cnx);
$liste = $obj->getVue_produit();
$nbrG = count($liste);

require '../lib/php/fpdf/fpdf/fpdf.php';

$pdf = new FPDF('P', 'cm', 'A4'); // P pour format portrait , cm pour la hauteur de page, de ligne et A4 pour la taille de la page
$pdf->SetFont('Arial', 'B', 14);
$pdf->AddPage();
$pdf->SetFillColor(10, 110, 10);
$pdf->SetDrawColor(0, 0, 255);
$pdf->SetTextColor(255, 255, 255);
$pdf->setXY(3,1);
$pdf->cell(15, .7, UTF8_decode('Nos produits'), 0, 0, 'C', 1);
//sous_titre
$pdf->SetFillColor(200, 10, 10);
$pdf->SetDrawColor(0, 0, 255);
$pdf->SetTextColor(255, 255, 255);
$pdf->setXY(3, 2);
$pdf->cell(15, .7, UTF8_decode('Le meilleur de l Italie'), 0, 0, 'C',1);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);

$x = 3;
$y = 3;
$pdf->setXY($x, $y);
$pdf->SetFont('Arial', 'B', '12');
$pdf->cell(8, 1, utf8_decode('Dénomination'), 0, 0, 'L');
$pdf->cell(4, 1, 'Prix', 0, 0, 'L');
$pdf->cell(5, 1, utf8_decode('Image'), 0, 0, 'L');

$pdf->SetFont('Arial', '',12);
$y = $y +2;
for($i=0;$i<$nbrG;$i++){
    $pdf->setXY($x,$y);
    $pdf->cell(3.5,1,$liste[$i]['nom'],0,0,'C');
    $pdf->SetXY($x+8,$y);
    $pdf->cell(1,1,$liste[$i]['prix'],0,0,'C');
    $pdf->Image('./../images/'.$liste[$i]['image'],$x+12,$y,1.5,'jpg');
    
    $y = $y + 2;
}

$pdf->Output();




