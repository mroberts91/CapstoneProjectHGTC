<?php

use Core\Department;
require_once __DIR__."/../../Data/enum/Department.php";

$empID = $_SESSION['user_id'];
$dept = $_SESSION['user_perm_level'];
$isManager = ($dept == Department::$ADMIN || $dept == Department::$MANAGER);
$viewKitchen = ($isManager || $dept == Department::$KITCHEN)? true : false;
$createOrders = ($isManager || $dept == Department::$WAITSTAFF)? true : false;
?>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Menu
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="backendMenuItem.php">View Menu</a>
        <?php
            if ($isManager){
                echo '
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="addMenuItem.php">Add Menu Item</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="menu_catagories.php">Manage Categories</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="menu_inventory.php">Inventory Report</a>
                ';
            }
        ?>
    </div>
</li>
<?php
if ($viewKitchen){
    echo '
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="inventoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Kitchen
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="total_make_list.php">View Make List</a>
            </div>
        </li>    
    ';
}
?>
<?php
if ($createOrders) {
    echo '
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="orderDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Orders
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="your_orders.php">Your Open Orders</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="create_new_order.php">Create New Order</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="all_open_orders.php">View All Open Orders</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Order Report</a>
        </div>
    </li>
';
}
?>

<?php
if ($isManager){
echo '
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="employeeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Employee
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="create_employee.php">Add Employee</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="manage_employees.php">Manage Employees</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="employee_profile.php">View Your Profile</a>
    </div>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="customerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Customer
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="create_customer.php">Add Customer</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="view_customers.php">View Customers</a>
    </div>
</li>
';
}
?>