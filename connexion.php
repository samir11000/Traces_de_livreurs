<!DOCTYPE html>

<html>

<head>
    <title>Connexion</title>
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
        <h2>Connexion</h2>
        </div>
        <div style="width:100%">
        <div class="card" style="width: 20rem; margin-left:auto;margin-right:auto;">
            <div class="card-body">
            <form action="auth/connexion.php" method="POST">
                <div class="form-group">
                    <label for="EmailOrUsername">Mail ou nom d'utilisateur :</label>
                    <input type="text" class="form-control" id="EmailOrUsername" name="username" aria-describedby="mailorusername">
                </div>
                <div class="form-group">
                    <label for="pass">Mot de passe :</label>
                    <input type="password" class="form-control" id="pass" name="pass" aria-describedby="password">
                    <small id="password" class="form-text text-muted">Problème de connexion ? <a href="#">Récupération de mot de passe</a></small>
                </div>
                    <button type="submit" style="margin-left:30%" class="btn btn-success">Connexion</button>
                </form>
            </div>
            </div>
            <div class="card" style="width: 20rem; top:30px;margin-left:auto;margin-right:auto;">
            <div class="card-body">
            <div style="text-align:center">Nouveau ? <a href="inscription.php">Créer un compte</a></div>
            </div>
            </div>
        </div>
    </div>
</body>

</html>