<?php
if (isset($_GET['id'])) {
    //print $_GET['id'];
    $prod = new Vue_produitDB($cnx);
    $liste = $prod->getVue_produitType($_GET['id']); // le get[id] represente l'id du type de produit choisis dans le dropdown du menu
    //var_dump($liste);
}
if (isset($_POST['ajouter'])) {
    extract($_POST, EXTR_OVERWRITE);
    $pan = new Pan_prodDB($cnx);
    $pan->ajout_Produit($_SESSION['panier'], $id_prod, $qte);
}
if (isset($liste)) {
    $nbrProds = count($liste);
    if ($nbrProds > 0) {
        ?>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-11">
                <h2 class="txtVert"><?php print ($liste[0]['type_produit']); ?></h2>
            </div>                             
        </div>
        <?php
        for ($i = 0; $i < $nbrProds; $i++) {
            $id_prodd = $liste[$i]['id_produit'];
            ?>
            <div class="row" id="prod">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">
                    <div class="imach"><img src="admin/images/<?php print $liste[$i]['image']; ?>" class="img-fluid" alt="Produit"/></div>
                </div>
                <div class="col-sm-3 text-center">                        
                    <br/>
                    <div class="row">
                        <div class="col-sm-12 txtcentrer">
                            <b><?php
                                print utf8_decode($liste[$i]['nom']);
                                ?></b>
                        </div>                             
                    </div>
                    <div class="row">
                        <div class="col-sm-12 txtcentrer">
                            <br/>
                            <?php
                            print utf8_decode($liste[$i]['prix']);
                            ?>
                            €
                        </div>                             
                    </div>
                </div>
                <div class="col-sm-2">
                    <br/>
                    <p>
                        <button class="btn" type="button" data-toggle="collapse" data-target="#collapseExample<?php print $i; ?>" aria-expanded="false" aria-controls="collapseExample">
                            Description
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample<?php print $i; ?>">
                        <div class="card card-body">
                            <?php
                            print $liste[$i]['description'];
                            ?>
                        </div>
                    </div>
                </div>   
                <div class="col-sm-2">
                    <?php
                    if (isset($_SESSION['client'])) {
                        ?>
                        <br/>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#<?php print $i; ?>">Ajouter au panier <img src="./admin/images/cart2.png"></button>
                        <div class="modal fade" id="<?php print $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form id="formulaireajoutpanier" method="post">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="id_prod" id="id_prod" value="<?php print $id_prodd ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="qte">Quantite</label>
                                                <input type="number" class="form-control" name="qte" id="qte" min="1" max="50">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-success" name="ajouter" id="ajouter">Ajouter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <br/>
                        <p>Pour ajouter au panier, inscrivez-vous</p>
                        <?php
                    }
                    ?>
                </div>   
            </div>
            <?php
        } //fin for $i
        ?>
        <div class="row">
            <div class="col-sm-12 txtcentrer">
                De nouveaux produits arrivent prochainement !
            </div>
        </div>

        <?php
    }//fin if nbrCakes > 0
    else {
        ?>
        <div class="col-sm-12">Aucun produit ne correspond à votre choix.</div>
        <?php
    }
}//fin if isset $liste
else {
    ?>
    <div class="col-sm-12">Aucun produit ne correspond à votre choix.</div>
    <?php
}
?>