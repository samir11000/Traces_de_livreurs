<?php

include '../assets/connexion_bdd.php';

$username = $password = $confirm_password = $lastname = $firstname = $email = $confirm_email = "";
$username_err = $password_err = $confirm_password_err = $lastname_err = $firstname_err = $email_err = $confirm_email_err =  "";

var_dump($_GET);

if($_SERVER["REQUEST_METHOD"] == "GET"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Veuillez rentrer un nom d'utilisateur";
    } else{
        // Prepare a select statement
        $sql = 'SELECT id_utilisateur FROM utilisateur WHERE login_utilisateur = $1';
        
        if($stmt = pg_prepare($connec, "my_querry",$sql)){
            
            // Set parameters
            $param_username = trim($_POST["username"]);

            if($result = pg_execute($dbconn, "my_query", $param_username))
            {
                
                if(pg_num_rows($result) == 1){
                    $username_err = "Ce nom d'utilisateur est déjà utilisé";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Une erreur est apparue, veuillez réessayer plus tard";
            }
        }
         
        // Close statement
        pg_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["pass"]))){
        $password_err = "Veuillez rentrer un mot de passe !";     
    } elseif(strlen(trim($_POST["pass"])) < 6){
        $password_err = "Le mot de passe doit être d'au moins 6 caractères";
    } else{
        $password = trim($_POST["pass"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["pass2"]))){
        $confirm_password_err = "Veuillez confirmer le mot de passe !";     
    } else{
        $confirm_password = trim($_POST["pass2"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Les mot de passe ne sont pas les mêmes";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO utilisateur (login_utilisateur, mdp_utilisateur) VALUES ($1, $2)";
         
        if($stmt = pg_prepare($connec, "my_querry",$sql)){
            // Bind variables to the prepared statement as parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            if($result = pg_execute($dbconn, "my_query", array($param_username,$param_password))){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Une erreur est apparue, veuillez réessayer plus tard";
            }
        }
         
        // Close statement
        pg_close($stmt);
    }
    
    // Close connection
    pg_close($connec);
}