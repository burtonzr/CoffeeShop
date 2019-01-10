<?php
    include('bootstrapCode.html');
    include('tpServer.php');
    if(!isset($_SESSION['customerID'])) {
        header('location: tpLogin.php');
    }
?>
<div class="jumbotron">
    <h1 class="text-center">Customer Options</h1>
</div>
<div class="container">
    <p>Welcome <strong><?php echo $_SESSION['customerFirstName']; ?></strong></p>
    <p> <a href="logout.php" style="color: red;text-decoration: none;" name="logout">Logout</a></p>
    <div class="row">
        <div class="col-6 shadow p-4 bg-white">
            <h2><a href="viewOrder.php" style="text-decoration: none;">View Your Orders</a></h2>
            <h6 class="muted">View your past orders. </h6>
        </div>
        <div class="col-6 shadow p-4 bg-white">
            <h2><a href="tpCustomerOrder.php" style="text-decoration: none;">Online Order</a></h2>
            <h6 class="muted">Place an order.</h6>
        </div>
    </div>
</div>