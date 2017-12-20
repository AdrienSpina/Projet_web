<?php
if (!isset($_SESSION['client'])) {
    print "Pas authentifié";
} else {
    if (!isset($_SESSION['panier'])) {
        print "pas de panier";
    } else {
        $pan = new Vue_panierDB($cnx);
        $liste_pan = $pan->getVue_panier($_SESSION['client'], $_SESSION['panier']);
        $total = $pan->getMontantTotal($_SESSION['client'], $_SESSION['panier']);
        if (isset($_GET['supprimer'])) {
            extract($_GET, EXTR_OVERWRITE);
            $pan = new Pan_prodDB($cnx);
            $pan->delete_Produit($_SESSION['panier'], $id_prod);
            ?>
            <meta http-equiv = "refresh": content = "0;url=index.php?page=panier.php">
            <?php
        }
        if (isset($_GET['vider'])) {
            $pan = new Pan_prodDB($cnx);
            $pan->vide_Panier($_SESSION['panier']);
        }
        if (isset($_GET['commander'])) {
            $com = new CommandeDB($cnx);
            $recup_commande = $com->addCommande($_SESSION['panier'], (int) $total[0]);
            $panier = new PanierDB($cnx);
            $panier->inactiv_Panier($_SESSION['client']);
            $panier->create_Panier($_SESSION['client']);
            $recup_panier = $panier->getPanier($_SESSION['client']);
            $_SESSION['panier'] = $recup_panier[0]->id_panier;
            $_SESSION['com'] = 1;
            ?>
            <meta http-equiv = "refresh": content = "0;url=index.php?page=accueil.php">
            <?php
        }
        if (isset($liste_pan)) {
            //var_dump($total);
            $nbrProds = count($liste_pan);
            if ($nbrProds > 0) {
                ?>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-11">
                        <h2 class="txtVert">Votre panier :</h2>
                    </div>                             
                </div>
                <?php
                for ($i = 0; $i < $nbrProds; $i++) {
                    $id_prodd = $liste_pan[$i]['ID_PRODUIT'];
                    ?>
                    <div class="row" id="prod">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <img src="admin/images/<?php print $liste_pan[$i]['IMAGE']; ?>" class="img-fluid" alt="Produit"/>
                        </div>
                        <div class="col-sm-3 text-center">                        
                            <br/>
                            <div class="row">
                                <div class="col-sm-12 txtcentrer">
                                    <?php
                                    print utf8_decode($liste_pan[$i]['NOM']);
                                    ?>
                                </div>                             
                            </div>
                            <div class="row">
                                <div class="col-sm-12 txtcentrer">
                                    <br/>
                                    <?php
                                    print utf8_decode($liste_pan[$i]['PRIX']);
                                    ?>
                                    €
                                </div>                             
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <br/>
                            <br/>
                            <span contenteditable="true" name="quantite" class="ecart" id="<?php print $liste_pan[$i]['id_pan_prod']; ?>">
                                <b><?php print $liste_pan[$i]['quantite']; ?></b>
                            </span>
                        </div>   
                        <div class="col-sm-1">
                            <br/>
                            <br/>
                            <form>
                                <input type="hidden" class="form-control" name="id_prod" id="id_prod" value="<?php print $id_prodd ?>">
                                <button type="submit" class="btn btn-warning" name="supprimer" id="supprimer">Supprimer</button>
                            </form>
                        </div>   
                    </div>
                    <?php
                } //fin for $i
                ?>
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-1">
                        <form>
                            <button type="submit" class="btn btn-danger" name="vider" id="vider">Vider</button>
                        </form>
                    </div>
                    <div class="col-sm-5">
                    </div>
                    <div class="col-sm-2">
                        MONTANT TOTAL : <b><?php print $total[0]; ?>€</b>
                    </div>
                    <div class="col-sm-2">
                        <form>
                            <button type="submit" class="btn btn-success" name="commander" id="commander">Finaliser ma commande</button>
                        </form>
                    </div>
                </div>

                <?php
            }//fin if nbrCakes > 0
        }//fin if isset $liste_pan
        else {
            ?>
            <div class="col-sm-12">Votre panier est vide, Consultez la section produits pour le remplir !</div>
            <?php
        }
    }
}
?>
