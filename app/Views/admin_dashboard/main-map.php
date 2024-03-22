<?= $this->include('/dashboard/top') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="<?= base_url() ?>dashboard/js/naujandata.js"></script>
    <script src="https://unpkg.com/@maptiler/geocoding-control@latest/leaflet.umd.js"></script>
    <link href="https://unpkg.com/@maptiler/geocoding-control@latest/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0px;
            right: 0;
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIS</title>
</head>

<body>
    <?= $this->include('/admin_dashboard/navbar') ?>
    <?= $this->include('/admin_dashboard/topbar') ?>
    <?= $this->include('/admin_dashboard/top') ?>


    <div id="map"></div>
    <script>
        var map = L.map('map').setView([13.27934, 121.300003], 13);


        L.tileLayer('https://api.maptiler.com/maps/streets-v2/256/{z}/{x}/{y}.png?key=UDQzhd8KRiaw4SHIFez9', {
            attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
        }).addTo(map);
        // var naujanData = L.geoJSON(naujandata).addTo(map);

        //marker
        var markersData = [{
                lat: 13.3082,
                lng: 121.3267,
                barangay_name: 'Kalinisan'
            },

            {
                lat: 13.2889,
                lng: 121.2941,
                barangay_name: 'Mabini'
            },
            {
                lat: 13.316667,
                lng: 121.300003,
                barangay_name: 'Santiago'
            },
            {
                lat: 13.2092,
                lng: 121.2725,
                barangay_name: 'Adrialuna'
            },
            {
                lat: 13.2868,
                lng: 121.3309,
                barangay_name: 'Antipolo'
            },
            {
                lat: 13.2393,
                lng: 121.2031,
                barangay_name: 'Apitong'
            },
            {
                lat: 13.2299,
                lng: 121.1098,
                barangay_name: 'Arangin'
            },
            {
                lat: 13.2678,
                lng: 121.1338,
                barangay_name: 'Aurora'
            },
            {
                lat: 13.3220,
                lng: 121.2611,
                barangay_name: 'Bacungan'
            },
            {
                lat: 13.2065,
                lng: 121.2169,
                barangay_name: 'Bagong Buhay'
            },
            {
                lat: 13.2791,
                lng: 121.3193,
                barangay_name: 'Bancuro'
            },
            {
                lat: 13.2744,
                lng: 121.2387,
                barangay_name: 'Barcenaga'
            },
            {
                lat: 13.2427,
                lng: 121.3498,
                barangay_name: 'Bayani'
            },
            {
                lat: 13.3007,
                lng: 121.2622,
                barangay_name: 'Buhangin'
            },
            {
                lat: 13.2739,
                lng: 121.3312,
                barangay_name: 'Concepcion'
            },
            {
                lat: 13.2567,
                lng: 121.3147,
                barangay_name: 'Dao'
            },
            {
                lat: 13.2797,
                lng: 121.1539,
                barangay_name: 'Del Pilar'
            },
            {
                lat: 13.3301,
                lng: 121.3098,
                barangay_name: 'Estrella'
            },
            {
                lat: 13.2857,
                lng: 121.1069,
                barangay_name: 'Evangelista'
            },
            {
                lat: 13.3102,
                lng: 121.2457,
                barangay_name: 'Gamao'
            },
            {
                lat: 13.2638,
                lng: 121.1686,
                barangay_name: 'General Esco'
            },
            {
                lat: 13.2287,
                lng: 121.4151,
                barangay_name: 'Herrera'
            },
            {
                lat: 13.2111,
                lng: 121.1629,
                barangay_name: 'Inarawan'
            },
            {
                lat: 13.2435,
                lng: 121.3292,
                barangay_name: 'Laguna'
            },
            {
                lat: 13.2903,
                lng: 121.3005,
                barangay_name: 'Mabini'
            },
            {
                lat: 13.3220,
                lng: 121.2977,
                barangay_name: 'Andres Ilagan'
            },
            {
                lat: 13.2113,
                lng: 121.1502,
                barangay_name: 'Mahabang Parang'
            },
            {
                lat: 13.2206,
                lng: 121.2816,
                barangay_name: 'Malaya'
            },
            {
                lat: 13.2390,
                lng: 121.2697,
                barangay_name: 'Malinao'
            },
            {
                lat: 13.1908,
                lng: 121.1326,
                barangay_name: 'Malvar'
            },
            {
                lat: 13.2554,
                lng: 121.1062,
                barangay_name: 'Masagana'
            },
            {
                lat: 13.2287,
                lng: 121.3997,
                barangay_name: 'Masaguing'
            },
            {
                lat: 13.2784,
                lng: 121.3581,
                barangay_name: 'Melgar A'
            },
            {
                lat: 13.2607,
                lng: 121.3592,
                barangay_name: 'Melgar B'
            },
            {
                lat: 13.2715,
                lng: 121.0891,
                barangay_name: 'Metolza'
            },
            {
                lat: 13.2145,
                lng: 121.3893,
                barangay_name: 'Montelago'
            },
            {
                lat: 13.2348,
                lng: 121.3866,
                barangay_name: 'Montemayor'
            },
            {
                lat: 13.2816,
                lng: 121.2774,
                barangay_name: 'Motoderazo'
            },
            {
                lat: 13.2463,
                lng: 121.1298,
                barangay_name: 'Mulawin'
            },
            {
                lat: 13.3237,
                lng: 121.2771,
                barangay_name: 'Nag-Iba I'
            },
            {
                lat: 13.3237,
                lng: 121.2771,
                barangay_name: 'Nag-Iba II'
            },
            {
                lat: 13.2240,
                lng: 121.2582,
                barangay_name: 'Pagkakaisa'
            },
            {
                lat: 13.2897,
                lng: 121.1480,
                barangay_name: 'Paniquian'
            },
            {
                lat: 13.2695,
                lng: 121.2614,
                barangay_name: 'Pinagsabangan I'
            },
            {
                lat: 13.2695,
                lng: 121.2614,
                barangay_name: 'Pinagsabangan II'
            },
            {
                lat: 13.2896,
                lng: 121.2408,
                barangay_name: 'Pinahan'
            },
            {
                lat: 13.3251,
                lng: 121.3024,
                barangay_name: 'Poblacion I (Barangay I)'
            },
            {
                lat: 13.3234,
                lng: 121.3047,
                barangay_name: 'Poblacion II (Barangay II)'
            },
            {
                lat: 13.3205,
                lng: 121.3042,
                barangay_name: 'Poblacion III (Barangay III)'
            },
            {
                lat: 13.2881,
                lng: 121.2127,
                barangay_name: 'Sampaguita'
            },
            {
                lat: 13.2759,
                lng: 121.3049,
                barangay_name: 'San Agustin I'
            },
            {
                lat: 13.2624,
                lng: 121.2931,
                barangay_name: 'San Agustin II'
            },
            {
                lat: 13.1408,
                lng: 121.1543,
                barangay_name: 'San Andres'
            },
            {
                lat: 13.3392,
                lng: 121.2974,
                barangay_name: 'San Antonio'
            },
            {
                lat: 13.2368,
                lng: 121.2458,
                barangay_name: 'San Carlos'
            },
            {
                lat: 13.2613,
                lng: 121.3122,
                barangay_name: 'San Isidro'
            },
            {
                lat: 13.2937,
                lng: 121.3431,
                barangay_name: 'San Jose'
            },
            {
                lat: 13.2395,
                lng: 121.1528,
                barangay_name: 'San Luis'
            },
            {
                lat: 13.2498,
                lng: 121.1754,
                barangay_name: 'San Nicolas'
            },
            {
                lat: 13.2257,
                lng: 121.2962,
                barangay_name: 'San Pedro'
            },
            {
                lat: 13.2433,
                lng: 121.3031,
                barangay_name: 'Santa Isabel'
            },
            {
                lat: 13.2498,
                lng: 121.2274,
                barangay_name: 'Santa Maria'
            },
            {
                lat: 13.3043,
                lng: 121.2895,
                barangay_name: 'Santiago'
            },
            {
                lat: 13.2595,
                lng: 121.1997,
                barangay_name: 'Santo Nino'
            },
            {
                lat: 13.1826,
                lng: 121.1697,
                barangay_name: 'Tagumpay'
            },
            {
                lat: 13.2826,
                lng: 121.1831,
                barangay_name: 'Tigkan'
            },
            {
                lat: 13.2607,
                lng: 121.3592,
                barangay_name: 'Melgar B'
            },
            {
                lat: 13.3161,
                lng: 121.3158,
                barangay_name: 'Santa Cruz'
            },
            {
                lat: 13.2387,
                lng: 121.1023,
                barangay_name: 'Balite'
            },
            {
                lat: 13.1740,
                lng: 121.1232,
                barangay_name: 'Banuton'
            },
            {
                lat: 13.1443,
                lng: 121.1392,
                barangay_name: 'Caburo'
            },
            {
                lat: 13.2549,
                lng: 121.0822,
                barangay_name: 'Magtibay'
            },
            {
                lat: 13.2677,
                lng: 121.0831,
                barangay_name: 'Paitan'
            }

        ];

        markersData.forEach(function(data) {
            var marker = L.circleMarker([data.lat, data.lng], {
                radius: 10,
                fillColor: '#D2B48C',
                fillOpacity: 0
            }).addTo(map);

            var varietyData = <?= json_encode($varietyData) ?>;
            var popupContent = 'Barangay: ' + data.barangay_name + '<br>';

            varietyData[data.barangay_name].forEach(function(variety) {
                popupContent += 'Variety: ' + variety.variety_name + '<br>';
                popupContent += 'Equipment: ' + variety.equipment + '<br>';
            });

            //popup
            marker.on('mouseover', function(e) {
                marker.bindPopup(popupContent).openPopup();
                marker.setStyle({
                    fillOpacity: 1
                });
            });


            marker.on('mouseout', function(e) {
                map.closePopup();
                marker.setStyle({
                    fillOpacity: 0
                });
            });
        });
        googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });
        googleStreets.addTo(map);

        googleTerrain = L.tileLayer('http://{s}.google.com/vt?lyrs=p&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });
        googleTerrain.addTo(map);

        const key = 'UDQzhd8KRiaw4SHIFez9';
        L.control.maptilerGeocoding({
            apiKey: key,
            placeholder: "Search",
            collapsed: true,
            // country: "Phillipines",
            language: "en"
        }).addTo(map);
    </script>


</body>

</html>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>