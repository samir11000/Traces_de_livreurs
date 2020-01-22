<?php

include '../assets/connexion_bdd.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    session_start();

    if(empty(trim($_POST["username"]))){
        $login_err = "Erreur : le champ \"login\" est vide";
    } else{
        $login = trim($_POST["username"]);
    }

    if(empty(trim($_POST["pass"]))){
        $password_err = "Erreur : le champ \"Mot de passe\" est vide";
    } else{
        $password = trim($_POST["pass"]);
    }

    if(empty($login_err) && empty($password_err)){
        
        // Prepare an insert statement
        $sql = "SELECT * FROM utilisateur WHERE login_utilisateur = $1";        
        if($stmt = pg_prepare($connec, "my_querry",$sql)){
            $result = pg_execute($connec, "my_querry",array($login));
            $result = pg_fetch_array($result);

            if(password_verify($password,$result['mdp_utilisateur']))
            {
                $connected = TRUE;
                $_SESSION["locale"] = array($connected,$result['prenom_utilisateur']);
                echo 'Bienvenue '.$result['prenom_utilisateur'].' !';
                header('location: ../index.php');
            } else
            {
                echo 'mot de passe incorect ! ';
            }
        }
    }
    
    // Close connection
    pg_close($connec);
}