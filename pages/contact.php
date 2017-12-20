<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-8">
        <h1>Vous avez une suggestion ?</h1>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 bord2">
        <form id="formulairecontact">
            <div class="form-group">
                <input type="text" class="form-control" name="login" id="login" placeholder="Entrez votre email">
            </div>
            <div class="form-group">
                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Dites nous ce que vous pensez"></textarea>
            </div>
            <button type="submit" name="connexion" id="connexion" class="btn btn-danger">Nous Contacter</button>
            </br>
            <?php
            if (isset($erreur)) {
                print $erreur;
            }
            ?>
        </form>
    </div>
</div>
<div class="row bord">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2539.9154789903705!2d3.771903115439909!3d50.46129857947675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c257f04b741b15%3A0x9ae13b12defa1286!2sRue+de+la+Station+53%2C+7334+Saint-Ghislain!5e0!3m2!1sfr!2sbe!4v1511431971754" allowfullscreen></iframe>
</div>