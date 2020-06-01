<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Test GPS</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <script src="GPSControl.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <style>
        .gps-control a i {
            padding-top: 3px;
            cursor: pointer;
        }

    </style>
</head>

<body>
    <?php

    if (empty($_SESSION))
        
        include("../assets/header.php");

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

    <button id="button1" type="button" class="btn btn-primary mb-2">Start</button>

    <!-- Un élément HTML pour recueillir l’affichage -->
    <div id="lat" style="font-size:15px;color: white"></div>
    <div id="lon" style="font-size:15px;color: white"></div>
    <div id="day" style="font-size:15px;color: white"></div>
    <div id="time" style="font-size:15px;color: white"></div>
    <div id="speed" style="font-size:15px;color: white"></div>

    <div id="map"></div>
    <div id="msg" style="font-size:15px;color: white"></div>


    <script>
        var msg = document.getElementById('msg');
        var map = L.map('map');
        map.setZoom(18);
        new L.TileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
            minZoom: 5,
            maxZoom: 20,
            attribution: '<a href="http://www.openstreetmap.org/about/" target="_blank">© OpenStreetMap contributors</a>'
        }).addTo(map);

        new GPSControl({
            track: true,
            activeCallback: active => {
                msg.innerHTML += 'GPS tracking is active ? ' + active + '<br/>';
            },
            successCallback: latlng => {
                L.marker(latlng).addTo(map);

                msg.innerHTML += 'GPS tracking detected a position change : ' + latlng + '<br/>';
                map.setView(latlng);
            },
            errorCallback: error => {
                msg.innerHTML += 'GPS tracking failed : ' + error.message + '<br/>';
            }
        }).addTo(map);

    </script>

    <script type="text/javascript">
        var button = document.getElementById("button1");
        // Fonction de callback en cas de succès
        var lat, lon, date, hour, minutes, day, speed;

        function surveillePosition(position) {
            lat = position.coords.latitude;
            document.getElementById("lat").innerHTML = "Latitude : " + lat;
            lon = position.coords.longitude;
            document.getElementById("lon").innerHTML = "Longitude : " + lon;
            date = new Date(position.timestamp);
            hour = date.getHours();
            minutes = ("0" + date.getMinutes()).slice(-2);
            day = date.toLocaleDateString()
            document.getElementById("day").innerHTML = "Jour : " + day;
            document.getElementById("time").innerHTML = "Temps : " + hour + ":" + minutes;
            speed = position.coords.speed * 3.6;
            document.getElementById("speed").innerHTML = "Vitesse : " + speed;

            var newPoint = {
                "type": "Feature",
                "geometry": {
                    "type": "Point",
                    "coordinates": [lon, lat]
                },
                "properties": {
                    "name": "",
                    "date": day,
                    "time": hour + ":" + minutes,
                    "speed": speed
                }
            }

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "test_position.php",
                data: {
                    choix: 'add',
                    data: newPoint
                }
            })
        }


        // On déclare la variable survId afin de pouvoir par la suite annuler le suivi de la position
        button.onclick = (event) => {
            var survId = navigator.geolocation.watchPosition(surveillePosition);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "test_position99.php",
                data: {
                    choix: 'create'
                }
            })
            window.addEventListener('beforeunload', (event) => {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "test_position99.php",
                    data: {
                        choix: 'delete'
                    }
                })
                location.reload();
                return false;
                // Google Chrome requires returnValue to be set.
                event.returnValue = '';
            });
        };

    </script>

    <style>
        html,
        body {
            width: 100%;
            height: 100%;
        }

        .leaflet-container {
            width: 100%;
            height: 500px;
        }

    </style>
</body>

</html>
