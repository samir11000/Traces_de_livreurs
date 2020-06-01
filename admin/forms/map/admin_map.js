//Global variables
var map = null; //Leaflet map object
var controlLayers = null; //Leaflet control Layer
var controlScale = null; //Leaflet control Layer

var baseMaps = null; //baseMaps object = list of baseMaps Layer type
var overlayMaps = null; //overlayMaps object = list of overlayMaps Layer type
var featuresPointCollection = null;



$(document).ready(function () {
    //Click on button
    $("button#loadClients").click(function () {
        //2eme methode
        $.getJSON("assets/getClients.php", function (response) {
            addGeoJsonLayer1(response, "Clients");
            addList1(response);
            // Set features in featuresPointCollection
            featuresPointCollection = response;
        });
    });

    //Click on button Villes
    $("button#loadVilles").click(function () {
        //2eme methode
        $.getJSON("assets/getVilles.php", function (response) {
            addGeoJsonLayer2(response, "Villes");
            addList2(response);
            // Set features in featuresPointCollection
            featuresPointCollection = response;
        });
    });

    //Click on button Trajets
    $("button#loadTrajets").click(function () {
        //2eme methode
        $.getJSON("assets/getTrajets.php", function (response) {
            addGeoJsonLayer3(response, "Trajets");
            addList3(response);
            // Set features in featuresPointCollection
            featuresPointCollection = response;
        });
    });

    //Click on button Vitesses
    $("button#loadVitesses").click(function () {
        //2eme methode
        $.getJSON("assets/getTrajets.php", function (response) {
            addGeoJsonLayer4(response, "Vitesses");

            // Set features in featuresPointCollection
            featuresPointCollection = response;
        });
    });

    //Click on button geofencing
    $("button#geofencing").click(function () {
        //2eme methode
        $.getJSON("assets/getTrajets.php", function (response) {
            geofencing(response);

            // Set features in featuresPointCollection
            featuresPointCollection = response;
        });

    });


    $("body").on("click", "li.geoJsonData", function () {
        var lat = $(this).attr("data-lat");
        var lng = $(this).attr("data-lng");
        //alert("lat : " + lat + " et lng : " + lng);
        setMapView(lat, lng, 18);
    });



});



/**
 * @function createMap
 * @desc Create a Leaflet map in a html container
 * @param strind id
 * @return null
 */

function createMap(id) {
    map = L.map(id);


    map.addControl(new L.Control.Fullscreen());

    // Measure
    L.control.polylineMeasure().addTo(map);

    // Geocoder
    L.Control.geocoder().addTo(map);

}

/**
 * @function setMapView
 * @desc set view to map
 * @param float lat
 * @param float long
 * @param integer zoom
 * @return null
 */
function setMapView(lat, lng, zoom) {
    map.setView([lat, lng], zoom);
}

/**
 * @function addControlLayers
 * @desc add a Control layer to map
 * @param 
 * @return null
 */
function addControlLayers() {
    controlLayers = L.control.layers(baseMaps, overlayMaps).addTo(map);
}

/**
 * @function addTileLayer
 * @desc add a tile layer to map
 * @param string url
 * @return null
 */
function addTileLayer(url, name) {
    var layer = L.tileLayer(url, {
        attribution: 'Carte de projet',
    });

    layer.addTo(map);

    controlLayers.addBaseLayer(layer, name);

}


function onEachFeature(feature, layer) {
    var popupContent = "<div class=\"p-3 mb-2 bg-primary text-white\">Informations</div>";
    for (var key in feature.properties) {
        popupContent += ("<b>" + key + "</b> :" + feature.properties[key] + "</br>");
    }

    layer.bindPopup(popupContent);
}

/**
 * @function addGeoJsonLayer
 * @desc add a geojson to map
 * @param json geoJsonData
 * @return null
 */

function addGeoJsonLayer(geoJsonData, name, style) {

    var layer = L.geoJSON(geoJsonData, {
        style: function (feature) {
            return style;
        },
        onEachFeature: onEachFeature,
        pointToLayer: function (feature, latlng) {
            return L.circleMarker(latlng, style);
        }

    });

    layer.addTo(map);

    controlLayers.addOverlay(layer, name);
}

function addGeoJsonLayer1(geoJsonData, name, style) {
    var layer = L.geoJSON(geoJsonData, {
        pointToLayer: function (feature, latlng) {
            var Icon = new L.NumberedDivIcon({
                iconSize: [1, 1],
                iconAnchor: [1, 1],
                iconUrl: '/img/clients.png'
            });

            return L.marker(latlng, {
                icon: Icon
            });
        },
        onEachFeature: onEachFeature
    });

    layer.addTo(map);

    controlLayers.addOverlay(layer, name);
}

