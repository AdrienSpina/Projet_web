<?php
// INDEX PUBLIC BELLA SPINAZIA
include './admin/lib/php/adm_liste_include.php';
$cnx = Connexion::getInstance($dsn, $user, $pass);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bella Spinazia</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="admin/lib/css/Bootstrap/css/bootstrap.css"/>
        <script src="admin/lib/js/jquery-3.2.1.js"></script>
        <script src="admin/lib/css/Bootstrap/js/bootstrap.js"></script>
        <script src="admin/lib/js/gt_functionAjax2.js"></script>
        <script type="text/javascript" src="admin/lib/js/dist/jquery.validate.js"></script>
        <script src="admin/lib/js/gt_functionsVal.js"></script>
        <script src="admin/lib/js/gt_function.js"></script>
        <link rel="stylesheet" type="text/css" href="admin/lib/css/style_bellaspinazia.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header>
                        <img src="./admin/images/header.jpg" class="img-fluid" alt="Header">
                    </header>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class ="col-sm-12">
                    <?php
                    if (file_exists("./lib/php/p_menu.php")) {
                        include("./lib/php/p_menu.php");
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <section id="contenu">
                        <?php
                        /* le contenu change en fonction de la navigation */
                        if (!isset($_SESSION['page'])) {
                            $_SESSION['page'] = "./pages/accueil.php";
                        } else {

                            if (isset($_GET['page'])) {
                                //print $_GET['page'];
                                $_SESSION['page'] = "./pages/" . $_GET['page'];
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
                    <footer>
                        <?php
                        if (file_exists("./lib/php/p_footer.php")) {
                            include("./lib/php/p_footer.php");
                        }
                        ?>
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
