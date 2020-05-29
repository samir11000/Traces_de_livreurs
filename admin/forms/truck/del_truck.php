<?php
    include '../../../assets/connexion_bdd.php';

    if(isset($_POST['searchImmat']) && $_POST['searchImmat'] != "")
    {
        $result = pg_prepare($connec, "my_query", "DELETE FROM camion WHERE numero_immat_camion like $1;");
        $result = pg_execute($connec, "my_query", array($_POST['searchImmat']."%"));
        if(!isset($_SESSION["successful"]))
        {
            session_start();
            $_SESSION["successful"] = array("Le(s) camions(s) ayant dans leur(s) plaque : ".$_POST['searchImmat']." a(ont) été supprimé(s) de la base de données.");
        }
        header('location: camion.php');
    }
    else
    {
        {
            session_start();
            if(!isset($_SESSION["register_errors"]))
            {
                $_SESSION["register_errors"] = array("La plaque d'immatriculation est incorrect !");
            }
            header('location: camion.php');
        }
    }