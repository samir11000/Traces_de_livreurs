<?php

include '../assets/connexion_bdd.php';
include '../assets/querrySimplifier.php';
include '../assets/config.php';
include '../assets/users.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $sql = new querrySimplifier($connec);
    $user = new registerUser($_POST);

    session_start();

    if(empty(trim($user->getParam("username")))){
        $user->addError("Le champ login n'est pas renseigné");
    } else{
        $login = trim($_POST["username"]);
    }

    if(empty(trim($_POST["pass"]))){
        $user->addError("Le champ mot de passe n'est pas renseigné");
    } else{
        $password = trim($_POST["pass"]);
    }

    if(isset($_POST["rememberme"]) && (!empty(trim($_POST["rememberme"])) && ($_POST["rememberme"] == "checked")))
    {
        $rngvalue = bin2hex(random_bytes(64));
        setcookie("auth", $rngvalue, time()+3600, "/");
        $sql->preparedStatement('SELECT id_utilisateur FROM utilisateur WHERE login_utilisateur = $1',array($login));
        if(pg_num_rows($sql->getValue()) < 1)
            echo 'Ce nom d\'utilisateur n\'existe pas';
        else{
            $sql->preparedStatement("UPDATE utilisateur SET auth_token=$1 WHERE login_utilisateur=$2",array($rngvalue,$login));
            if(!$sql->getValue()){
                echo 'Une erreur est survenue';
            }
        }
    }
    if(empty($user->getError())){
        // Prepare an insert statement
        $sql = "SELECT * FROM utilisateur WHERE login_utilisateur = $1";        
        if($stmt = pg_prepare($connec, "my_querry3",$sql)){
            $result = pg_execute($connec, "my_querry3",array($login));
            $result = pg_fetch_array($result);

            if(password_verify($password, $result['mdp_utilisateur']))
            {
                $connected = TRUE;
                $_SESSION["locale"] = array($connected,$result['nom_utilisateur'],$result['id_utilisateur'],$result['profile_pic']);
                header('location: ../index.php');
                unset($result);
            } else
            {
                $user->addError("Le mot de passe est incorrect");
                if(!isset($_SESSION["register_errors"]))
                {
                    $_SESSION["register_errors"] = $user->getError();
                    // redirect to the inscription page
                    header("location: ../connexion.php");
                }
            }
        }
    }
    else
    {
        if(!isset($_SESSION["register_errors"]))
        {
            $_SESSION["register_errors"] = $user->getError();
            // redirect to the inscription page
            header("location: ../connexion.php");
        }
    }
    
    // Close connection
    pg_close($connec);
}
else {
    header('location: ../index.php');
}