function addGeoJsonLayer2(geoJsonData, name, style) {

    var layer = L.geoJSON(geoJsonData, {
        pointToLayer: function (feature, latlng) {
            var Icon = new L.NumberedDivIcon({
                number: feature.properties.nom_ville,
                iconSize: [1, 1],
                iconAnchor: [10, 10],
                iconUrl: '/img/villes.png'
            });

            return L.marker(latlng, {
                icon: Icon
            });
        },
        onEachFeature: onEachFeature
    });

    layer.addTo(map);

    controlLayers.addOverlay(layer, name);
}

function addGeoJsonLayer3(geoJsonData, name, style) {

    var layer = L.geoJSON(geoJsonData, {
        pointToLayer: function (feature, latlng) {
            var Icon = new L.NumberedDivIcon({
                iconSize: [1, 1],
                iconAnchor: [10, 10],
                iconUrl: '/img/trajets.png'
            });

            return L.marker(latlng, {
                icon: Icon
            });
        },
        onEachFeature: onEachFeature
    });

    var clusters = L.markerClusterGroup();

    var lineCoordinate = [];
    var nb = 0;

    for (var i in geoJsonData.features) {
        var pointJson = geoJsonData.features[i];
        var coord = pointJson.geometry.coordinates;
        nb = nb + 1;
        lineCoordinate.push([coord[1], coord[0]]);

    }

    var line = turf.lineString(lineCoordinate);
    var length = turf.length(line, {
        units: 'kilometers'
    });

    var polyline = L.polyline(lineCoordinate, {
        color: 'red'
    });
    polyline.addTo(layer).bindPopup('Longueur trajet: ' + Math.round((length * 1000) / 1000) + ' Km - ' + nb + ' Points ');


    clusters.addLayer(layer);
    map.addLayer(clusters);

    controlLayers.addOverlay(clusters, 'Trajet');
}

var stylePoint1 = {
    radius: 12,
    fillColor: "red",
    color: "none",
    weight: 1,
    opacity: 1,
    fillOpacity: 0.6
};

function addGeoJsonLayer4(geoJsonData, name, style) {
    var layer = L.geoJSON(geoJsonData, {
        style: function (feature) {
            var fillColor;
            vitesse = feature.properties.vitesse_coordonees;
            if (vitesse > 50) fillColor = "#BD0026";
            else if (vitesse > 40) fillColor = "#FD8D3C";
            else if (vitesse > 20) fillColor = "#FED976";
            else if (vitesse > 10) fillColor = "#c2e699";
            else if (vitesse > 0) fillColor = "#006837";
            else fillColor = "#f7f7f7"; // no data
            var stylePoint1 = {
                radius: 12,
                fillColor: fillColor,
                color: "none",
                weight: 1,
                opacity: 1,
                fillOpacity: 0.6
            };
            return stylePoint1;
        },
        onEachFeature: onEachFeature,
        pointToLayer: function (feature, latlng) {
            return L.circleMarker(latlng, stylePoint1);
        }

    });

    var lineCoordinate = [];
    var nb = 0;

    for (var i in geoJsonData.features) {
        var pointJson = geoJsonData.features[i];
        var coord = pointJson.geometry.coordinates;
        nb = nb + 1;
        lineCoordinate.push([coord[1], coord[0]]);

    }

    var line = turf.lineString(lineCoordinate);
    var length = turf.length(line, {
        units: 'kilometers'
    });

    var polyline = L.polyline(lineCoordinate, {
        color: 'red'
    });
    polyline.addTo(layer).bindPopup('Longueur trajet' + Math.round((length * 1000) / 1000) + ' Km - ' + nb + ' points ');

    layer.addTo(map);

    controlLayers.addOverlay(layer, name);

    /*Legend specific*/
    var legend = L.control({
        position: "bottomright"
    });

    legend.onAdd = function (map) {
        var div = L.DomUtil.create("div", "legend");
        div.innerHTML += "<h4>Vitesse</h4>";
        div.innerHTML += '<i style="background: #BD0026"></i><span>> 50 km/h</span><br>';
        div.innerHTML += '<i style="background: #FD8D3C"></i><span>> 30 km/h</span><br>';
        div.innerHTML += '<i style="background: #FED976"></i><span>> 20 km/h</span><br>';
        div.innerHTML += '<i style="background: #c2e699"></i><span>> 10 km/h</span><br>';
        div.innerHTML += '<i style="background: #006837"></i><span>> 0 km/h</span><br>';
        return div;
    };

    legend.addTo(map);
}

