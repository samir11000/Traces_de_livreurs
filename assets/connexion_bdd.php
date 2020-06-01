<?php

$host = "postgresql-samir.alwaysdata.net";
$port = "5432";
$bdd = "samir_bba";
$user = "samir";
$pass = "SamirBBA11";

$connec = pg_connect("host=".$host." port=".$port." dbname=".$bdd." user=".$user." password=".$pass);