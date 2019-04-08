<?php
require_once __DIR__."/header.php";
$cart = (array)$_SESSION['customer_cart'];
$newID = 12;
array_push($cart, $newID);
?>
<div class="container">
    <?php echo '<br>';
echo $_SESSION['customer_id'];
echo '<br>';
echo $_SESSION['customer_name'];
echo '<br>';
echo $_SESSION['customer_email'];
echo '<br>';
?>
</div>

<?php
require_once __DIR__."/footer.php";
?>