<?php 
if (empty($_SESSION))
    session_start();

    define('ROOT', $_SERVER['DOCUMENT_ROOT']);

   include ROOT.'/assets/connexion_bdd.php';
   include ROOT.'/assets/querrySimplifier.php';

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
<nav class="navbar navbar-expand-lg navbar-light navbar-transparent">
    <a class="navbar-brand" style="color: white" href="/index.php">
        <img src="/img/logo.png" width="30" height="30" class="d-inline-block align-top mr-2" alt=""> BBA Transport
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" style="color: white" href="/index.php">Accueil </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: white" href="/tracking.php">Carte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: white" href="/test_position.php">Tracking</a>
            </li>
            <?php
                    if(isset($_SESSION['locale']) && $_SESSION['locale'][0] == 1){
                        
                        echo '<li class="nav-item"><a class="nav-link" style="color: white" href="/admin/index.php">Administration</a></li>';
                    }
                    ?>
            <!-- <span class="mr-3" style="color:#FFFFFF; font-size:1.5em">'.$_SESSION['locale'][1].'</span> -->
            <?php if(isset($_SESSION['locale'])){echo '<form class="form-inline test mr-3" style="right:150px"><div class="dropdown"><button type="button" id="user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="avatar avatar--nav2 avatar-img"'; if($_SESSION['locale'][3] != NULL){echo 'style="background-image: url('.$_SESSION['locale'][3].')"';} echo '></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <p style="text-align:center; text-font:roboto; font-size:1.2rem">'.$_SESSION['locale'][1].'</p>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="profil/profil.php">Mon profil</a>
    <div class="dropdown-divider"></div>
    <button type="submit" class="btn btn-danger mt-3 ml-3" style="text-align:center"><a href="auth/deconnexion.php" style="color:white">Déconnexion</button></a>
  </div></div>';} else {echo '<form class="form-inline test mr-3"><button class="btn btn-success my-2 my-sm-0 mr-3" type="submit"><a href="connexion.php" style="color: inherit; text-decoration: inherit;">Connexion</a></button>
                        <button class="btn btn-danger my-2 my-sm-0" type="submit"><a href="inscription.php" style="color: inherit; text-decoration: inherit;">Inscription</a></button>';} ?>

        </ul>
    </div>
</nav>
