<?php

if (!isset($_SESSION['client'])) {
    print "Pas authentifié";
} else {
    if (!isset($_SESSION['panier'])) {
        print "pas de panier";
    } else {
        print "on est bon ma gueule";
    }
}
