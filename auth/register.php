<?php

include '../assets/connexion_bdd.php';
include '../assets/config.php';
include 'users.php';

session_start();

$user = new registerUser($_POST);

function CheckEmpty($obj,$func,$err)
{
    if(empty($func)){
        $obj->addError($err);
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){ // Check if the incomming request is a POST request

    CheckEmpty($user,$user->getLastname(),"Veuillez rentrer un nom.");
    CheckEmpty($user,$user->getFirstname(),"Veuillez rentrer un prénom.");

    if(empty($user->getLogin())){
        $user->addError("Veuillez rentrer un login");
    } else{
        // Prepare a select statement
        $sql = 'SELECT id_utilisateur FROM utilisateur WHERE login_utilisateur = $1';
        
        if($stmt = pg_prepare($connec, "my_querry",$sql)){

            if($result = pg_execute($connec, "my_querry", array($user->getLogin())))
            {
                
                if(pg_num_rows($result) == 1)
                    $user->addError("Ce login est déjà utilisé");
            } else{
                echo "Une erreur est apparue, veuillez réessayer plus tard";
            }
        }
    }

    if(empty($user->getUsername())){
        $user->addError("Veuillez rentrer un nom d'utilisateur");
    } else{
        // Prepare a select statement
        $sql = 'SELECT id_utilisateur FROM utilisateur WHERE login_utilisateur = $1';
        
        if($stmt = pg_prepare($connec, "my_querry2",$sql)){
            
            // Set parameters
            $param_username = trim($_POST["username"]);

            if($result = pg_execute($connec, "my_querry2", array($user->getUsername())))
            {
                
                if(pg_num_rows($result) == 1)
                    $user->addError("Ce nom d'utilisateur est déjà utilisé");
            } else{
                echo "Une erreur est apparue, veuillez réessayer plus tard";
            }
        }
    }
    
    // Validate password
    if(empty($user->getPass())){
        $user->addError("Veuillez rentrer un mot de passe !");     
    } else if(strlen($user->getPass()) < 6){
        $user->addError("Le mot de passe doit être d'au moins 6 caractères");
    }
    
    // Validate confirm password
    CheckEmpty($user,$user->getConfirmedPass(),"Veuillez confirmer le mot de passe.");

    if($user->getPass() != $user->getConfirmedPass()){
        $user->addError("Les mot de passe ne sont pas les mêmes");
    }
    
    var_dump($user);

    // Check input errors before inserting in database
    if(empty($user->getError())){
        // Prepare an insert statement
        $sql = "INSERT INTO utilisateur (login_utilisateur, mdp_utilisateur, nom_utilisateur, prenom_utilisateur, type_utilisateur) VALUES ($1, $2, $3, $4, 1)";
         
        if($stmt = pg_prepare($connec, "my_querry3",$sql)){
            // Bind variables to the prepared statement as parameters
            $param_username = $user->getUsername();
            $param_password = password_hash($user->getPass(), PASSWORD_DEFAULT); // Creates a password hash

            if($result = pg_execute($connec, "my_querry3", array($param_username,$param_password, $user->getLastname(), $user->getFirstname()))){
                // Redirect to login page
                header("location: ../index.php");
            } else{
                echo "Une erreur est apparue, veuillez réessayer plus tard";
            }
        }
    } else {
        $_SESSION["register_errors"]=$user->getError();
        header("location: ../inscription.php");
    }
    
    // Close connection
    pg_close($connec);
}