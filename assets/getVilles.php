<?php

//1. Bdd Connection
$connexion = "host=127.0.0.1 port=5432 user=postgres password=postgres dbname=0_traceur_livreur";
$dbconnexion = pg_connect($connexion);

//2. SQL Query
$sql = 'SELECT id_ville as id,nom_ville, cp_ville, st_x(ST_Transform(geom,4326)) as lng, st_y(ST_Transform(geom,4326)) as lat FROM ville';

//3. Create a resultset
$result = pg_query($dbconnexion, $sql);
$point = pg_fetch_all($result);

//4. Build GeoJSON feature collection array
$geojson = array(
   'type'      => 'FeatureCollection',
   'features'  => array()
);

# Loop through rows to build feature arrays
foreach ($point as $p) {
    $feature = array(
        'id' => $p['id'],
        'type' => 'Feature',
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => array($p['lng'], $p['lat'])),
        'properties' => array(
            'id' => $p['id'],
            'nom_ville' => $p['nom_ville'],
            'cp_ville' => $p['cp_ville'])
    );
    # Add feature arrays to feature collection array
    array_push($geojson['features'], $feature);
}

//5. Define json header
header('Content-type: application/json');

// 6. Print 
echo json_encode($geojson, JSON_NUMERIC_CHECK);