<?php
    include('bootstrapCode.html');
    include('tpServer.php');
    if(!isset($_SESSION['employeeID'])) {
        header('location: tpEmployeeLogin.php');
    }
?>
<div class="jumbotron text-center">
    <h1>Employee Options</h1>
</div>
<div class="container pt-5">
    <p><strong>
        <?php 
            //echo $_SESSION['employeeID'];
            echo $_SESSION['employeeName'];
        ?>
    </strong></p>
    <p><a href="logout.php" style="color: red;text-decoration: none;" name="logout">Logout</a></p>
    <div class="row">
        <div class="col-md-6 shadow p-4 bg-white">
            <h2><a href="tpEmployeeOrder.php" style="text-decoration: none;">Order Inventory</a></h2>
            <h6 class="muted">Place an order.</h6>
        </div>
        <div class="col-md-6 shadow p-4 bg-white">
            <h2><a href="AddCoffeeShop.php" style="text-decoration: none;">Add Coffee Shop</a></h2>
            <h6 class="muted">Want to choose from even more coffee shops? </h6>
        </div>
    </div>
    <div class="row pt-2">
        <div class="col-md-6 shadow p-4 bg-white">
            <h2><a href="AddProduct.php" style="text-decoration: none;">Add Coffee Origin / Roast</a></h2>
            <h6 class="muted">Add a new product to sell to other baristas and customers. </h6>
        </div>
        <div class="col-md-6 shadow p-4 bg-white">
            <h2><a href="tableInfo.php" style="text-decoration: none;">View Information</a></h2>
            <h6 class="muted">View all customers, employees, and orders in multiple tables. </h6>
        </div>
    </div>
    <div class="row pt-2 pb-5">
        <div class="col-md-6 shadow p-4 bg-white">
            <h2><a href="searchOptions.php" style="text-decoration: none;">Search for employees, customers, and orders.</a></h2>
            <h6 class="muted">This option is useful if you know what specific person or order you are looking for. </h6>
        </div>
        <div class="col-md-6 shadow p-4 bg-white">
            <h2><a href="tpEmployeeViewOrder.php" style="text-decoration: none;">View Your Own Orders.</a></h2>
            <h6 class="muted">View your past orders. </h6>
        </div>
    </div>
</div>