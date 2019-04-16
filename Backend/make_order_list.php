<?php

use Connection\Connection;
use Orders\OrderManager;

require_once __DIR__."/includes/header.php";
require_once __DIR__."/../Data/managers/OrderManager.php";
require_once __DIR__."/../Data/dto/Order.php";
$errormsg = '';
$postSuccess = false;
$orderNumber = (isset($_GET['id']))? (int)$_GET['id'] : null;
if ($orderNumber == null) {
    echo '<script>window.location = "index.php"</script>';
}
try{
    $db = new Connection();
    $orderManager = new OrderManager($db);
    $orderItems = $orderManager->getAllNeedToBeCookedItems($orderNumber);
} catch (Exception $e){
    $errormsg = $e->getMessage();
}
?>
<br>
<div class="row">
    <div class="col-xl-2 d-none d-xl-block"></div>
    <div class="col-md-10 col-xl-8">
        <h1 class="text-center">Order Items for # <?php echo $orderNumber; ?></h1>
    </div>
    <div class="col-md-2 col-xl-2">
        <button class="btn btn-success" id="markOrder" >Mark Order Ready</button>
        <script>
            $('#markOrder').on('click', function () {
                window.location = "set_make_status.php?id=<?php echo $orderNumber; ?>";
            })
        </script>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12">
        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Menu Item</th>
                <th>Special Notes</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($orderItems as $o){
                if (!$o->getisCooked()){
                    echo '<tr>';
                    echo '<td>'.$o->getName().'</td>';
                    echo '<td>'.$o->getNotes().'</td>';
                    echo '</tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php
require_once __DIR__."/includes/footer.php";
echo '<script src="js/employee/manageEmployees.js"></script>'
?>
