<?php
use Connection\Connection;
use Connection\ConnectionDataFactory;
use Connection\ConnectionData;
require_once __DIR__ ."/session.php";
require_once __DIR__ . "/loggedInCheck.php";
require_once __DIR__ ."/init.php";
require_once __DIR__ ."/functions.php";
require_once __DIR__."/../../Data/db/Connection.php";
require_once __DIR__."/../../Data/db/ConnectionData.php";
require_once __DIR__."/../../Data/common/ConnectionDataFactory.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jae Tsunami's</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/main.css" />
    <link rel="stylesheet" type="text/css" href="styles/navbar.css" />
    <script src="js/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <a href="index.php"><div class="navbar-logo navbar-brand">Logo Here</div></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" id="homeLink" href="index.php">Home</a>-->
<!--            </li>-->
            <?php require_once __DIR__ ."/admin_menu.php";?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <p id="login-name" class="my-2 my-sm-0"></p>
        </form>
    </div>
</nav>
<div class="container">
