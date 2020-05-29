<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" href="../../../img/favicon.ico" />
        <title>Tableau de bord - Statistiques camion</title>
        <link href="/admin/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php session_start();
        include '../../../assets/connexion_bdd.php';
        include '../../../assets/querrySimplifier.php';
        include '../../../assets/config.php';

        $req = new querrySimplifier($connec);

        if(!isset($_SESSION['locale']))
        {
            header('location: ../../../index.php');
        }
        include('../../assets/header.php');
        ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid mt-2">
                    <h3>Camions</h3>
                    <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../../main.php">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Camions</li>
                    </ol>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Marque</th>
                                <th>Model</th>
                                <th>Type</th>
                                <th>Date première circulation</th>
                                <th>Consomation moyenne</th>
                                <th>Nombre de kilomètres</th>
                                <th>Taille du réservoir (L)</th>
                                <th>Numéro d'immatriculation</th>
                                <th>Type de carburant</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                            $sql = "SELECT * FROM camion";        
                            $result = pg_query($connec, $sql);
                            foreach(pg_fetch_all($result) as $x)
                            echo "<tr>
                                <td>".$x["id_camion"]."</td>
                                <td>".$x["marque_camion"]."</td>
                                <td>".$x["model_camion"]."</td>
                                <td>".$x["type_camion"]."</td>
                                <td>".$x["date_premiere_circulation"]."</td>
                                <td>".$x["consomation_moyenne"]."</td>
                                <td>".$x["nb_km_camion"]."</td>
                                <td>".$x["taille_reservoir_camion"]."</td>
                                <td>".$x["numero_immat_camion"]."</td>
                                <td>".$x['type_carburant']."</td>
                            </tr>";
                        ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../../assets/demo/chart-area-demo.js"></script>
        <script src="../../assets/demo/chart-bar-demo.js"></script>
        <script src="../../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="../../js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../../assets/demo/datatables-demo.js"></script>
</body>

</html>