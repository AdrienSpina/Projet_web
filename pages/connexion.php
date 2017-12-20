<?php
if (isset($_GET['connexion'])) {
    //permet d'extraire les champs du tableau $_GET pour simplifier
    extract($_GET, EXTR_OVERWRITE);
    if (empty($login) || empty($mp)) {
        $erreur = "Veuillez remplir tous les champs";
    } else {
        $client = new ClientDB($cnx);
        $log = $client->getLogClient($login, $mp); // on verifie si le client est bien dans la DB
        if (is_null($log)) {
            $message = "<br/>Données incorrectes";
        } else {
            $_SESSION['client'] = $log[0]->ID_CLIENT; // quand on se connecte on recupere l'id du client
            $panier = new PanierDB($cnx);
            $recup_panier = $panier->getPanier($_SESSION['client']); // on verifie si le client possede bien un panier
            if (empty($recup_panier)) {
                $panier->create_Panier($_SESSION['client']); // si le panier n'existe pas on en crée un
                $recup_panier2 = $panier->getPanier($_SESSION['client']); // on recupere le panier que l'on vient de creer
                $_SESSION['panier'] = $recup_panier2[0]->id_panier; // on recupere l'id du panier
            } else {
                $_SESSION['panier'] = $recup_panier[0]->id_panier; // on recuper l'id du panier
                $com = new Vue_commandeDB($cnx);
                $recup_com = $com->getRecup_commande($_SESSION['client']); // on verifie si le client a deja commandé sur le site
                if (isset($recup_com)) {
                    $_SESSION['com'] = 1;
                }
            }
            ?>
            <meta http-equiv = "refresh": content = "0;url=index.php?page=accueil.php">
            <?php
        }
    }
}
?>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <form id="formulaireconnexion">
            <div class="form-group">
                <label class="col-form-label" for="formGroupExampleInput">Identifiant</label>
                <input type="text" class="form-control" name="login" id="login" placeholder="Entrez votre login">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mot de Passe</label>
                <input type="password" class="form-control" name="mp" id="mp" placeholder="Entrez votre mot de passe">
            </div>
            <button type="submit" name="connexion" id="connexion" class="btn btn-primary">Se Connecter</button>
            </br>
            <?php
            if (isset($erreur)) {
                print $erreur;
            }
            if (isset($message)) {
                print $message;
            }
            ?>
        </form>
        <div>
            Pas encore inscrit ? Rendez-vous <a href="index.php?page=inscription.php">ici</a>
        </div>
    </div>
</div>
