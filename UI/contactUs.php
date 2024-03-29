<?php
require_once  'header.php';
//DATABASE CONNECTION
?>
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<script src='https://api.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.css' rel='stylesheet' />
<div class="bg"></div>
<br>
<h1 class="title text-center">Contact Us Today</h1>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <h2>Contact Information</h2>
            <p><i class="fa fa-phone" aria-hidden="true"> </i> (843)283-2617</p>
            <p><i class="fa fa-envelope" aria-hidden="true"> </i> JaeTsunamis@ICIMB.com</p>
            <br>
            <br>
            <h2><i class="fa fa-map-marker" aria-hidden="true"> </i> Address</h2>
            <p>920 Crabtree Lane</p>
            <p>Myrtle Beach, SC 29577</p>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-5">
            <h2>Location</h2>
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
