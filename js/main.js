function getWidth() {
    return Math.max(
      document.body.scrollWidth,
      document.documentElement.scrollWidth,
      document.body.offsetWidth,
      document.documentElement.offsetWidth,
      document.documentElement.clientWidth
    );
  }

function cut()
{
    var short = document.getElementById("short").innerHTML;
    var short2 = document.getElementById("short2").innerHTML;
    var short3 = document.getElementById("short3").innerHTML;

    var xLength = window.innerWidth;

    console.log(xLength);

    if (short.length >= 103 && xLength <= 854) {
        document.getElementById("short").innerHTML = short.slice(0, 103);
    }
    
    if (short2.length >= 126 && xLength <= 854) {
        document.getElementById("short2").innerHTML = short2.slice(0, 126);
    }

    if (short3.length >= 20 && xLength <= 854) {
        document.getElementById("short3").innerHTML = short3.slice(0, 88);
    }

    console.log(short);
}


window.onload = cut;

//Global variables
var map = null; //Leaflet map object
var controlLayers = null; //Leaflet control Layer
var controlScale = null; //Leaflet control Layer

var baseMaps = null; //baseMaps object = list of baseMaps Layer type
var overlayMaps = null; //overlayMaps object = list of overlayMaps Layer type
var featuresPointCollection = null;

var stylePoint1 = {
    radius: 8,
    fillColor: "red",
    color: "none",
    weight: 1,
    opacity: 1,
    fillOpacity: 0.6
};

$(document).ready(function () {
    //Click on button
    $("button#loadPoints").click(function () {
        //2eme methode
        $.getJSON("getData.php", function (response) {
            addGeoJsonLayer(response, "Source", stylePoint1);
            addList(response);
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
    var popupContent = "<p>Propriétées</p>";
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


function addControlScale() {
    controlScale = L.control.scale().addTo(map);
}

function addList(geoJsonData) {
    var from = turf.point([_LONGITUDE_IUT, _LATITUDE_IUT]);
    var options = {
        units: 'kilometers'
    };

    for (var i = 0; i < geoJsonData.features.length; i++) {
        var lat = geoJsonData.features[i].geometry.coordinates[1];
        var lng = geoJsonData.features[i].geometry.coordinates[0];
        var to = turf.point([lng, lat]);
        var distance = (turf.distance(from, to, options)).toFixed(2);

        $("ul#list").prepend("<li class='geoJsonData' data-lat='" + lat + "' data-lng='" + lng + "'> id: " + geoJsonData.features[i].id + " - Nature: " + geoJsonData.features[i].properties.nature + " - Adresse: " + geoJsonData.features[i].properties.adresse + " - Distance: " + distance + " Km " + "</li>");
    }
}

function addMousePosition() {
    mousePosition = L.control.mousePosition().addTo(map);
}