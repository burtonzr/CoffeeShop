<?php
    include('bootstrapCode.html');
    include('tpServer.php');
    //session_start();
    if(!isset($_SESSION['customerID'])) {
        header('location: tpLogin.php');
    } else {
?>
<div class="jumbotron">
    <h1 class="text-center"><?php echo $_SESSION['customerFirstName']; ?>'s Orders</h1>
</div>
<div class="container">
    <p><a href="logout.php" style="color: red;text-decoration: none;" name="logout">Logout</a></p>
    <div class="table-responsive">
        <table class="table">
            <?php
                $customerID = $_SESSION['customerID']; 
                $customerName = "SELECT customerFirstName, customerLastName FROM customers WHERE customerID = '$customerID'";
                $query = "SELECT * FROM customerorders WHERE customerID = '$customerID'";
                $result = mysqli_query($db, $query);
                if($row = mysqli_fetch_array($result)) {
                    $orderID = $row['orderID'];
                }
                echo '<thead><th>Order ID</th><th>Order Date</th><th>Shipped Date</th><th>Product ID</th><th>Quantity Ordered</th><th>Price Each</th><th>Comments</th><th>Total Price</th></thead>';
                while($row = mysqli_fetch_array($result)) {
                    echo "<tbody><tr>";
                    echo "<td>" . $row['orderID'] . "</td>";
                    echo "<td>" . $row['orderDate'] . "</td>";
                    echo "<td>" . $row['shippedDate'] . "</td>";
                    echo "<td>" . $row['productID'] . "</td>";
                    echo "<td>" . $row['quantityOrdered'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['comments'] . "</td>";
                    echo "<td>" . $row['totalPrice'] . "</td>";
                    echo "</tr></tbody>"; 
                }
            }
            ?>
        </table>
    </div>
    <p>
        <a href="tpCustomerOptions.php" style="text-decoration: none;padding-left: 60px;">Go Back to Customer Options</a>
    </p>
</div>