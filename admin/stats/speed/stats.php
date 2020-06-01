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
                <h3>Vitesse</h3>

                <?php
    $label = '';
	$data1 = '';
    $data2 = '';
    $data3 = '';
    $data4 = '';
    $data5 = '';
    $data6 = '';
    $i = 0;



	//query to get data from the table
	$sql = "SELECT * FROM coordonees ";
    $result = pg_query($connec, $sql);
    
	//loop through the returned data
	while ($row = pg_fetch_array($result)) {
        if ($row['id_troncon'] == 1 )
		{
		$data1 = $data1 . '"'. $row['vitesse_coordonees'].'",';

        }
        else if ($row['id_troncon'] == 2 )
		{
		$data2 = $data2 . '"'. $row['vitesse_coordonees'].'",';

        }
        else if ($row['id_troncon'] == 3 )
		{
		$data3 = $data3 . '"'. $row['vitesse_coordonees'].'",';
        $i = $i + 1;
        $label = $label . $i.',';

        }
        else if ($row['id_troncon'] == 4 )
		{
		$data4 = $data4 . '"'. $row['vitesse_coordonees'].'",';

        }
        else if ($row['id_troncon'] == 5 )
		{
		$data5 = $data5 . '"'. $row['vitesse_coordonees'].'",';

        }
        else
		{
		$data6 = $data6 . '"'. $row['vitesse_coordonees'].'",';

        }


        
	}
	$data1 = trim($data1,",");
    
?>


                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="../../main.php">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Vitesse</li>
                </ol>
                <div class="card mb-2">
                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Vitesse / Troncon</div>
                    <canvas id="chart" style="width: 100%; height: 400px; border: 1px solid #555652;"></canvas>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Vitesse</th>
                            <th>Tronçon</th>
                            <th>Circuit</th>
                            <th>Date</th>
                            <th>Numéro immatriculation</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                                        
                                        $sql = 'select nom_livreur,prenom_livreur,vitesse_coordonees,coordonees.id_troncon as troncon, circuit.id_circuit as circuit, date_parcours, numero_immat_camion from coordonees,troncon, circuit, parcourir, camion, conduire, livreur where troncon.id_circuit = circuit.id_circuit and circuit.id_circuit = parcourir.id_circuit and camion.id_camion = parcourir.id_camion and coordonees.id_troncon = troncon.id_troncon and camion.id_camion = conduire.id_camion and livreur.id_livreur = conduire.id_livreur and vitesse_coordonees > 50';
                                        $rs = pg_exec($connec, $sql);
                                        while ($ligne = pg_fetch_assoc($rs))
                                        {

                                        print("<tr>");
                                        print("<td>".$ligne['nom_livreur']."</td>");
                                        print("<td>".$ligne['prenom_livreur']."</td>");
                                        print("<td>".$ligne['vitesse_coordonees']."</td>");
                                        print("<td>".$ligne['troncon']."</td>");
                                        print("<td>".$ligne['circuit']."</td>");
                                        print("<td>".$ligne['date_parcours']."</td>");
                                        print("<td>".$ligne['numero_immat_camion']."</td>");
                                        print("</tr>");

                                        }
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
        var ctx = document.getElementById("chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php echo $label; ?>],
                datasets: [{
                        label: 'Troncon 1',
                        data: [<?php echo $data1; ?>],
                        backgroundColor: 'transparent',
                        borderColor: 'red',
                        borderWidth: 3
                    },

                    {
                        label: 'Troncon 2',
                        data: [<?php echo $data2; ?>],
                        backgroundColor: 'transparent',
                        borderColor: 'blue',
                        borderWidth: 3
                    },

                    {
                        label: 'Troncon 3',
                        data: [<?php echo $data3; ?>],
                        backgroundColor: 'transparent',
                        borderColor: 'green',
                        borderWidth: 3
                    },

                    {
                        label: 'Troncon 4',
                        data: [<?php echo $data4; ?>],
                        backgroundColor: 'transparent',
                        borderColor: 'orange',
                        borderWidth: 3
                    },

                    {
                        label: 'Troncon 5',
                        data: [<?php echo $data5; ?>],
                        backgroundColor: 'transparent',
                        borderColor: 'purple',
                        borderWidth: 3
                    },

                    {
                        label: 'Troncon 6',
                        data: [<?php echo $data6; ?>],
                        backgroundColor: 'transparent',
                        borderColor: 'yellow',
                        borderWidth: 3
                    }
                ]
            },

            options: {
                scales: {
                    scales: {
                        yAxes: [{
                            beginAtZero: false
                        }],
                        xAxes: [{
                            autoskip: true,
                            maxTicketsLimit: 20
                        }]
                    }
                },
                tooltips: {
                    mode: 'index'
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: 'black',
                        fontSize: 16
                    }
                }
            }
        });

    </script>

</body>

</html>
