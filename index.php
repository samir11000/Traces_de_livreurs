<!DOCTYPE html>

<html>

<head>
    <title>BBA Transport - Accueil</title>
    <link rel="icon" href="img/favicon.ico" />
    <meta charset="UTF-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <div id="bloc_page">
        <div id="background_acceuil">
            <nav class="navbar fixed-top navbar-expand-lg">
                <a class="navbar-brand" style="color: white" href="index.php">
                    <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top mr-2" alt=""> BBA Transport
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" style="color: white" href="index.php">Accueil
                                <!--<span class="sr-only">(current)</span>--></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: white" href="tracking.php">Carte</a>
                        </li>

                        <?php
                    if(isset($_SESSION['locale']) && $_SESSION['locale'][0] == 1){
                        
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

                    </ul>
                </div>
            </nav>
            <div class="box">
                <div id="user-box" class="login-box__content" data-visibility="hidden" style="transform: translateX(1165px);right: 1249px; height:300px;">
                    <h3 class="mt-3" style="color:black; text-align:center; padding-bottom:10px;border-bottom:1px black solid;"><?php if(isset($_SESSION['locale'])){ echo $_SESSION['locale'][1];}?></h3>
                    <div class="mt-3" style="color:black; text-align:center; padding-bottom:10px;font-size:15px">Mon profile</div>
                    <button class="btn btn-danger my-2 my-sm-0 mt-3 text-center" type="submit"><a href="auth/deconnexion.php" style="color: inherit; text-decoration: inherit">Déconnexion</a></button>
                </div>
                <div id="texte_acceuil">
                    <h1>SUIVEZ VOS TRANSPORTS</h1>
                    <p>Avec notre application, suivez en temps réel vos livraisons à travers l'Aude, les SIG au service de la logistique!</p>
                    <div id="bouton_acceuil">
                        <a href="tracking.php"><button class="bouton_noir" >Carte</button></a>
                        <a href="#bloc_service"><button class="bouton_noir">En savoir plus</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="bloc_service">
            <div class="blank"></div>
            <div id="titre_service">
                <h1>Une application qui répond à tous vos besoins !</h1>
            </div>
            <div id="presentation_service">
                <div class="element">
                    <img src="img/icone/map.png" />
                    <h1>SUIVI EN TEMPS RÉEL</h1>
                    <p>Suivez vos camions ainsi que ce qu'ils transportent sur une carte en temps réel.</p>
                </div>

                <div class="element">
                    <img src="img/icone/newspaper.png" />
                    <h1>RAPPORT JOURNALIER</h1>
                    <p>Rapport détaillé, temps de trajet, vitesse moyenne, nombre de colis livrés...</p>
                </div>

                <div class="element">
                    <img src="img/icone/truck.png" />
                    <h1>GESTION DE FLOTTE</h1>
                    <p>Suivi individuel de tous vos véhicules</p>
                </div>

                <div class="element">
                    <img src="img/icone/profile.png" />
                    <h1>GESTION DE PERSONNEL</h1>
                    <p>Outil d'aide à la gestion de votre équipe</p>
                </div>

                <div class="element">
                    <img src="img/icone/route.png" />
                    <h1>VISUALISATION SUR CARTE</h1>
                    <p>Affichage de vos clients ou encore des trajets réalisés sur une carte, en cas d'incident ou pour optimiser une livraison.</p>
                </div>
            </div>

        </div>
        <div id="bloc_equipe">
            <div class="blank"></div>
            <div id="titre_equipe">
                <h1>Notre équipe</h1>
            </div>
            <div id="presentation_equipe">
                <div class="membre">
                    <img src="img/icone/samir.png" />
                    <h1>Samir Aït Ouaret</h1>
                    <p>Etudiant</br> <i>Responsable cartographie</i></p>
                    <a href="https://www.linkedin.com/in/samir-ait-ouaret-a69995108/" target="_blank"><i class="fa fa-linkedin-square" style="font-size:36px"></i></a>
                </div>

                <div class="membre">
                    <img src="img/icone/stick-man.png" />
                    <h1>Kyllian Beasse</h1>
                    <p>Etudiant </br> <i>Responsable administration</i></p>
                    <a href="https://fr.linkedin.com/"><i class="fa fa-linkedin-square" style="font-size:36px"></i></a>
                </div>

                <div class="membre">
                    <img src="img/icone/justin.jpg" />
                    <h1>Justin Bacconnier</h1>
                    <p>Etudiant</br> <i>Responsable design</i></p>
                    <a href="https://www.linkedin.com/in/justin-bacconnier-b57260159/" target="_blank"><i class="fa fa-linkedin-square" style="font-size:36px"></i></a>
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
<!--colored scroll navbar-->
<script>
    $(window).scroll(function() {
        if ($(window).scrollTop() > 900) {
            $('nav').addClass('bg-dark');
        } else {
            $('nav').removeClass('bg-dark');
        }
    });

</script>

</html>
