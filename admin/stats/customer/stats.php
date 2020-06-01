<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="../../../img/favicon.ico" />
    <title>Tableau de bord - Statistiques client</title>
    <link href="/admin/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
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
                <h3>Clients</h3>

                <?php
    $label = '';
	$data1 = '';

	//query to get data from the table
	$sql = "select nom_ville,count(*) as nb from client, ville where ville.id_ville = client.id_ville group by nom_ville order by nom_ville";
    $result = pg_query($connec, $sql);
    
	//loop through the returned data
	while ($row = pg_fetch_array($result)) {
		$data1 = $data1 . $row['nb'].',';
        $label = $label . '"'. $row['nom_ville'].'",';
        

        
	}
	$data1 = trim($data1,",");
    
?>


                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="../../main.php">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Clients</li>
                </ol>
                <div class="card mb-2">
                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Clients / Villes</div>
                    <canvas id="bar-chart" style="width: 100%; height: 400px; border: 1px solid #555652;"></canvas>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Adresse</th>
                            <th>Téléphone</th>
                            <th>Ville</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $sql = "SELECT * FROM client";        
                            $result = pg_query($connec, $sql);
                            foreach(pg_fetch_all($result) as $x)
                            echo "<tr>
                            <td>".$x["id_client"]."</td>
                            <td>".$x["nom_client"]."</td>
                            <td>".$x["prenom_client"]."</td>
                            <td>".$x["adresse_client"]."</td>
                            <td>".$x["tel_client"]."</td>
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

    <script>
        // Bar chart
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: [<?php echo $label; ?>],
                datasets: [{
                    label: "Clients",

                    backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                    data: [<?php echo $data1; ?>]
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: ''
                },
                scales: {
                    yAxes: [{
                        ticks: {

                            min: 0
                        }
                    }]
                }
            }
        });

    </script>

</body>

</html>
