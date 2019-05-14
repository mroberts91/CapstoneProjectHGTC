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

$loginFailure = false;
$loginSuccess = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $errormsg = "";
    try {
        $email = trim(strtolower($_POST['email']));
        $passwd = trim($_POST['password']);
        $db = new Connection();
        $EM = new EmployeeManager($db);

        if ($empLogin = $EM->checkEmployeeLogin($email, $passwd)){
            $loginSuccess = true;
            $fullEmp = $EM->getFullEmployeeById($empLogin->getIdEmployee());
            $_SESSION['user_id'] = $fullEmp->getIdEmployee();
            $_SESSION['user_name'] = $fullEmp->getFirstname() . ' ' . $fullEmp->getLastname();
            $_SESSION['user_perm_level'] = $fullEmp->getIdDepartment();
            $_SESSION['user_department'] = $fullEmp->getDepartmentName();
            $_SESSION['full_emp'] = $fullEmp;
        } else{
            $errormsg .= "<p>Your username or password was incorrect.<br>Please try again.</p>";
            $loginFailure = true;
        }
    }
        catch (Exception $e) {
        $loginFailure = true;
        $errormsg .= "<p>".$e->getMessage()."</p>";
    }
    if ($loginSuccess){
        require_once __DIR__ . "/includes/footer.php";
        echo "<script>window.location = 'index.php'</script>";
    }

}
?>
<style>
    @media screen and (min-width: 1200px) {
        #background{
            content: "";
            background: url("../UI/images/home.jpg");
            opacity: 0.4;
            height: 100%;
            width: 100%;
            position: absolute;
            z-index: -1;
        }
        .flex-center{
            display: flex;
            justify-content: center;
        }
        #login-container{
            opacity: .9;
            -webkit-border-radius: 7px;
            -moz-border-radius: 7px;
            border-radius: 7px;
            margin-top: 5%;
            background-color: white;
            width: 36%;
        }
        #login-logo{
            background: url("../UI/images/red-blue.png") no-repeat center;
            background-size: 25%;
            height: 10em;
            margin-top: .8em;
        }
        .login-form{
            width: 60%;
            padding: 1em;
        }
    }
    @media screen and (max-width: 1199px){
        #background{
            content: "";
            background: url("../UI/images/home.jpg");
            opacity: 0.4;
            height: 100vh;
            width: 100%;
            position: absolute;
            z-index: -1;
        }
        .flex-center{
            display: flex;
            justify-content: center;
        }
        #login-container{
            opacity: .9;
            -webkit-border-radius: 7px;
            -moz-border-radius: 7px;
            border-radius: 7px;
            margin-top: 10%;
            background-color: white;
            width: 75%;
        }
        #login-logo{
            background: url("../UI/images/red-blue.png") no-repeat center;
            background-size: 30%;
            height: 15em;
            margin-top: 1em;
        }
        .login-form{
            width: 75%;
            padding: 1em;
        }
        footer{
            font-weight: 600;
        }
    }

</style>
<div id="background"></div>
<div class="flex-center">
<div id="login-container">
    <div id="login-logo"></div>
    <div class="flex-center">
        <div class="login-form">
            <div class="form-group">
                <form name="loginForm" id="loginForm" method="post" action="login.php">
                    <label for="email">Email:</label>
                    <input class="form-control" type="text" name="email" id="email" required
                        value="<?php if (isset($_POST['email'])){ echo $_POST['email']; } ?>">

                    <label for="password">Password:</label>
                    <input class="form-control" type="password" name="password" id="password" required>
                    <br>
                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
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
?>