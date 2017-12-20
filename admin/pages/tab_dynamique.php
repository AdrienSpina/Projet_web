<?php
include './lib/php/verifier_connexion.php';
?>
<h2 id="titre">Tableau dynamique</h2>
<br/>
<?php
$obj = new Vue_produitDB($cnx);
$liste = $obj->getVue_produit();
$nbrG = count($liste);
//var_dump($liste);
?>
<div class="row">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-9">
        <table class="table-responsive" id="products">
            <tr>
                <th colspan="5">
                    <a href="./pages/imprimer.php"><img src="./images/pdf.png" alt="pas affiché"></a>   Exporter le tableau en PDF
                </th>
            </tr>
            <tr>
                <th class="ecart">Id</th>
                <th class="ecart">Type</th>
                <th class="ecart">Nom</th>
                <th class="ecart">Prix</th>
                <th class="ecart">Description</th>
            </tr>
            <?php
            for ($i = 0; $i < $nbrG; $i++) {
                ?>
                <tr>
                    <td class="ecart"><?php print $liste[$i]['id_produit']; ?></td>
                    <td class="ecart"><?php print utf8_encode($liste[$i]['type_produit']); ?></td>
                    <td>
                        <span contenteditable="true" name="nom" class="ecart" id="<?php print $liste[$i]['id_produit']; ?>">
                            <?php print utf8_encode($liste[$i]['nom']); ?>
                        </span>
                    </td>
                    <td>
                        <span contenteditable="true" name="prix" class="ecart" id="<?php print $liste[$i]['id_produit']; ?>">
                            <?php print $liste[$i]['prix']; ?>
                        </span>
                    </td>
                    <td>
                        <span contenteditable="true" name="description" class="ecart" id="<?php print $liste[$i]['id_produit']; ?>">
                            <?php print $liste[$i]['description']; ?>
                        </span>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>