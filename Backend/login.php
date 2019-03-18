<?php
require_once __DIR__ . "/includes/header.php";
// This will eventually need to be replaced with actual login functionality.
$_SESSION['user_id'] = "admin";
?>
<h1 class="text-center">Login</h1>
<?php
require_once __DIR__ . "/includes/footer.php";