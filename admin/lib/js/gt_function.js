//attendre que toute la page soit chargée
$(document).ready(function () {
    //TRAITEMENT DU CAROUSEL SUR PUBLIC/PAGES/ACCUEIL.PHP
    $("#gt_carousel").carousel({
        interval: 2500,
        pause: false
    });
    //TRAITEMENT DU CODE SECRET SUR PUBLIC/PAGES/ADMINISTRATION.PHP
    $("#adminbutton").hide();
    $("#1").click(function () {
        $("#3").click(function () {
            $("#9").click(function () {
                $("#1").click(function () {
                    $("#adminbutton").show();
                    $("#0,#1,#2,#3,#4,#5,#6,#7,#8,#9").hide();
                });
            });
        });
    });
});


