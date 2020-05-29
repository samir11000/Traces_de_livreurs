<?php
    include '../../../assets/connexion_bdd.php';

    if(isset($_POST['searchDeliveryName']) && $_POST['searchDeliveryName'] != "")
    {
        $result = pg_prepare($connec, "my_query", "DELETE FROM livreur WHERE nom_livreur like $1;");
        $result = pg_execute($connec, "my_query", array($_POST['searchDeliveryName']."%"));
        if(!isset($_SESSION["successful"]))
        {
            session_start();
            $_SESSION["successful"] = array("Le(s) livreurs(s) ayant un nom contenant : \"".$_POST['searchDeliveryName']."\" a(ont) été supprimé(s) de la base de données.");
        }
        header('location: delivery.php');
    }
    else
    {
        {
            session_start();
            if(!isset($_SESSION["register_errors"]))
            {
                $_SESSION["register_errors"] = array("Le nom du livreur est incorrect / n'éxiste pas !");
            }
            header('location: delivery.php');
        }
    }