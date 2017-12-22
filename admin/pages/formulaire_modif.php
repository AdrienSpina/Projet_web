<?php
$types = new Type_produitDB($cnx);
$tabTypes = $types->getType_produit();
$nbrTypes = count($tabTypes);
if (isset($_GET['modifdeprod'])) {
    //permet d'extraire les champs du tableau $_GET pour simplifier
    extract($_GET, EXTR_OVERWRITE);
    if (empty($nom) || empty($id_type_produit) || empty($prix) || empty($description) || empty($image) || empty($id_prod)) {
        $erreur = "Veuillez remplir tous les champs";
    } else {
        $prod = new ProduitDB($cnx);
        $prod->modifProduit($_GET);
        ?>
        <meta http-equiv = "refresh": content = "0;url=index.php?page=tab_dynamique.php">
        <?php
    }
}
?>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-6">
        <h2><i>Modification de produit</i></h2>
    </div>
</div>
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <form id="formulaireajprod">
            <div class="form-group">
                <input type="number" class="form-control" name="id_prod" id="id_prod" placeholder="ID DU PRODUIT">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="type">Type de produit :</label>
                <select name="id_type_produit" id="id_type_produitAjax">
                    <?php
                    for ($i = 0; $i < $nbrTypes; $i++) {
                        ?>
                        <option value="<?php print $tabTypes[$i]->ID_TYPE_PRODUIT; ?>">
                            <?php print ($tabTypes[$i]->TYPE_PRODUIT); ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="prix" id="prix" placeholder="Prix">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="description" id="description" placeholder="Description">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="image" id="image" placeholder="Lien de l'Image">
            </div>
            <button type="submit" class="btn btn-success" name="modifdeprod" id="modifdeprod">Modifier le produit</button>
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

