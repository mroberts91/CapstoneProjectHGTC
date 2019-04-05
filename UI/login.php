<?php
require_once __DIR__."/header.php";
$_SESSION['customer_id'] = 1;
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
