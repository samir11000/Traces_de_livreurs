<?php
    include '../../../assets/connexion_bdd.php';
    include '../../../assets/querrySimplifier.php';

    $req = new querrySimplifier($connec);
    
    if(isset($_POST['deliverySurname']) && $_POST['deliverySurname'] != "")
    {
        session_start();
        $city = strtoupper($_POST['deliveryCity']);
        $city = $req->quickRequest('SELECT id_ville FROM ville WHERE nom_ville = \'' .$city. '\';')[0];
        if($city != "")
        {
            $result = pg_prepare($connec, "my_query", "INSERT INTO livreur (nom_livreur,prenom_livreur,adresse_livreur,date_naissance_livreur,date_obtention_permis,date_expiration_permis,num_permis,tel_livreur,id_ville) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9);");
            $result = pg_execute($connec, "my_query", array($_POST['deliverySurname'],$_POST['deliveryName'],$_POST['deliveryAddress'],$_POST['deliveryBirthdate'],$_POST['DeliveryLicenceDate'],$_POST['DeliveryLicenceExpirationDate'],$_POST['deliveryLicenceNb'],$_POST['deliveryPhoneNb'],$city));
            if(!isset($_SESSION["successful"]))
                    {
                        $_SESSION["successful"] = array("Le livreur ayant pour nom : ".$_POST['deliverySurname']." a été ajouté à la base de données.");
                    }
            header('location: delivery.php');
        }
        else
        {
            if(!isset($_SESSION["register_errors"]))
                {
                    session_start();
                    $_SESSION["register_errors"] = array("Il y a une erreur dans la saisie des champs !");
                }
            header('location: delivery.php');
        }
    }
    else{
        if(!isset($_SESSION["register_errors"]))
                {
                    session_start();
                    $_SESSION["register_errors"] = array("Il y a une erreur dans la saisie des champs !");
                }
        header('location: delivery.php');
    }