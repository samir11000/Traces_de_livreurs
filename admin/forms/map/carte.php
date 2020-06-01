<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="../../../img/favicon.ico" />
    <title>Tableau de bord - Carte administration</title>
    <link href="/admin/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

    <!-- Measure CSS -->
    <link rel="stylesheet" href="https://ppete2.github.io/Leaflet.PolylineMeasure/Leaflet.PolylineMeasure.css" />
    <!-- Geocoder CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <!-- Fullscreen CSS -->
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
    <!-- MarkerNumbered CSS -->
    <link rel="stylesheet" href="../../../lib/plugin/Leaflet_numbered_markers/leaflet_numbered_markers.css" />

    <!-- MarkerCluster CSS -->
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/0.4.0/MarkerCluster.css" />
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/0.4.0/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="../../../lib/plugin/GpPluginLeaflet-2.1.5/leaflet/GpPluginLeaflet.css" />

    <link rel="stylesheet" href="https://makinacorpus.github.io/Leaflet.FileLayer/Font-Awesome/css/font-awesome.min.css" />

    <style>
        /*Legend specific*/
        .legend {
            padding: 6px 8px;
            font: 14px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
            /*border-radius: 5px;*/
            line-height: 24px;
            color: #555;
        }

        .legend h4 {
            text-align: center;
            font-size: 16px;
            margin: 2px 12px 8px;
            color: #777;
        }

        .legend span {
            position: relative;
            bottom: 3px;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin: 0 8px 0 0;
            opacity: 0.7;
        }

        .legend i.icon {
            background-size: 18px;
            background-color: rgba(255, 255, 255, 1);
        }

    </style>

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
    
    <?php
    if (empty($_SESSION))
        session_start();

        if(isset($_POST['choix']) && $_POST['choix'] == "create")
        {
            $f = fopen("".$_SESSION['locale'][1].".geojson", "w");
            fwrite($f, '{
                "type": "FeatureCollection",
                "features": [ 
                ]
            }');
        }

        if(isset($_POST['data']) && isset($_POST['choix']) && $_POST['choix'] == "add")
        {
            $f = fopen("".$_SESSION['locale'][1].".geojson", "r") or die("Unable to open file!");
            $fileContent = fread($f, filesize($_SESSION['locale'][1].".geojson"));
            $jsonData = json_decode($fileContent, true);
            $_POST['data']['properties']['name'] = $_SESSION['locale'][1];

            $jsonData['features'][] = $_POST['data'];
            
            $jsonData = json_encode($jsonData);

            $f2 = fopen("".$_SESSION['locale'][1].".geojson", "w") or die("Unable to open file!");

            fwrite($f2, $jsonData);

            fclose($f);
            fclose($f2);
        }

        if(isset($_POST['choix']) && $_POST['choix'] == "delete")
        {
            $file = $_SESSION['locale'][1].".geojson";
            if(!unlink($file))
            {
                echo("Erreur dans la suppresion du fichier !");
            }
            else
            {
                echo("Fichier supprimé");
            }
        }
    ?>

    <div id="layoutSidenav_content">
        <main>
            <?php
                if(isset($_SESSION["register_errors"]))
                {
                    echo "<div class=\"alert alert-danger mt-2 mr-3 ml-3\">";
                    foreach($_SESSION["register_errors"] as $value){
                        echo nl2br($value."\n");
                    }
                    echo "</div>";
                    unset($_SESSION["register_errors"]);
                }
                
                if(isset($_SESSION["successful"]))
                {
                    echo "<div class=\"alert alert-success mt-2 mr-3 ml-3\">";
                    foreach($_SESSION["successful"] as $value){
                        echo nl2br($value."\n");
                    }
                    echo "</div>";
                    unset($_SESSION["successful"]);
                }
            ?>
            <div class="container-fluid mt-2">
                <h3>Carte Administration</h3>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="../../main.php">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Carte Administration</li>
                </ol>

                <main>



                        <button id="loadClients" type="button" class="btn btn-primary mb-2">Client</button>
                        <button id="loadVilles" type="button" class="btn btn-primary mb-2">Villes</button>
                        <button id="loadTrajets" type="button" class="btn btn-primary mb-2">Trajets</button>
                        <button id="loadVitesses" type="button" class="btn btn-primary mb-2">Vitesse</button>
                        <button id="geofencing" type="button" class="btn btn-primary mb-2">Geofencing</button>

                        <input id="myfiles" multiple type="file">

                    <div class="row mt-2">
                        <div class="carte " id="macarte"></div>
                    </div>

                    <div class="row mt-2">

                        <select>
                            <option>Choisissez votre requete</option>
                            <option value="client">Clients</option>
                            <option value="ville">Villes</option>
                            <option value="trajet">Trajet</option>
                        </select>
                    </div>

                    <div class="client msg">
                        <ul id="list1"></ul>
                    </div>
                    <div class="ville msg">
                        <ul id="list2"></ul>
                    </div>
                    <div class="trajet msg">
                        <ul id="list3"></ul>
                    </div>

                </main>

            </div>
        </main>
    </div>


    <!-- Jquery Script -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <!-- Bootstrap Script -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
    <script src="../../js/scripts.js"></script>
    <script src="ajax/ajax.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../../assets/demo/chart-area-demo.js"></script>
    <script src="../../assets/demo/chart-bar-demo.js"></script>
    <script src="../../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="../../js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../../assets/demo/datatables-demo.js"></script>


    <!-- Leaflet Script -->
    <script src="../../../lib/leaflet/leaflet.js"></script>

    <!-- Measure Script -->
    <script src="https://ppete2.github.io/Leaflet.PolylineMeasure/Leaflet.PolylineMeasure.js"></script>
    <!-- Geocoder Script -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <!-- Turf Script -->
    <script src="../../../lib/turf.js"></script>
    <!-- Conf Script -->
    <script src="../../../js/conf.js"></script>
    <!-- Fullscreen Script -->
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <!-- MarkerNumbered Script -->
    <script src="../../../lib/plugin/Leaflet_numbered_markers/leaflet_numbered_markers.js"></script>
    <!-- MarkerCluster Script -->
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js'></script>

    <script src="../../../lib/L.KML.js"></script>

    <script src="https://makinacorpus.github.io/Leaflet.FileLayer/leaflet.filelayer.js">
    </script>
    <script src="https://makinacorpus.github.io/Leaflet.FileLayer/togeojson/togeojson.js">
    </script>
    <!-- Omnivore Script -->
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.2.0/leaflet-omnivore.min.js'></script>

    <script src="../../../js/querySelect.js"></script>

    <!-- Geojson Script -->
    <script src="../../../data/Aude.js"></script>
    <script src="../../../data/Depot.js"></script>
    <script src="../../../data/limite_carcassonne.js"></script>
    <!-- Main Script -->
    <script src="admin_map.js"></script>


    <!-- General Script to call function-->
    <script type="text/javascript">
        //Create map
        createMap("macarte");

        //Set view
        setMapView(_LATITUDE, _LONGITUDE, _ZOOM);

        //Add control layer
        addControlLayers();


        //Add OSM Layer
        addTileLayer("http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}", "Google");
        addTileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", "OSM");
        addTileLayer("https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png", "Main");

        //Add geoJson Layer
        addGeoJsonLayer(Aude, "Aude", {
            "color": "red",
            fillColor: "none",
            "weight": 5,
            "opacity": 0.65
        });

        addGeoJsonLayer(Depot, "Depot", {
            "color": "black",
            fillColor: "blue",
            "weight": 1,
            "opacity": 0.65
        });

        addGeoJsonLayer(limite_carcassonne, "Zone 1", {
            "color": "black",
            fillColor: "blue",
            "weight": 1,
            "opacity": 0.65
        });

        //Add control layer
        addControlScale();

        var fichier;

        var recupererFichiers = function() {
            var fichiersInput = document.querySelector("#myfiles");
            var fichiers = fichiersInput.files;

            var nbFichiers = fichiers.length;
            var i = 0;
            while (i < nbFichiers) {
                fichier = fichiers[i];
                console.log(fichier.name);
                i++;
            }
        }

        // On invoque cette fonction pour chaque modification apportée à l'élément
        // input
        document.querySelector("#myfiles").onchange = recupererFichiers;

        omnivore.kml('../../../data/Trajet1305.kml').addTo(map);

    </script>


</body>

</html>
