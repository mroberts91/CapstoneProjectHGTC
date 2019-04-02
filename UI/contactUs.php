<?php

require_once  'header.php';
//DATABASE CONNECTION
?>

<style>
    body, html {
        height: 100%;
    }

    .bg {
        /* The image used */
        background-color: firebrick;

        /* Full height */
        height: 100%;

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    nav{
        margin-top: 10px;
        word-spacing: 250px;
        font-size: 50px;
        background-color: black;

    }
    ui{
        background-color: black;
    }
    nav a:link { color: #FFFFFF; }
    nav a:visited { color: #FFFFFF; }

</style>

<body class="bg">
<div class="container">
    <div class="row">
        <div class="col-sm">
            <h1>CONTACT US!</h1>
            <h3>Phone:(843)283-2617</h3>
            <h3>JaeTsunamis@icimb.com</h3>
            <br>
            <br>
            <h1>ADDRESS</h1>
            <h3>920 Crabtree Lane</h3>
            <h3>Myrtle Beach, SC 29577</h3>
        </div>
        <div class="col-sm">
            <h1>LOCATION</h1>
            <img src="images/map_Map_02_Dexter_location-lg.jpg" alt="Map" style="width:500px; height:450px">
        </div>
    </div>
</div>




<?php
include_once 'footer.php';
?>
