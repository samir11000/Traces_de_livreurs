<?php session_start();

//1. Bdd Connection
include 'connexion_bdd.php';

//2. SQL Query
$sql = 'SELECT id_coordonees as id,point_depart_troncon,point_arrivee_troncon,vitesse_coordonees, st_x(ST_Transform(geom,4326)) as lng, st_y(ST_Transform(geom,4326)) as lat FROM coordonees, troncon WHERE coordonees.id_troncon = troncon.id_troncon order by id';

//3. Create a resultset
$result = pg_query($connec, $sql);
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
            'point_depart_troncon' => $p['point_depart_troncon'],
            'point_arrivee_troncon' => $p['point_arrivee_troncon'],
            'vitesse_coordonees' => $p['vitesse_coordonees'])
    );
    # Add feature arrays to feature collection array
    array_push($geojson['features'], $feature);
}

//5. Define json header
header('Content-type: application/json');

// 6. Print 
echo json_encode($geojson, JSON_NUMERIC_CHECK);
