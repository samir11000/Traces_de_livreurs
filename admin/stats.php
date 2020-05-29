<!DOCTYPE html>

<html>

<head>
    <title>Ubber Camion - Statistics</title>
    <link rel="icon" href="img/favicon.ico" />
    <meta charset="UTF-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

    <!-- FusionCharts core package JS files -->
    <script src="https://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
    <script src="https://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>
    <script src="https://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js"></script>


</head>

<body id="body">
    <?php

    include("assets/header.php");

    ?>

    <div id="layoutSidenav_content">
        <main>

            <?php
                        // including FusionCharts PHP wrapper
                        include("lib/fusioncharts/fusioncharts.php");

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

                        $result = pg_query($dbconn, "select nom_ville,count(*) as nb from client, ville where ville.id_ville = client.id_ville group by nom_ville; ") or exit("Error with quering database");

                      //if ($result) {
                      // creating an associative array to store the chart attributes
                        $arrData = array(
                            "chart" => array(
                                // caption and sub-caption customization
//                                "caption"=> "Source Swath Descriptor",
//                                "captionFontSize"=> "24",
//                                "captionFontColor"=> "#0c0c0d",
//                                "captionPadding"=> "20",

                                // font and text size customization
                                "baseFont"=> "Helvetica Neue, sans-serif",
                                "baseFontColor"=> "#ABA39D",
                                "outCnvBaseColor"=> "#ABA39D",
                                "baseFontSize"=> "15",
                                "outCnvBaseFontSize"=> "15",

                                // div line customization
                                "divLineColor"=> "#ABA39D",
                                "divLineAlpha"=> "22",
                                "numDivLines"=> "5",

                                // y-axis scale customization
                                "yAxisMinValue"=> "0",
                                "yAxisMaxValue"=> "10",

                                // tool-tip customization
                                "toolTipBorderColor"=> "#ABA8B7",
                                "toolTipBgColor"=> "#F5F3F1",
                                "toolTipPadding"=> "13",
                                "toolTipAlpha"=> "50",
                                "toolTipBorderThickness"=> "2",
                                "toolTipBorderAlpha"=> "30",
                                "toolTipColor"=> "#4D394B",
                                "plotToolText"=> "<div style='text-align: center; line-height: 1.5;'>Ville \$label <br>\$value Clients<div>",


                                // other customizations
                                "theme"=> "fint",
                                "paletteColors"=> "#6f90f2",
                                "showBorder"=> "0",
                                    "bgColor"=> "#ffffff",
                                "canvasBgColor"=> "#ffffff",
                                "bgAlpha"=> "100",
                                "showValues"=> "0",
                                "formatNumberScale"=> "0",
                                "plotSpacePercent"=> "10",
                                "showcanvasborder"=> "0",
                                "showPlotBorder"=> "0"
                              )
                        );
                      
                        $arrData["data"] = array();
                        

                        // iterating over each data and pushing it into $arrData array
                        while($row = pg_fetch_array($result)) {
                            array_push($arrData["data"], array(
                                "label" => $row["nom_ville"],
                                "value" => $row["nb"]
                                )
                            );
                        }
                    


                        $jsonEncodedData = json_encode($arrData);


                        // creating FusionCharts instance
                        $postgresChart = new FusionCharts("column2d", "topMedalChart" , '100%', '300', "postgres-chart", "json", $jsonEncodedData);


                        // FusionCharts render method
                        $postgresChart->render();


                        // closing database connection
                        pg_close($dbconn);

                      //}

                    ?>


            <div class="card mt-4">
                <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Nombre de clients / Villes</div>
                <div id="postgres-chart"></div>
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
                                        $sql = 'select nom_client,prenom_client,adresse_client,tel_client,nom_ville from client, ville where client.id_ville = ville.id_ville';
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

        </main>

    </div>
</body>

</html>
