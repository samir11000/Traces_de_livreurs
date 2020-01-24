<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #212121">
        <a class="navbar-brand" style="color: white" href="index.html">
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
                <li class="nav-item">
                    <a class="nav-link" style="color: white" href="#">Rapport</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: white" href="#">Gestion</a>
                </li>
                <?php if(isset($_SESSION['locale'])){echo '<form class="form-inline test mr-3" style="right:50px"><button class="avatar avatar--nav2 avatar-img"></button>';} else {echo '<form class="form-inline test mr-3"><button class="btn btn-success my-2 my-sm-0 mr-3" type="submit"><a href="connexion.php" style="color: inherit; text-decoration: inherit;">Connexion</a></button>
                        <button class="btn btn-danger my-2 my-sm-0" type="submit"><a href="inscription.php" style="color: inherit; text-decoration: inherit;">Inscription</a></button>';} ?>
                </form>
            </ul>
        </div>
    </nav>