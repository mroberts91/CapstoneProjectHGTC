<?php
use Connection\Connection;
use Connection\ConnectionDataFactory;
use Connection\ConnectionData;
require_once __DIR__ ."/session.php";
require_once __DIR__ ."/functions.php";
require_once __DIR__."/../Data/db/Connection.php";
require_once __DIR__."/../Data/db/ConnectionData.php";
require_once __DIR__."/../Data/common/ConnectionDataFactory.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jae Tsunami's</title>
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,500i,700,800i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles/main.css">
    <link rel="stylesheet" type="text/css" href="styles/navbar.css">
    <script src="js/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-xl navbar-dark">
    <a href="index.php"><img id="logo" src="images/white.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" id="homeLink" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="aboutLink" href="about.php">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="menuLink" href="menuItem.php">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contactLink" href="contactUs.php">Contact</a>
            </li>
        </ul>
        <br>
        <div class="row">
            <form class="form-inline my-2 my-lg-0 col-lg-2 col-xl-3" id="login-button" action="login.php" method="get"
                <?php if (isset($_SESSION['customer_id'])){ echo "hidden"; } ?>>
                <button type="submit" class="btn btn-danger my-2 my-sm-0" id="login">
                    <i class="fa fa-sign-in" aria-hidden="true"> </i> Order Online</button>
            </form>
            <form class="form-inline my-2 my-lg-0 col-lg-2 col-xl-3" id="login-button"
                  action="create_online_order.php"
                  method="get"
                <?php if (!isset($_SESSION['customer_id'])){ echo "hidden"; } ?>>
                <button type="submit" class="btn btn-danger my-2 my-sm-0" id="login">
                    <i class="fa fa-cutlery" aria-hidden="true"> </i> Place an Order</button>
            </form>
            <form class="form-inline my-2 my-lg-0 col-lg-2 col-xl-3" id="logout-button" action="customer_profile.php" method="get"
                <?php if (!isset($_SESSION['customer_id'])){ echo "hidden"; } ?>>
                <input type="hidden" name="id" value="<?php if (isset($_SESSION['customer_id'])){ echo $_SESSION['customer_id']; } ?>" >
                <button type="submit" class="btn btn-danger my-2 my-sm-0" id="login">
                    <i class="fa fa-user" aria-hidden="true"> </i> View Profile</button>
            </form>
            <form class="form-inline my-2 my-lg-0 col-lg-2 col-xl-3" id="logout-button" action="logout.php" method="get"
            <?php if (!isset($_SESSION['customer_id'])){ echo "hidden"; } ?>>
            <button type="submit" class="btn btn-danger my-2 my-sm-0" id="login">
                <i class="fa fa-sign-out" aria-hidden="true"> </i> Logout</button>
            </form>
        </div>
    </div>
</nav>