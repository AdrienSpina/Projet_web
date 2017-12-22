$(document).ready(function () {
    //code pour le tableau éditable
    $("span[id]").click(function () {
        /*
         $(this).removeClass('cke_editable');        
         $(this).removeClass('cke_editable_inline');
         $(this).removeClass('cke_contents_ltr');
         $(this).removeClass('cke_show_borders');
         $(this).removeAttr('aria-label');
         $(this).removeAttr('aria-describedby');
         $(this).removeAttr('title');
         */
        var valeur1 = $.trim($(this).text());
        //s'il fallait tester si on utilise edge :
        if (/Edge\/\d./i.test(navigator.userAgent)) {
            $(this).addClass("borderInput");
        }

        //2 lignes suivantes pour firefox
        //$(this).contentEditable = "true";
        //$(this).addClass("borderInput");

        var ident = $(this).attr("id");
        var name = $(this).attr("name");

        $(this).blur(function () {
            $(this).removeClass("borderInput");
            var valeur2 = $(this).text();
            valeur2 = $.trim(valeur2);

            if (valeur1 != valeur2)
            {
                var parametre = 'champ=' + name + '&id=' + ident + '&nouveau=' + valeur2;
                var retour = $.ajax({
                    type: 'GET',
                    data: parametre,
                    dataType: "json",
                    url: "./admin/lib/php/ajax/AjaxUpdatePanier.php",
                    success: function (data) {
                        console.log("success");
                        console.log(data['total']);
                        $('#montant').html(data['total']);
                    }
                });
                retour.fail(function (jqXHR, textStatus, errorThrown) {
                    //alert("Echec retour: " + textStatus + "\nerrorThrown: " + errorThrown);
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                });
            }
            ;
        });
    });
});


