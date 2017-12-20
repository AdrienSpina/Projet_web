<?php
//on a besoin des classe Type_produitDB et Type_produit
$types = new Type_produitDB($cnx);
$tabTypes = $types->getType_produit();
$nbrTypes = count($tabTypes);
if(isset($_GET['recherche'])){
    extract($_GET, EXTR_OVERWRITE);
    if(!empty($cherche)){
        $goType = new Vue_produitDB($cnx);
        $recup_page = $goType->getVue_ProduitByName($cherche);
        ?>
        <meta http-equiv = "refresh": content = "0;url=index.php?page=produits.php&id=<?php print $recup_page[0];?>">
        <?php       
    }
}
?>
<div id="menu">
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?page=accueil.php"><img src="./admin/images/home.png"> Accueil<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="./admin/images/food.png"> Produits<span class="sr-only">(current)</span>
                    </a>
                    <form action="<?php //print $_SERVER['PHP_SELF']; ?>" method="get" id="form_commande"> 
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php
                            for ($i = 0; $i < $nbrTypes; $i++) {
                                ?>
                                <a class="dropdown-item" href="index.php?page=produits.php&id=<?php print $tabTypes[$i]->ID_TYPE_PRODUIT; ?>" value="<?php print $tabTypes[$i]->ID_TYPE_PRODUIT; ?>">
                                    <?php print ($tabTypes[$i]->TYPE_PRODUIT); ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </form>
                </li>
                <?php if (!isset($_SESSION['client'])) {
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?page=inscription.php"><img src="./admin/images/inscription.png"> Inscription<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?page=connexion.php"><img src="./admin/images/connexion.png"> Connexion<span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                } else {
                    $pan = new Vue_panierDB($cnx);
                    $liste_pan = $pan->getVue_panier($_SESSION['client'], $_SESSION['panier']);
                    $nr = count($liste_pan);
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?page=panier.php"><img src="./admin/images/cart2.png"> Panier <b>(<?php print $nr; ?>)</b><span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?page=deco.php"><img src="./admin/images/deco.png"> Deconnexion<span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                }
                ?>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?page=contact.php"><img src="./admin/images/location.png"> Contact<span class="sr-only">(current)</span></a>
                </li>
                <?php
                if (!isset($_SESSION['client'])) {
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?page=administration.php"><img src="./admin/images/key.png"> Admin<span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                }
                if (isset($_SESSION['com'])) {
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?page=historique.php"><img src="./admin/images/historique.png"> Historique<span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="cherche" id="cherche" placeholder="Rechercher un produit" aria-label="Rechercher un produit" autocomplete="off">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="recherche" id="recherche"><img src="./admin/images/loupe.png"></button>
            </form>
        </div>
    </nav>
</div>