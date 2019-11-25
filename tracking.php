<!DOCTYPE html>

<html>

<head>
    <title>Ubber Camion - Accueil</title>
    <link rel="icon" href="img/favicon.ico" />
    <meta charset="UTF-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="css/leaflet.css"><link rel="stylesheet" href="css/L.Control.Locate.min.css">
    <link rel="stylesheet" href="css/qgis2web.css"><link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/leaflet-search.css">
    <link rel="stylesheet" href="css/leaflet-control-geocoder.Geocoder.css">
    <link rel="stylesheet" href="css/leaflet-measure.css">
    <style>
    html, body, #map {
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
    }
    </style>
</head>

<body id="body">
    <?php

    include("assets/header.php");

    ?>

    <div id="map" style="height : 94%">
        
    </div>
        
        <script src="js/qgis2web_expressions.js"></script>
        <script src="js/leaflet.js"></script><script src="js/L.Control.Locate.min.js"></script>
        <script src="js/leaflet.rotatedMarker.js"></script>
        <script src="js/leaflet.pattern.js"></script>
        <script src="js/leaflet-hash.js"></script>
        <script src="js/Autolinker.min.js"></script>
        <script src="js/rbush.min.js"></script>
        <script src="js/labelgun.min.js"></script>
        <script src="js/labels.js"></script>
        <script src="js/leaflet-control-geocoder.Geocoder.js"></script>
        <script src="js/leaflet-measure.js"></script>
        <script src="js/leaflet-search.js"></script>
        <script src="data/Dpartements_1.js"></script>
        <script src="data/Aude_2.js"></script>
        <script src="data/Depot_IUT_3.js"></script>
        <script>
        var map = L.map('map', {
            zoomControl:true, maxZoom:28, minZoom:1
        }).fitBounds([[42.62848472158459,1.5994567789982823],[43.480195786577276,3.329121937372047]]);
        var hash = new L.Hash(map);
        L.control.locate({locateOptions: {maxZoom: 19}}).addTo(map);
        var measureControl = new L.Control.Measure({
            position: 'topleft',
            primaryLengthUnit: 'meters',
            secondaryLengthUnit: 'kilometers',
            primaryAreaUnit: 'sqmeters',
            secondaryAreaUnit: 'hectares'
        });
        measureControl.addTo(map);
        document.getElementsByClassName('leaflet-control-measure-toggle')[0]
        .innerHTML = '';
        document.getElementsByClassName('leaflet-control-measure-toggle')[0]
        .className += ' fas fa-ruler';
        var bounds_group = new L.featureGroup([]);
        function setBounds() {
        }
        var layer_OpenStreetMap_0 = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            opacity: 1.0,
            attribution: '',
            minZoom: 1,
            maxZoom: 28,
            minNativeZoom: 0,
            maxNativeZoom: 19
        });
        layer_OpenStreetMap_0;
        map.addLayer(layer_OpenStreetMap_0);
        function pop_Dpartements_1(feature, layer) {
            var popupContent = '<table>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['id'] !== null ? Autolinker.link(String(feature.properties['id'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">nom_dep0</th>\
                        <td>' + (feature.properties['nom_dep0'] !== null ? Autolinker.link(String(feature.properties['nom_dep0'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['insee_dep'] !== null ? Autolinker.link(String(feature.properties['insee_dep'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['insee_reg'] !== null ? Autolinker.link(String(feature.properties['insee_reg'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['nom_reg'] !== null ? Autolinker.link(String(feature.properties['nom_reg'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['region0'] !== null ? Autolinker.link(String(feature.properties['region0'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['nom_dep'] !== null ? Autolinker.link(String(feature.properties['nom_dep'])) : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_Dpartements_1_0() {
            return {
                pane: 'pane_Dpartements_1',
                opacity: 1,
                color: 'rgba(35,35,35,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 1.0, 
                fill: true,
                fillOpacity: 1,
                fillColor: 'rgba(231,113,72,0.0)',
                interactive: true,
            }
        }
        map.createPane('pane_Dpartements_1');
        map.getPane('pane_Dpartements_1').style.zIndex = 401;
        map.getPane('pane_Dpartements_1').style['mix-blend-mode'] = 'normal';
        var layer_Dpartements_1 = new L.geoJson(json_Dpartements_1, {
            attribution: '',
            interactive: true,
            dataVar: 'json_Dpartements_1',
            layerName: 'layer_Dpartements_1',
            pane: 'pane_Dpartements_1',
            onEachFeature: pop_Dpartements_1,
            style: style_Dpartements_1_0,
        });
        bounds_group.addLayer(layer_Dpartements_1);
        map.addLayer(layer_Dpartements_1);
        function pop_Aude_2(feature, layer) {
            var popupContent = '<table>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['id'] !== null ? Autolinker.link(String(feature.properties['id'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <th scope="row">nom_dep0</th>\
                        <td>' + (feature.properties['nom_dep0'] !== null ? Autolinker.link(String(feature.properties['nom_dep0'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['insee_dep'] !== null ? Autolinker.link(String(feature.properties['insee_dep'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['insee_reg'] !== null ? Autolinker.link(String(feature.properties['insee_reg'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['nom_reg'] !== null ? Autolinker.link(String(feature.properties['nom_reg'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['region0'] !== null ? Autolinker.link(String(feature.properties['region0'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['nom_dep'] !== null ? Autolinker.link(String(feature.properties['nom_dep'])) : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_Aude_2_0() {
            return {
                pane: 'pane_Aude_2',
                opacity: 1,
                color: 'rgba(227,26,28,1.0)',
                dashArray: '',
                lineCap: 'butt',
                lineJoin: 'miter',
                weight: 4.0, 
                fill: true,
                fillOpacity: 1,
                fillColor: 'rgba(152,125,183,0.0)',
                interactive: true,
            }
        }
        map.createPane('pane_Aude_2');
        map.getPane('pane_Aude_2').style.zIndex = 402;
        map.getPane('pane_Aude_2').style['mix-blend-mode'] = 'normal';
        var layer_Aude_2 = new L.geoJson(json_Aude_2, {
            attribution: '',
            interactive: true,
            dataVar: 'json_Aude_2',
            layerName: 'layer_Aude_2',
            pane: 'pane_Aude_2',
            onEachFeature: pop_Aude_2,
            style: style_Aude_2_0,
        });
        bounds_group.addLayer(layer_Aude_2);
        map.addLayer(layer_Aude_2);
        function pop_Depot_IUT_3(feature, layer) {
            var popupContent = '<table>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['id'] !== null ? Autolinker.link(String(feature.properties['id'])) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2">' + (feature.properties['name'] !== null ? Autolinker.link(String(feature.properties['name'])) : '') + '</td>\
                    </tr>\
                </table>';
            layer.bindPopup(popupContent, {maxHeight: 400});
        }

        function style_Depot_IUT_3_0() {
            return {
                pane: 'pane_Depot_IUT_3',
                opacity: 1,
                color: 'rgba(53,121,177,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 4.0,
                fillOpacity: 0,
                interactive: true,
            }
        }
        map.createPane('pane_Depot_IUT_3');
        map.getPane('pane_Depot_IUT_3').style.zIndex = 403;
        map.getPane('pane_Depot_IUT_3').style['mix-blend-mode'] = 'normal';
        var layer_Depot_IUT_3 = new L.geoJson(json_Depot_IUT_3, {
            attribution: '',
            interactive: true,
            dataVar: 'json_Depot_IUT_3',
            layerName: 'layer_Depot_IUT_3',
            pane: 'pane_Depot_IUT_3',
            onEachFeature: pop_Depot_IUT_3,
            style: style_Depot_IUT_3_0,
        });
        bounds_group.addLayer(layer_Depot_IUT_3);
        map.addLayer(layer_Depot_IUT_3);
        var osmGeocoder = new L.Control.Geocoder({
            collapsed: true,
            position: 'topleft',
            text: 'Search',
            title: 'Testing'
        }).addTo(map);
        document.getElementsByClassName('leaflet-control-geocoder-icon')[0]
        .className += ' fa fa-search';
        document.getElementsByClassName('leaflet-control-geocoder-icon')[0]
        .title += 'Search for a place';
        var baseMaps = {};
        L.control.layers(baseMaps,{'<img src="legend/Depot_IUT_3.png" /> Depot_IUT': layer_Depot_IUT_3,'<img src="legend/Aude_2.png" /> Aude': layer_Aude_2,'<img src="legend/Dpartements_1.png" /> Départements': layer_Dpartements_1,"OpenStreetMap": layer_OpenStreetMap_0,}).addTo(map);
        setBounds();
        map.addControl(new L.Control.Search({
            layer: layer_Dpartements_1,
            initial: false,
            hideMarkerOnCollapse: true,
            propertyName: 'nom_dep'}));
        document.getElementsByClassName('search-button')[0].className +=
         ' fa fa-binoculars';
        </script>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js " integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin="anonymous "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js " integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin="anonymous "></script>
<script src="js/bootstrap.min.js "></script>
</html>
