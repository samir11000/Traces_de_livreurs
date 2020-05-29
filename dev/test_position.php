<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>HTML5 : Géolocalisation</title>
</head>

<script src="https://maps.google.com/maps/api/js?key=lacleAPIici"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=set_to_true_or_false"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

<body>
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

    <button id="button1">Start</button>

    <!-- Un élément HTML pour recueillir l’affichage -->
    <div id="lat"></div>
    <div id="lon"></div>
    <div id="day"></div>
    <div id="time"></div>
    <div id="speed"></div>
    <div id="macarte"></div>

    <script type="text/javascript">
    var button = document.getElementById("button1");
    // Fonction de callback en cas de succès
    var lat,lon,date,hour,minutes,day,speed;
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
                "name" : "",
                "date" : day,
                "time": hour + ":" + minutes,
                "speed": speed
            }
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "test_position.php",
            data: { choix: 'add', data: newPoint}
        })
    }


    // On déclare la variable survId afin de pouvoir par la suite annuler le suivi de la position
    button.onclick = (event) => {
        var survId = navigator.geolocation.watchPosition(surveillePosition);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "test_position.php",
            data: { choix: 'create'}
        })
        window.addEventListener('beforeunload', (event) => {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "test_position.php",
                    data: { choix: 'delete'}
                })
                location.reload();
                return false;
            // Google Chrome requires returnValue to be set.
                event.returnValue = '';
            });
        };


</script>
</body>

</html>
