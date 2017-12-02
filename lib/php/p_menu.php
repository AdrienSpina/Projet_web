<?php
//on a besoin des classe Type_produitDB et Type_produit
$types = new Type_produitDB($cnx);
$tabTypes = $types->getType_produit();
$nbrTypes = count($tabTypes);
?>
<div id="menu">
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="navbar-brand">
            Menu
        </div>
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
                    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get" id="form_commande"> 
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
                        <a class="nav-link" href="index.php?page=inscription.php">Inscription  <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?page=connexion.php">Connexion  <span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?page=panier.php">Panier  <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?page=deco.php">Deconnexion  <span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                }
                ?>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?page=contact.php">Contact  <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?page=administration.php">Administration  <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Rechercher un produit" aria-label="Rechercher un produit">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
        </div>
    </nav>
</div>