<?php

session_start();

include '../assets/connexion_bdd.php';
include '../assets/querrySimplifier.php';

$sql = new querrySimplifier($connec);

if(isset($_SESSION['locale']))
{
    if(isset($_COOKIE['auth']))
    {
        unset($_COOKIE['auth']);
        setcookie("auth", "", 1, "/");
        $sql->preparedStatement("UPDATE utilisateur SET auth_token=null WHERE id_utilisateur=$1",array($_SESSION['locale'][2]));
    }
    $_SESSION = array();
    session_destroy();
    header('location: ../index.php');
} else {
    header('location: ../index.php');
}