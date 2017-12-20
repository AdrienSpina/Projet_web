<?php
if (isset($_GET['inscription'])) {
    //permet d'extraire les champs du tableau $_GET pour simplifier
    extract($_GET, EXTR_OVERWRITE);
    if (empty($nom) || empty($prenom) || empty($adresse) || empty($ville) || empty($cp) || empty($email) || empty($login) || empty($mp) || empty($mp2) || empty($tel)) {
        $erreur = "Veuillez remplir tous les champs";
    } else {
        $client = new ClientDB($cnx);
        $client->addClient($_GET);
        ?>
        <meta http-equiv = "refresh": content = "0;url=index.php?page=connexion.php">
        <?php
    }
}
?>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-8">
        <h2>Inscrivez-vous, c'est gratuit !</h2>
    </div>
</div>
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <form id="formulaireinscription">
            <div class="form-group">
                <label class="col-form-label" for="nom">Nom</label>
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="prenom">Prenom</label>
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="adresse">Adresse</label>
                <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="ville">Ville</label>
                <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="cp">Code Postal</label>
                <input type="text" class="form-control" name="cp" id="cp" placeholder="CP">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="login">Identifiant</label>
                <input type="text" class="form-control" name="login" id="login" placeholder="Login">
            </div>
            <div class="form-group">
                <label for="mp">Mot de Passe</label>
                <input type="password" class="form-control" name="mp" id="mp" placeholder="Entrez votre mot de passe">
                <input type="password" class="form-control" name="mp2" id="mp2" placeholder="Confirmez votre mot de passe">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="tel">N° Telephone</label>
                <input type="text" class="form-control" name="tel" id="tel" placeholder="xxxx/xx.xx.xx">
            </div>
            <button type="submit" class="btn btn-primary" name="inscription" id="inscription">S'inscrire</button>
            <div>
                <?php
                if (isset($erreur)) {
                    print $erreur;
                }
                ?>
            </div>
        </form>
    </div>
    <div class="col-sm-3"></div>
</div>
