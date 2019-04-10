<?php

use Connection\Connection;
use Customer\CustomerManager;

require_once __DIR__."/header.php";

require_once __DIR__ . "/../Data/managers/CustomerManager.php";
require_once __DIR__ . "/../Data/dto/CustomerLogin.php";
require_once __DIR__ . "/../Data/dto/Customer.php";
require_once __DIR__ . "/../Data/db/Connection.php";
// This will eventually need to be replaced with actual login functionality.

$loginFailure = false;
$loginSuccess = false;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $errormsg = "";
    try {
        $email = trim(strtolower($_POST['email']));
        $passwd = trim($_POST['password']);
        echo $email;
        echo '<br>' . $passwd;
        $db = new Connection();
        $cm = new CustomerManager($db);

        if ($cmLogin = $cm->checkCustomerLogin($email, $passwd)) {
            $loginSuccess = true;
            $fullcm = $cm->getCustomerById($cmLogin->getIdCustomer());
            $_SESSION['user_id_cust'] = $fullcm->getIdCustomer();
            $_SESSION['user_name_cust'] = $fullcm->getFirstname() . ' ' . $fullcm->getLastname();
            $_SESSION['full_user_cust'] = $fullcm;
            if ($cmLogin->isTempPassword()){
                echo "<script> window.location='index.php' </script>";
            }
        } else {
            $errormsg .= "<p>Your username or password was incorrect.<br>Please try again.</p>";
            $loginFailure = true;
            echo $errormsg;
        }
    } catch (Exception $e) {
        $loginFailure = true;
        $errormsg .= "<p>" . $e->getMessage() . "</p>";
    }
}
?>
<link rel="stylesheet" type="text/css" href="styles/login.css">
<br>
<div class="container">
    <h1 class="text-center">Login</h1>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                <form name="loginForm" id="loginForm" method="post" action="login.php">
                    <label for="email">Email:</label>
                    <input class="form-control" type="text" name="email" id="email" required>
                    <label for="password">Password:</label>
                    <input class="form-control" type="password" name="password" id="password" required>
                    <br>
                    <button class="btn btn-danger" type="submit" name="submit">Login</button>
                    <a href="create_customer.php"><button class="btn btn-danger" type="button">Create Account</button></a>
                </form>

            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<?php
require_once __DIR__."/footer.php";
?>
