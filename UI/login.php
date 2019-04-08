<?php

use Connection\Connection;
use Customer\CustomerManager;

require_once __DIR__."/header.php";
require_once __DIR__."/../Data/managers/CustomerManager.php";
require_once __DIR__."/../Data/dto/CustomerLogin.php";
require_once __DIR__."/../Data/dto/Customer.php";
$errormsg = '';
$loginSuccess = false;
$loginError = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    try{
        $db = new Connection();
        $cm = new CustomerManager($db);
        if (!isset($_POST['email']) || !isset($_POST['password'])){
            $errormsg .= '<p>Email or Password is incorrect</p>';
            $loginError = true;
        }
        if (!$loginError){
            $email = trim(strtolower($_POST['email']));
            $passwd = trim($_POST['password']);
            if ($custLogin = $cm->checkCustomerLogin($email, $passwd)){
                $fullCustomer = $cm->getCustomerById($custLogin->getIdCustomer());
                $_SESSION['customer_id'] = $custLogin->getIdCustomer();
                $_SESSION['customer_name'] = $fullCustomer->getFirstname() . " " . $fullCustomer->getLastname();
                $_SESSION['customer_email'] = $custLogin->getEmail();
                $_SESSION['customer_cart'] = array();
                echo '<script>window.location = "create_online_order.php"</script>';
            } else{
                $errormsg .= '<p>Email or Password is incorrect</p>';
                $loginError = true;
            }
        }
    } catch (Exception $e){
        $errormsg .= '<p>'.$e->getMessage().'</p>';
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
    <div class="modal fade" id="profileSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>You information was successfully updated!</p>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?> "><button type="button" class="btn btn-secondary">Close</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="profileError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                </div>
                <div class="modal-body"><?php echo $errormsg ?>
                </div>
                <div class="modal-footer">
                    <a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
require_once __DIR__."/footer.php";
if ($postError){
    echo "<script src='js/customer/profileError.js'></script>";
}
if ($postSuccess){
    echo "<script src='js/customer/profileSuccess.js'></script>";
}

?>