<?php
use Connection\Connection;
use Orders\OrderManager;

require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/managers/OrderManager.php";
require_once __DIR__."/../Data/dto/Order.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    try {
        $userID = $_SESSION['user_id'];
        $userName = $_SESSION['user_name'];
        $db = new Connection();
        $orderMan = new OrderManager($db);
        $newOrderId = $orderMan->createNewOrder((int)$userID);
        echo "<script>window.location = 'edit_order.php?id=".$newOrderId."'</script>";
    } catch (Exception $e) {
        die($e);
    }
}

?>
<style>
    #big-red-button{
        display: flex;
        justify-content: center;
    }
</style>
<br>
<h1 class="text-center">Create New Order</h1>
<br>
<div class="row">
    <div class="col-md-1 col-xl-4"></div>
    <div class="col-md-10 col-xl-4" id="big-red-button">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <button class="btn btn-success">
                Create A New Order
            </button>
        </form>
    </div>
    <div class="col-md-1 col-xl-4"></div>
</div>
<?php
require_once __DIR__."/includes/footer.php";
?>

