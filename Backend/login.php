<?php
use Connection\Connection;
use Employee\EmployeeManager;

require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../Data/managers/EmployeeManager.php";
require_once __DIR__ . "/../Data/db/Connection.php";
// This will eventually need to be replaced with actual login functionality.
$_SESSION['user_id'] = "admin";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    try {
        $db = new Connection();
        $EM = new EmployeeManager($db);
        $Login = $EM->checkEmployeeLogin($_POST["email"], $_POST["password"]);

    }
        catch (Exception $e) {
    }

    if($Login == false)
    {
        echo '<p>The email or password is incorrect</p>';
    }
    else
    {
            $_SESSION['user_id']= $Login->getIdEmployee();

            echo "<br>";
            echo "Logged In Successfully";
            echo "<br><br>";
            echo '<a href = "index.php">Continue</a>';
            echo "<br>";

    }

}
?>
    <h1 class="text-center">Login</h1>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                <form name="loginForm" id="loginForm" method="post" action="login.php">

                    Email:
                    <input class="form-control" type="text" name="email" id="email" required>

                    Password:
                    <input class="form-control" type="password" name="password" id="password" required>


                    <input class="form-control" type="submit" name="submit" value="submit">

                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
<?php
require_once __DIR__ . "/includes/footer.php";
?>