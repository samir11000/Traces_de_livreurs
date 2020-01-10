<?php

include '../assets/connexion_bdd.php';

if ($connec == TRUE)
{
    echo utf8_decode("Vous êtes connectés à la base de données");
} else {
    echo utf8_decode("echec de connexion à la base de données");
}