function geofencing(geoJsonData) {

    var lineCoordinate = [];



    for (var i in geoJsonData.features) {
        var pointJson = geoJsonData.features[i];
        var coord = pointJson.geometry.coordinates;
        var pt = turf.point(coord);
        var poly = turf.polygon([
            [
                [2.343381733763336, 43.235671930224925], [2.367224767571165, 43.235418958944948], [2.367224767571165, 43.235418958944948], [2.367224767571165, 43.235418958944948], [2.377410141236645, 43.22892567004024], [2.394540087855862, 43.212900309217119], [2.398475345862979, 43.190035795706223], [2.357270879670809, 43.181005750067406], [2.31201541258896, 43.184128440302793], [2.291297436610312, 43.206235893100327], [2.293033579848747, 43.219563997144142], [2.313867298709956, 43.231961579536495], [2.343381733763336, 43.235671930224925]
            ]
        ]);

        var inPolygon = turf.booleanPointInPolygon(pt, poly);
        console.log(inPolygon);

        if (inPolygon == false) {
            lineCoordinate.push([coord[1], coord[0]]);
        }
    }


    //L.marker([lineCoordinate[0][0], lineCoordinate[0][1]]).addTo(map);
    for (var i in lineCoordinate) {
        var marker = new L.marker([lineCoordinate[i][0], lineCoordinate[i][1]], {
            icon: new L.NumberedDivIcon({
                iconSize: [1, 1],
                iconAnchor: [10, 10],
                iconUrl: '/img/trajets.png'
            })
        });
        marker.addTo(map)
    }
}

function addControlScale() {
    controlScale = L.control.scale().addTo(map);
}


function addList1(geoJsonData) {
    var from = turf.point([_LONGITUDE_DEPOT, _LATITUDE_DEPOT]);
    var options = {
        units: 'kilometers'
    };

    for (var i = 0; i < geoJsonData.features.length; i++) {
        var lat = geoJsonData.features[i].geometry.coordinates[1];
        var lng = geoJsonData.features[i].geometry.coordinates[0];
        var to = turf.point([lng, lat]);
        var distance = (turf.distance(from, to, options)).toFixed(2);

        $("ul#list1").prepend("<li class='geoJsonData' data-lat='" + lat + "' data-lng='" + lng + "'> id: " + geoJsonData.features[i].id + " - Nom: " + geoJsonData.features[i].properties.nom_client + " - Adresse: " + geoJsonData.features[i].properties.adresse_client + " - Distance: " + distance + " Km " + "</li>");
    }
}

function addList2(geoJsonData) {
    var from = turf.point([_LONGITUDE_DEPOT, _LATITUDE_DEPOT]);
    var options = {
        units: 'kilometers'
    };

    for (var i = 0; i < geoJsonData.features.length; i++) {
        var lat = geoJsonData.features[i].geometry.coordinates[1];
        var lng = geoJsonData.features[i].geometry.coordinates[0];
        var to = turf.point([lng, lat]);
        var distance = (turf.distance(from, to, options)).toFixed(2);

        $("ul#list2").prepend("<li class='geoJsonData' data-lat='" + lat + "' data-lng='" + lng + "'> id: " + geoJsonData.features[i].id + " - Nom: " + geoJsonData.features[i].properties.nom_ville + " - Code Postal : " + geoJsonData.features[i].properties.cp_ville + " - Distance: " + distance + " Km " + "</li>");
    }
}

function addList3(geoJsonData) {
    var from = turf.point([_LONGITUDE_DEPOT, _LATITUDE_DEPOT]);
    var options = {
        units: 'kilometers'
    };

    for (var i = 0; i < geoJsonData.features.length; i++) {
        var lat = geoJsonData.features[i].geometry.coordinates[1];
        var lng = geoJsonData.features[i].geometry.coordinates[0];
        var to = turf.point([lng, lat]);
        var distance = (turf.distance(from, to, options)).toFixed(2);

        $("ul#list3").prepend("<li class='geoJsonData' data-lat='" + lat + "' data-lng='" + lng + "'> id: " + geoJsonData.features[i].id + " - Depart: " + geoJsonData.features[i].properties.point_depart_troncon + " - Arrivée : " + geoJsonData.features[i].properties.point_arrivee_troncon + " - Distance: " + distance + " Km " + "</li>");
    }
}
