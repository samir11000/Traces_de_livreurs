<!DOCTYPE html>

<html>

<head>
    <title>Ubber Camion - Accueil</title>
    <link rel="icon" href="img/favicon.ico" />
    <meta charset="UTF-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="css/all.css" rel="stylesheet">
</head>
<body id="body">
<?php 
if (empty($_SESSION))
    session_start();

    include 'assets/connexion_bdd.php';
    include 'assets/querrySimplifier.php';

    $sql = new querrySimplifier($connec);

    if(isset($_COOKIE["auth"]) && $_COOKIE["auth"] != '')
    {
        $sql->preparedStatement('SELECT auth_token FROM utilisateur WHERE auth_token = $1',array($_COOKIE["auth"]));
        if($sql->getValue()){
            $connected = TRUE;
            $sql->preparedStatement('SELECT nom_utilisateur FROM utilisateur WHERE auth_token = $1',array($_COOKIE["auth"]));
            $result = pg_fetch_array($sql->getValue());
            $_SESSION["locale"] = array($connected,$result["nom_utilisateur"]);

        }
    }
?>
<div id="bg-img" class="bg-img">
    <nav class="navbar navbar-expand-lg navbar-light navbar-transparent">
            <a class="navbar-brand" style="color: white" href="index.php">
                <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top mr-2" alt=""> Uber Camion
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" style="color: white" href="index.php">Accueil <!--<span class="sr-only">(current)</span>--></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: white" href="tracking.php">Tracking</a>
                    </li>
                    <?php
                    if(isset($_SESSION['locale']) && $_SESSION['locale'][0] == 1){
                        echo '<li class="nav-item"><a class="nav-link" style="color: white" href="rapport.php">Rapport</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" style="color: white" href="admin/index.php">Administration</a></li>';
                    }
                    ?>
                    <!-- <span class="mr-3" style="color:#FFFFFF; font-size:1.5em">'.$_SESSION['locale'][1].'</span> -->
                    <?php if(isset($_SESSION['locale'])){echo '<form class="form-inline test mr-3" style="right:150px"><div class="dropdown"><button type="button" id="user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="avatar avatar--nav2 avatar-img"></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <p style="text-align:center; text-font:roboto; font-size:1.2rem">'.$_SESSION['locale'][1].'</p>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Mon profile</a>
    <div class="dropdown-divider"></div>
    <button type="submit" class="btn btn-danger mt-3 ml-3" style="text-align:center"><a href="auth/deconnexion.php" style="color:white">Déconnexion</button></a>
  </div></div>';} else {echo '<form class="form-inline test mr-3"><button class="btn btn-success my-2 my-sm-0 mr-3" type="submit"><a href="connexion.php" style="color: inherit; text-decoration: inherit;">Connexion</a></button>
                        <button class="btn btn-danger my-2 my-sm-0" type="submit"><a href="inscription.php" style="color: inherit; text-decoration: inherit;">Inscription</a></button>';} ?>
                    </form>
                </ul>
            </div>
        </nav>
        <div class="box">
            <div id="user-box" class="login-box__content" data-visibility="hidden" style="transform: translateX(1165px);right: 1249px; height:300px;">
            <h3 class="mt-3" style="color:black; text-align:center; padding-bottom:10px;border-bottom:1px black solid;"><?php if(isset($_SESSION['locale'])){ echo $_SESSION['locale'][1];}?></h3>
            <div class="mt-3" style="color:black; text-align:center; padding-bottom:10px;font-size:15px">Mon profile</div>
            <button class="btn btn-danger my-2 my-sm-0 mt-3 text-center" type="submit"><a href="auth/deconnexion.php" style="color: inherit; text-decoration: inherit">Déconnexion</a></button>
            </div>
        </div>
        <div class="central-image" style="height: 600px">
        </div>
        <div class="centered">
            <div style="color: #FFFFFF" class="pb-3">Localisez les Camions de livraison et leurs marchandises en direct</div>
            <button type="button" style="display: block" class="btn btn-primary mx-auto"><a style="color:white" href="tracking.php">Tracking</a></button>
        </div>
    </div>
    <div class="container-fluid" style="background-color: white; text-align: center;">
        <div class="tile" style="height: 400px; border-top: solid grey 3px; border-bottom: solid grey 3px;">
        <div class="row" style="">
            <div class="col-sm mx-auto mt-5 mb-5">
                <i class="fas fa-user" style="font-size: 75px; color: blue;"></i>
                <h2 class="mt-3">Facile d'utilisation</h2>
                <p class="mr-4 ml-4" id="short">L'interface a été pensée pour être le plus ergonomique possible et avec une courbe d'apprentisage basse peu importe le niveau de connaisance de l'utilisateur</p>
            </div>
            <div class="col-sm mx-auto mt-5 mb-5">
                <i class="fas fa-bolt" style="font-size: 75px; color: blue;"></i>
                <h2 class="mt-3">Rapidité</h2>
                <p class="mr-4 ml-4" id="short2">Nous utilisons les dernières technologies de cartographie (leeflet, openlayers) afin d'offrir une expérience fluide et rapide aux utilisateurs</p>
            </div>
            <div class="col-sm mx-auto mt-5 mb-5">
                <i class="fas fa-school" style="font-size: 75px; color: blue;"></i>
                <h2 class="mt-3">Projet Scolaire</h2>
                <p class="mr-4 ml-4" id="short3">Ceci est un projet scolaire réalisé pendant le temps disponible au cours de la formation, ainsi nous nous excusons si certaines fonctionnalités ne marchent pas entièrement voir ne marchent pas</p>
            </div>
        </div>
        </div>
        <div class="tile" style="height: 500px; border-bottom: solid grey 3px;">
            <div class="row" style="height : 500px">
                <div class="col">
                    <img src="img/geo.png" class="bg-shadow" style="display: block; width: 70%; top : 15%; left: 10%; position: absolute">
                </div>
                <div class="col">
                    <div style="top : 30%; position: absolute; margin-left: 50px; margin-right: 50px">
                        <i class="fas fa-truck mb-3" style="font-size: 75px; color: blue;"></i>
                        <h2 class="mb-3" style="color : blue;">Suivi en temps réel</h2>
                        <p>Grace à notre application cartographique et notre base de données très fournie, localiser les différents dépots et même la postion des camion en temps réel !</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="tile" style="height: 500px; border-bottom: solid grey 3px;">
            <div class="row" style="height : 500px">
                <div class="col">
                    <div style="top : 20%; position: absolute; margin-left: 50px; margin-right: 50px">
                        <i class="fas fa-file-excel" style="font-size: 75px; color: blue;"></i>
                        <h2 class="mb-3" style="color : blue;">Rapport de suivi journalier</h2>
                        <p>L'application fourni à la fin de chaque journée un rapport journalier complet sur l'activité de chaque livreur (temps de pose, position de la pose, nombre de livraisons, trajets ...)</p>
                    </div>
                </div>
                <div class="col">
                    <img src="img/rapport.png" class="bg-shadow" style="display: block; width: 70%; top : 15%; left: 10%; position: absolute">
                </div>
            </div>
        </div>         
    </div>
    <?php

    include("assets/footer.php");

    ?>
</body>
<script src="js/main.js "></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js " integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin="anonymous "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js " integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin="anonymous "></script>
<script src="js/bootstrap.min.js "></script>

</html>