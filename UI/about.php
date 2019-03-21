<?php

require_once  'header.php';
$pagetitle = "Welcome to Jae Tsunami's!"
//DATABASE CONNECTION
?>

<style>
    .bg{
        background-color: firebrick;
    }
    nav{
        margin-top: 10px;
        word-spacing: 250px;
        font-size: 50px;
        background-color: black;
        color
    }
    ui{
        background-color: black;
    }
    nav a:link { color: #FFFFFF; }
    .title{text-align: center}
    nav a:visited { color: #FFFFFF; }
    p{
        font-size: 20px;
    }
    .hours{text-align: center}
    .picturerow {
        display: flex;
    }

    .picturecolumn {
        flex: 20%;


    }
</style>

<body class="bg">
<h1 class="title"> Welcome to Jae Tsunami's!</h1>
<div class="container">
    <div class="row">

        <div class="col-sm">
            <p>We are a locally owned, multi-cultural restaurant in
            the heart of Murrells Inlet, South Carolina. We are known for our
            specialization in American, Asian, and Latin cuisines.</p>
            <p>Jae Tsunami's, owned by the Tsunami family, has had a strong
            legacy in the wonderful town of Murrells Inlet for decades.</p>
        </div>
        <div class="col-sm">
            <P>We believe in serving our customers to our fullest potential and putting
            their needs before our own. We strive to create a warm and welcoming atmosphere
            ready to give you the experience of a lifetime.</P>
        </div>
    </div>
    <div class="col-sm">

    </div>
    </div>
</div>
<h3 class="title">Hours</h3>
<h4 class="hours">Tuesday-Sunday 4PM-2AM</h4>


<div class="picturerow">
    <div class="picturecolumncolumn">
        <img src="images/outdoor-patio-masseria-noma_credit-masseria.jpg" alt="Patio" style="width:350px; height:200px">
    </div>
    <div class="picturecolumn">
        <img src="images/restaurant-party-and-event-ideas.jpg" alt="Party" style="width:350px; height:200px">
    </div>
    <div class="picturecolumn">
        <img src="images/Planning-Your-Restaurant-Floor-Plan-Step-by-Step-Instructions.png" alt="Plan your party" style="width:350px; height:200px">
    </div>
    <div class="picturecolumn">
        <img src="images/shutterstock_615600482.jpg" alt="Man eating" style="width:350px; height:200px">
    </div>
    <div class="picturecolumn">
        <img src="images/40630331a8354f848631f9f7ad769e32.jpg" alt="Staff" style="width:350px; height:200px">
</div>
</div>
</body>


<?php
include_once 'footer.php';
?>