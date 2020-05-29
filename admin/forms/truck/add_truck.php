<?php
    include '../../../assets/connexion_bdd.php';

    if(isset($_POST['marqueCamion']) && $_POST['marqueCamion'] != "")
    {
        session_start();
        $result = pg_prepare($connec, "my_query", "INSERT INTO camion (marque_camion,model_camion,type_camion,date_premiere_circulation,consomation_moyenne,nb_km_camion,taille_reservoir_camion,numero_immat_camion,type_carburant) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9);");
        $result = pg_execute($connec, "my_query", array($_POST['marqueCamion'],$_POST['modelCamion'],$_POST['typeCamion'],$_POST['dateMsCamion'],$_POST['consCamion'],$_POST['kmCamion'],$_POST['reservCamion'],$_POST['numImmat'],$_POST['gasCamion']));
        if(!isset($_SESSION["successful"]))
                {
                    $_SESSION["successful"] = array("Le camion ayant pour plaque : ".$_POST['numImmat']." a été ajouté à la base de données.");
                }
        header('location: camion.php');
    }
    else{
        if(!isset($_SESSION["register_errors"]))
                {
                    session_start();
                    $_SESSION["register_errors"] = array("Il y a une erreur dans la saisie des champs !");
                }
        header('location: camion.php');
    }