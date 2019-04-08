<?php $empID = $_SESSION['user_id']; ?>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Menu
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">View Menu</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Add Menu Catagory</a>
    </div>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="inventoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Inventory
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">View Inventory</a>
    </div>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="orderDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Orders
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">Create Order</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Order Report</a>
    </div>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="employeeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Employee Management
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="create_employee.php">Add Employee</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="manage_employees.php">Manage Employees</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="employee_profile.php?id=<?php echo $empID?>">View Your Profile</a>
    </div>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="customerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Customer Management
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="create_customer.php">Add Customer</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="view_customers.php">View Customers</a>
    </div>
</li>
