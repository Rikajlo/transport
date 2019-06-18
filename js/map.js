/* OSM & OL example code provided by https://mediarealm.com.au/ */
var map;
var mapLat = 46.2530;
var mapLng = 20.1414;
var mapDefaultZoom = 14;

function initialize_map() {
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
            center: ol.proj.fromLonLat([mapLng, mapLat]),
            zoom: mapDefaultZoom
        })
    });
}

function add_map_point(lat, lng) {
    var vectorLayer = new ol.layer.Vector({
        source:new ol.source.Vector({
            features: [new ol.Feature({
                geometry: new ol.geom.Point(ol.proj.transform([parseFloat(lng), parseFloat(lat)], 'EPSG:4326', 'EPSG:3857')),
            })]
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