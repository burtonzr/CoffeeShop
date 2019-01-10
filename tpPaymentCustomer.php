<?php 
    include('bootstrapCode.html');
    include('tpServer.php');
    //$shop = "SELECT shopName FROM shop WHERE coffeeShopID = $orderID";
    /*
    if(isset($_GET['orderID'])) {
        $orderID = $_GET['orderID'];
        $query = "SELECT * FROM customerorders WHERE orderID = $orderID";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_array($result);
        $productName = "SELECT productName FROM products WHERE productID = " . $row['productID'];
        $result2 = mysqli_query($db, $productName);
        $row2 = mysqli_fetch_array($result2);
    }*/
?>
<div class="jumbotron">
    <h1 class="text-center">Thank you!</h1>
</div>
<div class="container">
    <div class="row">
        <h2>Thank you 
            <?php 
                if(isset($_SESSION['customerFirstName'])) {
                    echo $_SESSION['customerFirstName'];
                }
            ?>
            for placing an order!
        </h2>
    </div><br />
    <h2>Recipe: </h2><br />
    <p>
        Your total payment is $<?php echo $_SESSION['totalPrice']; ?>.
    </p>
    
    <p>
        <a href="tpCustomerOptions.php" style="text-decoration: none">Go back to Employee Option</a>
    </p>
    <p><a href="logout.php" style="color: red;text-decoration: none;" name="logout">Logout</a></p>
</div>