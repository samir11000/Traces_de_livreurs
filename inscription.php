<?php

session_start();

if(isset($_SESSION["register_errors"]))
{
    echo "<div class=\"alert alert-danger mt-2\">";
    foreach($_SESSION["register_errors"] as $value){
        echo nl2br($value."\n");
    }
    echo "</div>";
}

unset($_SESSION["register_errors"]);

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
        <form action="auth/register.php" method="POST">
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