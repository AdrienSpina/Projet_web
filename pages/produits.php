<?php
if (isset($_GET['id'])) {
    //print $_GET['id'];
    $prod = new Vue_produitDB($cnx);
    $liste = $prod->getVue_produitType($_GET['id']); // le get[id] represente l'id du type de produit choisis dans le dropdown du menu
    //var_dump($liste);
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
            ?>
            <div class="row" id="prod">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">
                    <img src="admin/images/<?php print $liste[$i]['image']; ?>" class="img-fluid" alt="Produit"/>
                </div>
                <div class="col-sm-3 text-center">                        
                    <br/>
                    <div class="row">
                        <div class="col-sm-12 txtcentrer">
                            <?php
                            print utf8_decode($liste[$i]['nom']);
                            ?>
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
                            print utf8_decode($liste[$i]['description']);
                            ?>
                        </div>
                    </div>
                </div>   
                <div class="col-sm-1">
                    <?php
                    if (isset($_SESSION['client'])) {
                        ?>
                        <br/>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Ajouter au panier <img src="./admin/images/cart2.png"></button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form id="formulaireajoutpanier" method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="col-form-label" for="qte">Quantite</label>
                                                <input type="number" class="form-control" name="qte" id="qte" min="1" max="50">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary" name="ajouter" id="ajouter">Ajouter</button>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['ajouter'])) {
                                        extract($_POST, EXTR_OVERWRITE);
                                        $pan = new Pan_prodDB($cnx);
                                        $pan->ajout_Produit($_SESSION['panier'], $liste[$i]['id_produit'], $qte);
                                        var_dump($liste[$i]['id_produit']);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <br/>
                        Pour ajouter au panier, inscrivez-vous
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
                <p>De nouveaux produits arrivent prochainement !</p>
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