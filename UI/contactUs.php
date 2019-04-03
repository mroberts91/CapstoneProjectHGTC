<?php
require_once  'header.php';
//DATABASE CONNECTION
?>
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<script src='https://api.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.css' rel='stylesheet' />
<div class="bg"></div>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm">
            <h2>CONTACT US!</h2>
            <p>Phone: (843)283-2617</p>
            <p>JaeTsunamis@icimb.com</p>
            <br>
            <br>
            <h2>ADDRESS</h2>
            <p>920 Crabtree Lane</p>
            <p>Myrtle Beach, SC 29577</p>
        </div>
        <div class="col-sm">
            <h2>LOCATION</h2>
            <div id="map"></div>
        </div>
    </div>
</div>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoibXJvYmVyMjMiLCJhIjoiY2p1MGxqeXdtM2dqYjRlbnMwZXFlNHgyNiJ9.sTkvAD919C4XgfgUgyaJoQ';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v10',
        center: [-78.942262, 33.661694],
        zoom: 12
    });



    var marker = new mapboxgl.Marker()
        .setLngLat([-78.942262, 33.661694])
        .setPopup(new mapboxgl.Popup({offset: 25}).setText('International Culinary Institure of Myrtle Beach - 920 Crabtree Lane, Myrtle Beach, SC 29575'))
        .addTo(map)

</script>
<?php
include_once 'footer.php';
?>
