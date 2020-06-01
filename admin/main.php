<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="../img/favicon.ico" />
    <title>Tableau de bord - Accueil</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php session_start();
        include '../assets/connexion_bdd.php';
        include '../assets/querrySimplifier.php';
        include '../assets/config.php';

        $sql = new querrySimplifier($connec);

        if(!isset($_SESSION['locale']))
        {
            header('location: ../index.php');
        }
        include('assets/header.php');
        ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Tableau de bord</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Tableau de bord</li>
                </ol>
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Nombre de livreurs</div>
                            <div class="row mb-4">
                                <div class="col text-center">
                                    <i class="fas fa-male" style="font-size:100px"></i>
                                </div>
                                <div class="col">
                                    <div style="font-size:60px"><?php echo $sql->quickRequest("SELECT COUNT(id_livreur) as nb_livreur FROM livreur;")[0] ?></div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="stats/driver/stats.php">Plus d'informations</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">Nombre de camions</div>
                            <div class="row mb-4">
                                <div class="col text-center">
                                    <i class="fas fa-truck" style="font-size:100px"></i>
                                </div>
                                <div class="col">
                                    <div style="font-size:60px"><?php echo $sql->quickRequest("SELECT COUNT(id_camion) as nb_camion FROM camion;")[0] ?></div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="stats/truck/stats.php">Plus d'informations</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Trajets</div>
                            <div class="row mb-4">
                                <div class="col text-center">
                                    <i class="fas fa-road" style="font-size:100px"></i>
                                </div>
                                <div class="col">
                                    <div style="font-size:60px"><?php echo $sql->quickRequest("SELECT COUNT(id_troncon) as nb_troncon FROM troncon;")[0] ?></div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="stats/trajet/stats.php">Plus d'informations</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-danger text-white mb-4" style="background-color:grey !important;">
                            <div class="card-body">Nombre de colis</div>
                            <div class="row mb-4">
                                <div class="col text-center">
                                    <i class="fas fa-box" style="font-size:100px"></i>
                                </div>
                                <div class="col">
                                    <div style="font-size:60px"><?php echo $sql->quickRequest("SELECT COUNT(id_colis) as nb_colis FROM colis;")[0] ?></div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="stats/colis/stats.php">Plus d'informations</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-danger text-white mb-4" style="background-color:pink !important;">
                            <div class="card-body">Nombre de clients</div>
                            <div class="row mb-4">
                                <div class="col text-center">
                                    <i class="fas fa-briefcase" style="font-size:100px"></i>
                                </div>
                                <div class="col">
                                    <div style="font-size:60px"><?php echo $sql->quickRequest("SELECT COUNT(id_client) as nb_client FROM client;")[0] ?></div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="stats/customer/stats.php">Plus d'informations</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">Alerte vitesse</div>
                            <div class="row mb-4">
                                <div class="col text-center">
                                    <i class="fas fa-tachometer-alt" style="font-size:100px"></i>
                                </div>
                                <div class="col">
                                    <div style="font-size:60px"><?php echo $sql->quickRequest("select count(*) from coordonees where vitesse_coordonees > 50;")[0] ?></div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="stats/speed/stats.php">Plus d'informations</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <h3><a href="#">Utilisateurs</a></h3>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Adresse E-Mail</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                                            $sql = "SELECT * FROM utilisateur";        
                                            $result = pg_query($connec, $sql);
                                        foreach(pg_fetch_all($result) as $x) echo "<tr>
                                                <td>".$x["id_utilisateur"]."</td>
                                                <td>".$x["nom_utilisateur"]."</td>
                                                <td>".$x["prenom_utilisateur"]."</td>
                                                <td>".$x["email_utilisateur"]."</td>
                                                <td>".$x["type_utilisateur"]."</td>
                                            </tr>";
                                            ?>
                    </tbody>
                </table>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Uber Camion 2020</div>
                    <div>
                        <a href="#">Politique de confidentialité</a>
                        &middot;
                        <a href="#">Termes d'utilisation</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>
