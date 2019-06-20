/* OSM & OL example code provided by https://mediarealm.com.au/ */
var map;
//var mapLat = 46.2530;
//var mapLon = 20.1414;
var mapDefaultZoom = 15;
function initGeolocation()
{
    if( navigator.geolocation )
    {
        // Call getCurrentPosition with success and failure callbacks
        navigator.geolocation.getCurrentPosition( success );
    }
}
function success(position)
{
    mapLon = position.coords.longitude;
    mapLat = position.coords.latitude
}
function initialize_map(mapLat, mapLon) {
    initGeolocation();
    map = new ol.Map({
        target: "map",
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM({
                    //url: "https://a.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    //url: "https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}.png"
                    url: "http://a.tile2.opencyclemap.org/transport/{z}/{x}/{y}.png"
                    //url: "https://tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png"
                })
            })
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat([mapLon, mapLat]),
            zoom: mapDefaultZoom
        })
    });
}

function add_map_point(lat, lon, stop_name) {
    var vectorLayer = new ol.layer.Vector({
        source:new ol.source.Vector({
            features: [
                new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.transform([parseFloat(lon), parseFloat(lat)], 'EPSG:4326', 'EPSG:3857')),
                })
                ]
        }),
        style: new ol.style.Style({
            image: new ol.style.Icon({
                anchor: [0.5, 0.5],
                anchorXUnits: "fraction",
                anchorYUnits: "fraction",
                src: "https://upload.wikimedia.org/wikipedia/commons/e/ec/RedDot.svg"
            })
        })
    });

    map.addLayer(vectorLayer);
}