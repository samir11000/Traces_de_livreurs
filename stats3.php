<!DOCTYPE html>
<html>

<head>
    <title>Ubber Camion - Statistics V</title>
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

    include("./assets/header.php");

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

	//query to get data from the table
	$sql = "select nom_ville,count(*) as nb from client, ville where ville.id_ville = client.id_ville group by nom_ville order by nom_ville";
    $result = pg_query($dbconn, $sql);
    
	//loop through the returned data
	while ($row = pg_fetch_array($result)) {
		$data1 = $data1 . $row['nb'].',';
        $label = $label . '"'. $row['nom_ville'].'",';
        

        
	}
	$data1 = trim($data1,",");
    
?>
        <div class="card mt-4">
            <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Clients / Villes</div>
            <canvas id="bar-chart" style="width: 100%; height: 400px; border: 1px solid #555652;"></canvas>
        </div>

        <div class="card mt-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Table Client</div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Adresse</th>
                                <th>Téléphone</th>
                                <th>Ville</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php

                                        $idc = pg_connect('host=localhost user=postgres password=postgres dbname=0_traceur_livreur'); 
                                        $sql = 'select nom_client,prenom_client,adresse_client,tel_client,nom_ville from client, ville where client.id_ville = ville.id_ville order by nom_ville';
                                        $rs = pg_exec($idc, $sql);
                                        while ($ligne = pg_fetch_assoc($rs))
                                        {

                                        print("<tr>");
                                        print("<td>".$ligne['nom_client']."</td>");
                                        print("<td>".$ligne['prenom_client']."</td>");
                                        print("<td>".$ligne['adresse_client']."</td>");
                                        print("<td>".$ligne['tel_client']."</td>");
                                        print("<td>".$ligne['nom_ville']."</td>");
                                        print("</tr>");

                                        }
                                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


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
    </div>

</body>

</html>
