<?php

require_once  'header.php';
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

        }
    ui{
        background-color: black;
        }
    nav a:visited { color: #FFFFFF; }
    img{
        padding-bottom: 5px;
    }
    
    .menu{
        outline:  5px solid black;;
    }
</style>

<body class="bg">
<div class="container">
    <div class="row">
        <div class="col-sm">
            <img src="images/slider_4.jpg" alt="Slider" style="width:350px; height:200px">
            <img src="images/image.jpg" alt="Burger" style="width:350px; height:200px">
            <img src="images/vegan-matcha-mousse-cake-2.jpg" alt="Vegan matcha mousse cake" style="width:350px; height:200px">

        </div>
        <div class="col-sm">
            <div class="menu">
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
        </div>
        <div class="col-sm">
            <img src="images/images.jpg" alt="Plate" style="width:350px; height:200px">
            <img src="images/image2.jpg" alt="Dessert" style="width:350px; height:200px">
            <img src="images/hero_2704_Garlic_Herb_Steak_with_Summer_Ratatouille___HERO.jpg" alt="Garlic dish" style="width:350px; height:200px">
        </div>
    </div>
</div>
<?php
include_once 'footer.php';
?>
