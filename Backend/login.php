<?php
use Connection\Connection;
use Employee\EmployeeManager;
use Employee\Employee;

require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/../Data/managers/EmployeeManager.php";
require_once __DIR__ . "/../Data/dto/EmployeeLogin.php";
require_once __DIR__ . "/../Data/dto/Employee.php";
require_once __DIR__ . "/../Data/db/Connection.php";
// This will eventually need to be replaced with actual login functionality.
$_SESSION['user_id'] = "admin";
$loginFailure = false;
$loginSuccess = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $errormsg = "";
    try {
        $email = trim(strtolower($_POST['email']));
        $passwd = trim($_POST['password']);
        echo $email;
        echo '<br>'. $passwd;
        $db = new Connection();
        $EM = new EmployeeManager($db);

        if ($empLogin = $EM->checkEmployeeLogin($email, $passwd)){
            $loginSuccess = true;
            $fullEmp = $EM->getFullEmployeeById($empLogin->getIdEmployee());
            $_SESSION['user_id'] = $fullEmp->getIdEmployee();
            $_SESSION['user_name'] = $fullEmp->getFirstname() . ' ' . $fullEmp->getLastname();
            $_SESSION['user_perm_level'] = $fullEmp->getIdDepartment();
            $_SESSION['user_department'] = $fullEmp->getDepartmentName();
            $_SESSION['full_user'] = $fullEmp;
        } else{
            $errormsg .= "<p>Your username or password was incorrect.<br>Please try again.</p>";
            $loginFailure = true;
        }
    }
        catch (Exception $e) {
        $loginFailure = true;
        $errormsg .= "<p>".$e->getMessage()."</p>";
    }

//    $_SESSION['user_id']= $Login->getIdEmployee();

}
?>
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

                    <input class="form-control btn btn-primary" type="submit" name="submit" value="submit">
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

<!-- LOGIN SUCCESS MODAL -->
    <div class="modal fade" id="loginSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>You have successfully logged in!</p>
                </div>
                <div class="modal-footer">
                    <a href="index.php"><button type="button" class="btn btn-secondary">Close</button></a>
                </div>
            </div>
        </div>
    </div>
<!-- LOGIN ERROR MODAL` -->
    <div class="modal" id="loginError" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login Error</h5>
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
require_once __DIR__ . "/includes/footer.php";
if ($loginFailure){
    echo "<script src='js/login/loginError.js'></script>";
}
if ($loginSuccess){
    echo "<script src='js/login/loginSuccess.js'></script>";
}
?>