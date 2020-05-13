<?php

include '../assets/connexion_bdd.php';
include '../assets/querrySimplifier.php';
include '../assets/config.php';

$t = new querrySimplifier($connec);

print($t->quickRequest("SELECT COUNT(id_livreur) FROM livreur")[0]);