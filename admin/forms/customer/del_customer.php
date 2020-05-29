<?php
    include '../../../assets/connexion_bdd.php';

    if(isset($_POST['searchCustomerName']) && $_POST['searchCustomerName'] != "")
    {
        $result = pg_prepare($connec, "my_query", "DELETE FROM client WHERE nom_client like $1;");
        $result = pg_execute($connec, "my_query", array($_POST['searchCustomerName']."%"));
        if(!isset($_SESSION["successful"]))
        {
            session_start();
            $_SESSION["successful"] = array("Le(s) client(s) ayant un nom contenant : \"".$_POST['searchCustomerName']."\" a(ont) été supprimé(s) de la base de données.");
        }
        header('location: customer.php');
    }
    else
    {
        {
            session_start();
            if(!isset($_SESSION["register_errors"]))
            {
                $_SESSION["register_errors"] = array("Le nom du client est incorrect / n'éxiste pas !");
            }
            header('location: customer.php');
        }
    }