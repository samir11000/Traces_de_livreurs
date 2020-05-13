<!DOCTYPE html>

<html>

<head>
    <title>Ubber Camion - Tracking</title>
    <link rel="icon" href="img/favicon.ico" />
    <meta charset="UTF-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">

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
    <!-- MousePosition CSS -->
    <link rel="stylesheet" href="lib/plugin/Leaflet.MousePosition-master/src/L.Control.MousePosition.css">

    <!-- Marker CSS -->
    <link rel="stylesheet" href="lib/plugin/Leaflet.markercluster-master/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="lib/plugin/Leaflet.markercluster-master/dist/MarkerCluster.Default.css" />



    <style>
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

    </style>

</head>

<body id="body">
    <?php

    include("assets/header.php");

    ?>
    <div id="layoutSidenav_content">
        <main>

            <div class="container-fluid mt-2">

                <button id="loadPoints" type="button" class="btn btn-primary mb-2">Trajet</button>
                <button type="button" class="btn btn-success mb-2">Camion</button>
                <button type="button" class="btn btn-secondary mb-2">Client</button>

                <div class="row">
                    <div class="col-10" id="macarte"></div>
                    <div class="col-2">

                        <select>
                            <option>Choisissez votre requete</option>
                            <option value="trajet">Trajet</option>
                            <option value="camion">Camion</option>
                            <option value="client">Client</option>
                        </select>
                        <div class="trajet msg">
                            <form>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Email address</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Example select</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Example multiple select</label>
                                    <select multiple class="form-control" id="exampleFormControlSelect2">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Example textarea</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>

                            </form>
                        </div>
                        <div class="camion msg">Vous avez sélectionné le Camion</div>
                        <div class="client msg">Vous avez sélectionné le Client</div>
                    </div>
                </div>

            </div>

        </main>

    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

    <!-- Leaflet Script -->
    <script src="lib/leaflet/leaflet.js"></script>
    <!-- Measure Script -->
    <script src="https://ppete2.github.io/Leaflet.PolylineMeasure/Leaflet.PolylineMeasure.js"></script>
    <!-- Geocoder Script -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <!-- Turf Script -->
    <script src="lib/turf.js"></script>
    <!-- Jquery Script -->
    <script src="lib/jquery/jquery-3.4.1.min.js"></script>
    <script src="js/conf.js"></script>
    <!-- Main Script -->
    <script src="js/main.js"></script>
    <!-- Fullscreen Script -->
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <!-- MousePosition Script -->
    <script src="lib/plugin/Leaflet.MousePosition-master/src/L.Control.MousePosition.js"></script>
    <!-- Marker Script -->
    <script src="lib/plugin/Leaflet.markercluster-master/dist/leaflet.markercluster-src.js"></script>

    <script src="lib/plugin/leaflet-routing-machine-3.2.12/dist/leaflet-routing-machine.js"></script>



    <script src="data/geojson1.js"></script>
    <script src="data/geojson2.js"></script>
    <script src="data/geojson3.js"></script>
    <script src="data/geojson4.js"></script>

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
        addGeoJsonLayer(geojson1, "Iut", {
            radius: 5,
            fillColor: "orange",
            color: "orange",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
        });

        addGeoJsonLayer(geojson2, "Golf", {
            "color": "red",
            fillColor: "none",
            "weight": 5,
            "opacity": 0.65
        });

        addGeoJsonLayer(geojson3, "Cité de Carcassonne", {
            radius: 5,
            fillColor: "red",
            color: "red",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
        });

        addGeoJsonLayer(geojson4, "Limite département Aude", {
            "color": "red",
            fillColor: "none",
            "weight": 5,
            "opacity": 0.65
        });

        //Add control layer
        addControlScale();

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("select").change(function() {
                $(this).find("option:selected").each(function() {
                    var val = $(this).attr("value");
                    if (val) {
                        $(".msg").not("." + val).hide();
                        $("." + val).show();
                    } else {
                        $(".msg").hide();
                    }
                });
            }).change();
        });

    </script>

</body>

</html>
