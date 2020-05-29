<!DOCTYPE html>
<html>

<head>
    <title>Ubber Camion - Controle de Vitesse</title>
    <link rel="icon" href="img/favicon.ico" />
    <meta charset="UTF-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>


</head>

<body id="body">
    <?php

    include("assets/header.php");

    ?>

    <div id="layoutSidenav_content">
        <?php
 // establishing DB connection
    $host= "host=localhost";
    // add values for below variables according to your system
    $port= "port=5432";
    $dbname="dbname=0_traceur_livreur";
    $dbuser="user=postgres";
    $dbpwd="password=postgres";
    // connection string (pg_connect() is native PHP method for Postgres)
    $dbconn=pg_connect("$host $port $dbname $dbuser $dbpwd");

    // validating DB connection
    if(!$dbconn) {
        exit("There was an error establishing database connection");
    }

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
    $result = pg_query($dbconn, $sql);
    
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
        <div class="card mt-4">
            <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Vitesses / Troncon</div>
            <canvas id="chart" style="width: 100%; height: 400px; border: 1px solid #555652;"></canvas>
        </div>

        <div class="card mt-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Livreur - Vitesses</div>
            <div class="card-body">

                <div class="table-responsive">
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

                                        $idc = pg_connect('host=localhost user=postgres password=postgres dbname=0_traceur_livreur'); 
                                        $sql = 'select nom_livreur,prenom_livreur,vitesse_coordonees,coordonees.id_troncon as troncon, circuit.id_circuit as circuit, date_parcours, numero_immat_camion from coordonees,troncon, circuit, parcourir, camion, conduire, livreur where troncon.id_circuit = circuit.id_circuit and circuit.id_circuit = parcourir.id_circuit and camion.id_camion = parcourir.id_camion and coordonees.id_troncon = troncon.id_troncon and camion.id_camion = conduire.id_camion and livreur.id_livreur = conduire.id_livreur and vitesse_coordonees > 50';
                                        $rs = pg_exec($idc, $sql);
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
            </div>
        </div>


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
    </div>

</body>

</html>
