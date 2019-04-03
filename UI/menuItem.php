<?php

require_once  'header.php';
//DATABASE CONNECTION
?>
<link rel="stylesheet" href="styles/menuItem.css">
<br>
<div class="wrapper">
    <h1 class="title text-center">Our Menu</h1>
    <br>
    <div class="row">
        <div class="col-md-2 d-none d-lg-block">
            <div class="row">
                <div class="col" id="pic4"></div>
            </div>
            <div class="row">
                <div class="col" id="pic5"></div>
            </div>
            <div class="row">
                <div class="col" id="pic6"></div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8" id="menu-container">
            <div class="menu">
            </div>
        </div>
        <div class="col-md-2 d-none d-lg-block">
            <div class="row">
                <div class="col" id="pic1"></div>
            </div>
            <div class="row">
                <div class="col" id="pic2"></div>
            </div>
            <div class="row">
                <div class="col" id="pic3"></div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'footer.php';
?>
