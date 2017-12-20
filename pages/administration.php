<?php
if (isset($_GET['connection'])) {
    //permet d'extraire les champs du tableau $_GET pour simplifier
    extract($_GET, EXTR_OVERWRITE);
    if (empty($pseudo) || empty($mdp)) {
        $erreur = "Veuillez remplir tous les champs";
    } else {
        $admin = new AdminDB($cnx);
        $log = $admin->getLogAdmin($pseudo, $mdp); // on verifie si le client est bien dans la DB
        if (is_null($log)) {
            $erreur = "<br/>Données incorrectes";
        } else {
            $_SESSION['admin'] = 1; // Vous etes en session en tant qu'admin
            ?>
            <meta http-equiv = "refresh": content = "0;url=./admin/index.php?page=adm_accueil.php">
            <?php
        }
    }
}
?>
<div class="row">
    <div class="col-sm-12 txtcentrer">
        <h2>Entrez le code secret</h2>
    </div>
    <br/>
    <?php
    if (isset($erreur)) {
        ?>
        <div clas="row">
            <div class="col-sm-12 txtcentrer">
                <?php print $erreur; ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<!--MOT DE PASSE ACTUEL : 1391-->
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-1"><div id="0">0</div></div>
    <div class="col-sm-1"><div id="1">1</div></div>
    <div class="col-sm-1"><div id="2">2</div></div>
    <div class="col-sm-1"><div id="3">3</div></div>
    <div class="col-sm-1"><div id="4">4</div></div>
    <div class="col-sm-1"><div id="5">5</div></div>
    <div class="col-sm-1"><div id="6">6</div></div>
    <div class="col-sm-1"><div id="7">7</div></div>
    <div class="col-sm-1"><div id="8">8</div></div>
    <div class="col-sm-1"><div id="9">9</div></div>
    <div class="col-sm-1"></div>
</div>
<div class="row">
    <div class="col-sm-12 txtcentrer">
        <div id="adminbutton"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_admin">Se Connecter</button></div>
        <div class="modal fade" id="modal_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="formulaireadmin" method="get">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>Administration</h2>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Login">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success" name="connection" id="connection">Connexion</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
