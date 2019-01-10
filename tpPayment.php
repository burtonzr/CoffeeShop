<?php 
    include('bootstrapCode.html');
    include('tpServer.php');
    //$shop = "SELECT shopName FROM shop WHERE coffeeShopID = $orderID";
    /*
    if(isset($_GET['orderID'])) {
        $orderID = $_GET['orderID'];
        $query = "SELECT * FROM employeeorders WHERE orderID = $orderID";
        $result = mysqli_query($db, $query);
        //$productName = "SELECT productName FROM products WHERE productID = " . $row['productID'];
        //$result2 = mysqli_query($db, $productName);
        //$row2 = mysqli_fetch_array($result2);
        //$row['productName'] = $row2['productName'];   
    }*/
?>
<div class="jumbotron">
    <h1 class="text-center">Thank you!</h1>
</div>
<div class="container">
    <div class="row">
        <h2>Thank you 
            <?php 
                if(isset($_SESSION['employeeName'])) {
                    echo $_SESSION['employeeName'];
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
        Price per bag: 
        <?php 
            echo $priceEach
            /*
            if(isset($_GET['orderID'])) {
                $orderID = $_GET['orderID'];
                $query = "SELECT * FROM employeeorders WHERE orderID = $orderID";
                $result = mysqli_query($db, $query);
                while($row = mysqli_fetch_array($result)) {
                    echo $row['priceEach'];
                } 
            }*/
        ?>
    </p>
    <!---
    <p>
        Number of Bags: <?php /*echo $row['quantityOrdered'];*/ ?>
    </p>
    <p>
        Origin / Roast purchased: <?php /*echo $row2['productName'];*/ ?>
    </p>
    <p>
        Roasted at: <?php //echo $row['']; ?>
    </p>
    --->
    <p>
        <a href="tpEmployeeOptions2.php" style="text-decoration: none">Go back to Employee Option</a>
    </p>
    <p><a href="logout.php" style="color: red;text-decoration: none;" name="logout">Logout</a></p>
</div>