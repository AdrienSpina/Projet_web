<?php
//INDEX ADMIN BELLA SPINAZIA
include './lib/php/adm_liste_include.php';
$cnx = Connexion::getInstance($dsn, $user, $pass);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bella Spinazia</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="lib/css/Bootstrap/css/bootstrap.css"/>
        <script src="lib/js/jquery-3.2.1.js"></script>
        <script src="lib/css/Bootstrap/js/bootstrap.js"></script>
        <script src="lib/js/gt_functionsAjax.js"></script>
        <script type="text/javascript" src="lib/js/dist/jquery.validate.js"></script>
        <script src="lib/js/gt_functionsVal.js"></script>
        <script src="lib/js/gt_function.js"></script>
        <link rel="stylesheet" type="text/css" href="lib/css/style_bellaspinazia.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header>
                        <img src="./images/header.jpg" class="img-fluid" alt="Header">
                    </header>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class ="col-sm-12">
                    <?php
                    if (file_exists("./lib/php/a_menu.php")) {
                        include("./lib/php/a_menu.php");
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <section id="contenu">
                        <?php
                        //on arrive sur le site
                        if (!isset($_SESSION['admin'])) {
                            ?>
                            <meta http-equiv = "refresh": content = "0;url=../index.php?page=accueil.php">
                            <?php
                        } else {
                            /* le contenu change en fonction de la navigation */
                            if (!isset($_SESSION['page'])) {
                                $_SESSION['page'] = "./pages/adm_accueil.php";
                            } else {

                                if (isset($_GET['page'])) {
                                    //print $_GET['page'];
                                    $_SESSION['page'] = "./pages/" . $_GET['page'];
                                }
                            }
                        }
                        //print $_SESSION['page'];  
                        if (file_exists($_SESSION['page'])) {
                            include $_SESSION['page'];
                        } else {
                            print "OUPS!!!!!";
                        }
                        ?>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
