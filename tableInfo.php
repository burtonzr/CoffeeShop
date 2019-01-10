<?php
    include('bootstrapCode.html');
    include('tpServer.php');
    error_reporting(E_ERROR | E_PARSE);
    // connect to the database
    //$db = mysqli_connect('localhost', 'root', 'Biketowork!11', 'coffeeshop') or die("Could not connect." . mysqli_connect_error());
?> 
<div class="jumbotron">
    <h1 class="text-center">View Information</h1>
</div>
<div class="container">
    <p class="pt-4">
        <a href="tpEmployeeOptions2.php" style="text-decoration: none;">Go back to employee options</a>
    </p>
    <p><strong>
        <?php 
            //echo $_SESSION['employeeID'];
            echo $_SESSION['employeeName'];
        ?>
    </strong></p>
    <p> <a href="logout.php" style="color: red;text-decoration: none;" name="logout">Logout</a> </p>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <h2 class="text-center">Customers</h2>
                <?php
                    $customerID = 0;
                    $customerFirstName = "";
                    $customerLastName = "";
                    $phone = "";
                    $city = "";
                    $state = "";
                    $query1 = "SELECT * FROM customers";
                    $result1 = mysqli_query($db, $query1);
                    $count1 = mysqli_num_rows($result1);
                
                    if($count1 == 0) {
                        $output1 = "There was no search result. ";
                    } else {
                        echo '<table class="table table-striped">';
                        echo '<th>Customer ID</th><th>First Name</th><th>Last Name</th><th>Phone</th><th>Address</th><th>City</th><th>State</th><th>Username</th><th>Email</th>';
                            while($row = mysqli_fetch_array($result1)) {
                                echo '<tr><td>' . $row['customerID'] . '</td><td>' . $row['customerFirstName'] . "</td><td>" . $row['customerLastName'] . "</td><td>" . 
                                    $row['phone'] . "</td><td>" . $row['address'] . "</td><td>" . $row['city'] . "</td><td>" . $row['state'] . "</td><td>" . $row['username'] . "</td><td>" . $row['email']  . "</td></tr>";
                                
                            }
                        echo '</table>';
                        
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <h2 class="text-center">Employees</h2>
                <?php
                    // connect to the database
                    $db = mysqli_connect('localhost', 'root', 'Biketowork!11', 'coffeeshop') or die("Could not connect." . mysqli_connect_error());
                    $query2 = "SELECT * FROM Employees";
                    $result2 = mysqli_query($db, $query2);
                    $count2 = mysqli_num_rows($result1);
                    $employeeID = 0;
                    $firstName = "";
                    $lastName = "";
                    $email = "";
                    $coffeeShopID = 0;
                    $output2 = "";
                    if($count2 == 0) {
                        $output2 = "There was no search result. ";
                    } else {
                        echo '<table class="table table-striped">';
                        echo '<th>Employee ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Coffee Shop ID</th>';
                        while($row = mysqli_fetch_array($result2)) {
                             echo '<tr><td>' . $row['employeeID'] . '</td><td>' . $row['firstName'] . "</td><td>" . $row['lastName'] . "</td><td>" . $row['email'] . "</td><td>" . $row['coffeeShopID'] . "</td></tr>";
                        }
                        echo '</table>';
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <h2 class="text-center">Coffee Shops</h2>
                <?php
                    $query = "SELECT * FROM shop ORDER BY coffeeShopID ASC";
                    $result = mysqli_query($db, $query);
                    $count = mysqli_num_rows($result);
                    $coffeeShopID = 0;
                    $city = "";
                    $address = "";
                    $state = "";
                    $phone = "";
                    $shopName = "";
                    if($count == 0) {
                        $output = "There was no search result. ";
                    } else {
                        echo '<table class="table table-striped">';
                        echo '<th>Coffee Shop ID</th><th>Shop Name</th><th>City</th><th>Adress</th><th>State</th><th>Phone</th>';
                        while($row = mysqli_fetch_array($result)) {
                            echo '<tr><td>' . $row['coffeeShopID'] . '</td><td>' . $row['shopName'] . "</td><td>" . $row['city'] . "</td><td>" . $row['address'] . "</td><td>" . $row['state'] . "</td><td>" . $row['phone'] . "</td></tr>";
                        }
                        echo '</table>';
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <h2 class="text-center">Customer Orders</h2>
                <?php
                    $query3 = "SELECT * FROM customerorders";
                    $result3 = mysqli_query($db, $query3);
                    $count3 = mysqli_num_rows($result3);
                    $orderID = 0;
                    $orderDate = "";
                    $shippedDate = "";
                    $comments = "";
                    $productID = 0;
                    $quantityOrdered = 0;
                    $price = 0;
                    $customerID = 0;
                    $totalPrice = 0;
                    $output3 = "";
                    echo '<table class="table table-striped">';
                    echo '<th>Order ID</th><th>Order Date</th><th>Shipped Date</th><th>Comments</th><th>Product ID</th><th>Quantity Ordered</th><th>Price</th><th>Customer ID</th><th>Total Price</th>';
                        while($row = mysqli_fetch_array($result3)) {
                            echo '<tr><td>' . $row['orderID'] . '</td><td>' . $row['orderDate'] . "</td><td>" . $row['shippedDate'] . "</td><td>" . $row['comments'] . "</td><td>" . $row['productID'] . "</td><td>" . $row['quantityOrdered'] . "</td><td>" . $row['price'] . '</td><td>' . $row['customerID'] . '</td><td>' . $row['totalPrice'] . '</td></tr>';
                        }
                    echo '</table>';
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <h2 class="text-center">Employee Orders</h2>
                <?php
                    $query4 = "SELECT * FROM employeeorders";
                    $result4 = mysqli_query($db, $query4);
                    $count4 = mysqli_num_rows($result4);
                    $orderID = 0;
                    $orderDate = "";
                    $shippedDate = "";
                    $comments = "";
                    $productID = 0;
                    $quantityOrdered = 0;
                    $price = 0;
                    $employeeID = 0;
                    $totalPrice = 0;
                    $output4 = "";
                    echo '<table class="table table-striped">';
                    echo '<th>Order ID</th><th>Order Date</th><th>Shipped Date</th><th>Comments</th><th>Product ID</th><th>Quantity Ordered</th><th>Price</th><th>Employee ID</th><th>Total Price</th>';
                        while($row = mysqli_fetch_array($result4)) {
                            echo '<tr><td>' . $row['orderID'] . '</td><td>' . $row['orderDate'] . "</td><td>" . $row['shippedDate'] . "</td><td>" . $row['comments'] . "</td><td>" . $row['productID'] . "</td><td>" . $row['quantityOrdered'] . "</td><td>" . $row['priceEach'] . '</td><td>' . $row['employeeID'] . '</td><td>' . $row['totalPrice'] . '</td></tr>';
                        }
                    echo '</table>';
                ?>
            </div>
        </div>
    </div>
</div>