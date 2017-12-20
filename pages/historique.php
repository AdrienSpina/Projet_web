<?php
if (!isset($_SESSION['client'])) {
    print "Pas authentifié";
} else {
    // pour la suite on utilise vue_commandeDB pour afficher les commandes dans une boucle et on utilise la vue pour les paniers inactifs dans une boucle imbriquée
    // getVue_panier_inactif dans la vue_panierDB
    $com = new Vue_commandeDB($cnx);
    $liste_com = $com->getRecup_commande($_SESSION['client']);
    if (isset($liste_com)) {
        //var_dump($total);
        $nbrComs = count($liste_com);
        if ($nbrComs > 0) {
            ?>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-11">
                    <h2 class="txtVert">Vos commandes :</h2>
                </div>                             
            </div>
            <?php
            for ($i = 0; $i < $nbrComs; $i++) {
                ?>
                <div class="row" id="prod">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">
                        <b>Date : </b>
                        <?php
                        print $liste_com[$i]['DATE_COMMANDE'];
                        ?>
                    </div>
                    <div class="col-sm-3">
                        <b>Montant Total :</b>
                        <?php
                        print utf8_decode($liste_com[$i]['PRIX_TOTAL']);
                        ?>
                        €
                    </div>
                    <div class="col-sm-2 text-center">                                                    
                        <div class="col-sm-1">
                            <button class="btn" type="button" data-toggle="collapse" data-target="#collapseExample<?php print $i; ?>" aria-expanded="false" aria-controls="collapseExample">
                                Panier
                            </button>
                        </div> 
                    </div>
                    <div class="col-sm-3">
                        <div class="collapse" id="collapseExample<?php print $i; ?>">
                            <div class="card card-body">
                                <?php
                                $pan = new Vue_panierDB($cnx);
                                $liste_pan = $pan->getVue_panier_inactif($liste_com[$i]['ID_PANIER']);
                                $nbrPan = count($liste_pan);
                                for ($j = 0; $j < $nbrPan; $j++) {
                                    print $liste_pan[$j]['quantite'];
                                    ?> <?php print $liste_pan[$j]['NOM']; ?> <?php print $liste_pan[$j]['PRIX']; ?>€<br/>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>   
                </div>
                <?php
            } //fin for $i
        }//fin if nbrComs > 0
    }//fin if isset $liste_com
    else {
        ?>
        <div class="col-sm-12">Erreur</div>
        <?php
    }
}