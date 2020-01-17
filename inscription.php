<?php

include '/assets/connexion_bdd.php';

$username = $password = $confirm_password = $lastname = $firstname = $email = $confirm_email = "";
$username_err = $password_err = $confirm_password_err = $lastname_err = $firstname_err = $email_err = $confirm_email_err =  "";

var_dump($_POST);

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["lastname"]))){
        $username_err = "Veuillez rentrer un nom";
    } else{
        $lastname = trim($_POST["lastname"]);
    }

    if(empty(trim($_POST["firstname"]))){
        $username_err = "Veuillez rentrer un prénom";
    } else{
        $lastname = trim($_POST["firstname"]);
    }

    if(empty(trim($_POST["username"]))){
        $username_err = "Veuillez rentrer un nom d'utilisateur";
    } else{
        // Prepare a select statement
        $sql = 'SELECT id_utilisateur FROM utilisateur WHERE login_utilisateur = $1';
        
        if($stmt = pg_prepare($connec, "my_querry",$sql)){
            
            // Set parameters
            $param_login = trim($_POST["login"]);

            if($result = pg_execute($connec, "my_querry", array($param_login)))
            {
                
                if(pg_num_rows($result) == 1){
                    $login_err = "Ce nom d'utilisateur est déjà utilisé";
                } else{
                    $login = trim($_POST["login"]);
                }
            } else{
                echo "Une erreur est apparue, veuillez réessayer plus tard";
            }
        }
    }

    if(empty(trim($_POST["username"]))){
        $username_err = "Veuillez rentrer un nom d'utilisateur";
    } else{
        // Prepare a select statement
        $sql = 'SELECT id_utilisateur FROM utilisateur WHERE login_utilisateur = $1';
        
        if($stmt = pg_prepare($connec, "my_querry2",$sql)){
            
            // Set parameters
            $param_username = trim($_POST["username"]);

            if($result = pg_execute($connec, "my_querry2", array($param_username)))
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
        $sql = "INSERT INTO utilisateur (login_utilisateur, mdp_utilisateur, nom_utilisateur, prenom_utilisateur, type_utilisateur) VALUES ($1, $2, $3, $4, 1)";
         
        if($stmt = pg_prepare($connec, "my_querry3",$sql)){
            // Bind variables to the prepared statement as parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            if($result = pg_execute($connec, "my_querry3", array($param_username,$param_password, $lastname, $firstname))){
                // Redirect to login page
                header("location: connexion.php");
            } else{
                echo "Une erreur est apparue, veuillez réessayer plus tard";
            }
        }
    }
    
    // Close connection
    pg_close($connec);
}

?>

<!DOCTYPE html>

<html>

<head>
    <title>Inscription</title>
    <link rel="icon" href="img/favicon.ico" />
    <meta charset="UTF-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="css/all.css" rel="stylesheet">
</head>

<body style="background-color:white">
    <div class="container-fluid">
        <div style="width:100%;height:105px;padding-top:32px;padding-bottom:24px;">
            <div style="margin-right:auto; margin-left:auto;text-align:center">
                <img src="img/logo.png" style="height:48px"/>
            </div>
        </div>
        <div style="width:100%;text-align:center; margin-top:10px;margin-bottom:30px">
        <h2>Inscription</h2>
        </div>
        <form action="" method="POST">
        <div class="card" style="width: 52rem; margin-left:auto;margin-right:auto;">
            <div class="card-body" style="text-align:left">
                <div class="row" style="margin-bottom:25px;">
                        <div class="col">
                            <div class="form-group">
                                <label for="lastname">Nom :</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="lastName">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="firstname">Prénom :</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="firstName">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row" style="margin-bottom:25px;">
                        <div class="col">
                            <div class="form-group">
                                <label for="login">Login :</label>
                                <input type="text" class="form-control" name="login" id="login" aria-describedby="login">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="username">Nom d'utilisateur :</label>
                                <input type="text" class="form-control" name="username" id="username" aria-describedby="username">
                            </div>
                        </div>
                </div>
                <div class="row" style="margin-bottom:25px;">
                        <div class="col">
                            <div class="form-group">
                                <label for="pass">Mot de passe :</label>
                                <input type="password" class="form-control"name="pass" id="pass" aria-describedby="password">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="pass2">Confirmer mot de passe :</label>
                                <input type="password" class="form-control" name="pass2" id="pass2" aria-describedby="passwordConfirmation">
                            </div>
                        </div>
                </div>
                <div class="row" style="margin-bottom:25px;">
                        <div class="col">
                            <div class="form-group">
                                <label for="mail">Adresse E-mail : </label>
                                <input type="email" class="form-control" id="mail" aria-describedby="mailAddress">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="mail2">Confirmer adresse E-mail :</label>
                                <input type="password" class="form-control" id="mail2" aria-describedby="mailAddressConfirmation">
                            </div>
                        </div>
                </div>
                <button type="submit" style="margin-left:43%" class="btn btn-success">Inscription</button>
            </div>
        </form>
        <div class="card" style="width: 52rem; top:90px;margin-left:auto;margin-right:auto;">
            <div class="card-body">
            <div style="text-align:center">Vous avez déjà un compte ? <a href="connexion.php">Connexion</a></div>
            </div>
            </div>
        </div>
</body>

</html>