<?php

include 'assets/formBuilder.php';

session_start();
$form = new formBuilder();

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
    <meta name="viewport" content="width=1000, initial-scale=0.5, height=800px">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="css/all.css" rel="stylesheet">
</head>

<body style="background-color:white;">
    <div class="container-fluid">
    <span style="font-size:2rem; position:fixed; bottom:3%;left:3%;z-index:1"><a href="index.php" style="color:black"><i class="fas fa-arrow-left"></i></a></span>
        <div style="width:100%;height:105px;padding-top:32px;padding-bottom:24px;">
            <div style="margin-right:auto; margin-left:auto;text-align:center">
                <img src="img/logo.png" style="height:48px"/>
            </div>
        </div>
        <div style="width:100%;text-align:center; margin-top:10px;margin-bottom:30px">
        <h2>Inscription</h2>
        </div>
        <?php $form->startPostForm("auth/register.php"); ?>
        <div class="card" style="width: 52rem; margin-left:auto;margin-right:auto;height:560px">
            <div class="card-body" style="text-align:left">
                <div class="row" style="margin-bottom:25px;">
                        <div class="col">
                            <?php $form->addTextRow("lastname","lastname","Nom :","lastName") ?>
                        </div>
                        <div class="col">
                            <?php $form->addTextRow("firstname","firstname","Prénom :","firsName") ?>
                        </div>
                        
                    </div>
                    <div class="row" style="margin-bottom:25px;">
                        <div class="col">
                            <?php $form->addTextRow("login","login","Login :","login") ?>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <?php $form->addTextRow("username","username","Nom d'utilisateur :","username") ?>
                            </div>
                        </div>
                </div>
                <div class="row" style="margin-bottom:25px;">
                        <div class="col">
                            <div class="form-group">
                                <?php $form->addPasswordRow("pass","pass","Mot de passe :","password") ?>
                            </div>
                        </div>
                        <div class="col">
                            <?php $form->addPasswordRow("pass2","pass2","Confirmer mot de passe :","passwordConfirmation") ?>
                        </div>
                </div>
                <div class="row" style="margin-bottom:25px;">
                        <div class="col">
                            <?php $form->addEmailRow("email","email","Adresse E-mail :","mailAddress") ?>
                        </div>
                        <div class="col">
                            <?php $form->addEmailRow("email2","email2","Confirmer Adresse E-mail :","mailAddressConfirmation") ?>
                        </div>
                </div>
                <button type="submit" style="margin-left:43%" class="btn btn-success">Inscription</button>
            </div>
        </form>
        <div class="card mb-3" style="width: 52rem; top:70px;margin-left:auto;margin-right:auto;">
            <div class="card-body">
            <div style="text-align:center">Vous avez déjà un compte ? <a href="connexion.php">Connexion</a></div>
            </div>
            </div>
        </div>
</body>

</html>