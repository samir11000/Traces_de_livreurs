<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" href="../../../img/favicon.ico" />
        <title>Tableau de bord - Statistiques chauffeur</title>
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
                    <h3>Livreurs</h3>
                    <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../../main.php">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Livreurs</li>
                    </ol>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Adresse Résidentielle</th>
                                <th>Date de naissance</th>
                                <th>Date obtention permis</th>
                                <th>Date expiration permis</th>
                                <th>Numéro de Permis</th>
                                <th>Téléphone</th>
                                <th>Ville</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                            $sql = "SELECT * FROM livreur";        
                            $result = pg_query($connec, $sql);
                            foreach(pg_fetch_all($result) as $x)
                            echo "<tr>
                                <td>".$x["id_livreur"]."</td>
                                <td>".$x["nom_livreur"]."</td>
                                <td>".$x["prenom_livreur"]."</td>
                                <td>".$x["adresse_livreur"]."</td>
                                <td>".$x["date_naissance_livreur"]."</td>
                                <td>".$x["date_obtention_permis"]."</td>
                                <td>".$x["date_expiration_permis"]."</td>
                                <td>".$x["num_permis"]."</td>
                                <td>".$x["tel_livreur"]."</td>
                                <td>".$req->quickRequest('SELECT nom_ville FROM ville where id_ville=' . $x['id_ville'] . ';')[0]."</td>
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