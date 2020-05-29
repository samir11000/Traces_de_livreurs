<?php
    include '../../../assets/connexion_bdd.php';
    include '../../../assets/querrySimplifier.php';

    $req = new querrySimplifier($connec);
    
    if(isset($_POST['customerSurname']) && $_POST['customerSurname'] != "")
    {
        session_start();
        $city = strtoupper($_POST['customerCity']);
        $city = $req->quickRequest('SELECT id_ville FROM ville WHERE nom_ville = \'' .$city. '\';')[0];
        if($city != "")
        {
            $result = pg_prepare($connec, "my_query", "INSERT INTO client (nom_client,prenom_client,adresse_client,tel_client,id_ville) VALUES ($1,$2,$3,$4,$5);");
            $result = pg_execute($connec, "my_query", array($_POST['customerSurname'],$_POST['customerName'],$_POST['customerAddress'],$_POST['customerNumber'],$city));
            if(!isset($_SESSION["successful"]))
                    {
                        $_SESSION["successful"] = array("Le client ayant pour nom : ".$_POST['customerSurname']." a été ajouté à la base de données.");
                    }
            header('location: customer.php');
        }
        else
        {
            if(!isset($_SESSION["register_errors"]))
                {
                    session_start();
                    $_SESSION["register_errors"] = array("Il y a une erreur dans la saisie des champs !");
                }
            header('location: customer.php');
        }
    }
    else{
        if(!isset($_SESSION["register_errors"]))
                {
                    session_start();
                    $_SESSION["register_errors"] = array("Il y a une erreur dans la saisie des champs !");
                }
        header('location: customer.php');
    }