<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="/admin/main.php">Administration</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <!--
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            -->
    <!-- Navbar-->
    <ul style="position:absolute;right:0" class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ml-auto mr-0 mr-md-3 my-2 my-md-0" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/index.php">Accueil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Paramètres</a>
                <a class="dropdown-item" href="#">Rapport d'activités</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/auth/deconnexion.php">Déconnexion</a>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="/admin/main.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Accueil
                    </a>
                    <div class="sb-sidenav-menu-heading">Carte</div>
                    <a class="nav-link" href="/admin/forms/map/carte.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-map-marked"></i></div>Visualisation
                    </a>
                    <a class="nav-link" href="/admin/forms/map/realTime.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-road"></i></div>Temps réel
                    </a>
                    <div class="sb-sidenav-menu-heading">Formulaires</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutDelivery" aria-expanded="false" aria-controls="collapseLayoutsDelivery">
                        <div class="sb-nav-link-icon"><i class="fas fa-male mr-2 ml-1"></i></div>
                        Livreur
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayoutDelivery" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="/admin/forms/delivery/delivery.php">Ajouter / Retirer un livreur</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsCamion" aria-expanded="false" aria-controls="collapseLayoutsCamion">
                        <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                        Camion
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayoutsCamion" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="/admin/forms/truck/camion.php">Ajouter / Retirer un camion</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsClient" aria-expanded="false" aria-controls="collapseLayoutsClient">
                        <div class="sb-nav-link-icon"><i class="fas fa-briefcase mr-1"></i></div>
                        Clients
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayoutsClient" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="/admin/forms/customer/customer.php">Ajouter / Retirer un client</a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Connecté en tant que :</div>
                <?php echo $_SESSION['locale'][1]; ?>
            </div>
        </nav>
    </div>
