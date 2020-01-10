<?php

$host = "10.11.159.20";
$port = "5432";
$bdd = "0_traceur_livreur";
$user = "postgres";
$pass = "postgres";

$connec = pg_connect("host=".$host." port=".$port." dbname=".$bdd." user=".$user." password=".$pass);