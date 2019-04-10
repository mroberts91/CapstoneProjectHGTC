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
        $tableNum = (isset($_POST['tableNumber'])) ? (int)$_POST['tableNumber'] : null;
        $newOrderId = $orderMan->createNewOrder((int)$userID, $tableNum);
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
    <div class="col-sm-10 col-md-4 col-xl-4" id="big-red-button">
        <form class="form-group" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="tableNumber">Table Number:</label>
            <input class="form-control" type="number" id="tableNumber" name="tableNumber" >
            <br>
            <button class="btn btn-success" type="submit">
                Create A New Order
            </button>
        </form>
    </div>
    <div class="col-md-1 col-xl-4"></div>
</div>
<?php
require_once __DIR__."/includes/footer.php";
?>

