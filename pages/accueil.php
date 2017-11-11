<?php
$info = new InfoclientDB($cnx);
$texte = $info->getInfoClient("accueil");
?>
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <h2 id="titre">Bienvenue sur Bella Spinazia</h2>
    </div>
</div>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-4">
        <h1 class="txtcentrer"><span class="badge badge-dark">Actualités</span></h1><br/>
        <?php
        print $texte[0]->TEXTE;
        ?>
    </div>
    <div class="col-sm-6">
        <div id="gt_carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="./admin/images/carousel1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./admin/images/carousel2.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./admin/images/carousel3.jpg" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./admin/images/carousel4.png" alt="Fourth slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./admin/images/carousel5.jpg" alt="Five slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#gt_carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#gt_carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div> 
    </div>
</div>

