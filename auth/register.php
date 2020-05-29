<?php

include '../assets/connexion_bdd.php';
include '../assets/config.php';
include '../assets/users.php';
include '../assets/querrySimplifier.php';
include '../assets/emailHandler.php';

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){ // Check if the incomming request is a POST request

    $user = new registerUser($_POST);
    $sql = new querrySimplifier($connec);
    $emailSender = new emailHandler();

    // Check if the given value is empty, if it is, throw the error given
    function CheckEmpty($obj,$func,$err)
    {
        if(empty($func)){
            $obj->addError($err);
        }
    }

    CheckEmpty($user,$user->getParam("lastname"),"Veuillez rentrer un nom.");
    CheckEmpty($user,$user->getParam("firstname"),"Veuillez rentrer un prénom.");

    //check if empty, if empty, throw an error
    if(empty($user->getParam("login"))){
        $user->addError("Veuillez rentrer un login");
    } else{
        // Check if we can find the EXACT same login
        $sql->preparedStatement('SELECT id_utilisateur FROM utilisateur WHERE login_utilisateur = $1',array($user->getParam("login")));
        // if it exists, throw an error
        if(pg_num_rows($sql->getValue()) == 1)
            $user->addError("Ce login est déjà utilisé");
    } 

    //check if empty, if empty, throw an error
    if(empty($user->getParam("username"))){
        $user->addError("Veuillez rentrer un nom d'utilisateur");
    } else{
         // Check if we can find the EXACT same username
        $sql->preparedStatement('SELECT id_utilisateur FROM utilisateur WHERE login_utilisateur = $1',array($user->getParam("username")));
        // if it exists, throw an error
        if(pg_num_rows($sql->getValue()) == 1)
            $user->addError("Ce nom d'utilisateur est déjà utilisé");
    }
    
    // Validate password
    //if empty, throw an error
    if(empty($user->getParam("password"))){
        $user->addError("Veuillez rentrer un mot de passe !");
    // if less than 6 characters, throw an error
    } else if(strlen($user->getParam("password")) < 6){
        $user->addError("Le mot de passe doit être d'au moins 6 caractères");
    }
    
    // Validate confirm password
    // if empty, throw an error
    CheckEmpty($user,$user->getParam("confirm_password"),"Veuillez confirmer le mot de passe.");
    // Check if given password is the same than given confirmation password
    if($user->getParam("password") != $user->getParam("confirm_password")){
        $user->addError("Les mot de passe ne sont pas les mêmes");
    }

    // Check if both email and email confirmation are empty
    CheckEmpty($user,$user->getParam("email"),"Veuillez rentrer un email.");
    CheckEmpty($user,$user->getParam("confirm_email"),"Veuillez confirmer l'email.");

    if($user->getParam("email") != $user->getParam("confirm_email")){
        $user->addError("Les adresse e-mail ne sont pas les mêmes");
    }

    // Check if there is no input errors before inserting in database
    if(empty($user->getError())){
        $param_username = $user->getParam("username");
        $param_password = password_hash($user->getParam("password"), PASSWORD_DEFAULT); // Creates a password hash
        // Prepare an insert statement
        $sql->preparedStatement("INSERT INTO utilisateur (login_utilisateur, mdp_utilisateur, nom_utilisateur, prenom_utilisateur, type_utilisateur, email_utilisateur) VALUES ($1, $2, $3, $4, 1, $5)",array($param_username,$param_password, $user->getParam("lastname"), $user->getParam("firstname"), $user->getParam("email")));
        if($sql->getValue()){
            // Redirect to login page
            $emailSender->welcomeMail($user->getParam("email"));
            header("location: ../index.php");
        } else {
            echo "Une erreur est apparue, veuillez réessayer plus tard";
        }
    } else {
    // Create a session array with all the errors
        if(!isset($_SESSION["register_errors"]))
        {
            $_SESSION["register_errors"] = $user->getError();
            // redirect to the inscription page
            header("location: ../inscription.php");
        }
    }
    
    // Close connection
    pg_close($connec);
}
else
{
    header("location: ../index.php");
}