<html>
    <head>
        <?php 
            include('bootstrapCode.html') ;
            include('tpServer.php');
            if(!isset($_SESSION['employeeID'])) {
                header('location: tpEmployeeLogin.php');
            }
        ?>
    </head>
    <body>
        <div class="jumbotron">
            <h1 class="text-center">Search Options</h1>
        </div>
        <div class="container">
            <p><strong>
                <?php 
                    //echo $_SESSION['employeeID'];
                    echo $_SESSION['employeeName'];
                ?>
            </strong></p>
            <p> <a href="logout.php" style="color: red;text-decoration: none;" name="logout">Logout</a> </p>
            <div class="row">
                <div class="col-6 shadow p-4 mb-4 bg-white">
                    Search by Customer Name
                    <form action="searchOptions.php" method="post"><br />
                        <input type="text" name="search1" placeholder="Search..." class="form-control" />
                        <input type="submit" value="Submit" class="mt-2 btn btn-default" />
                    </form>
                    <?php
                        $db = mysqli_connect('localhost', 'root', 'Biketowork!11', 'coffeeshop') or die("Could not connect." . mysqli_connect_error());
                        $output1 = '';
        
                        if(isset($_POST['search1'])) {
                            $searchQuery1 = $_POST['search1'];
                            $searchQuery1 = preg_replace("#[^a-z]#i", "", $searchQuery1);
                            
                            $query1 = mysqli_query($db, "SELECT * FROM customers WHERE customerFirstName LIKE '%$searchQuery1%' OR customerLastName LIKE '%$searchQuery1%'") or die("Could not search." . mysqli_connect_error());
                            
                            $count1 = mysqli_num_rows($query1);
                            
                            if($count1 == 0) {
                                $output1 = "There was no search result. ";
                            } else {
                                
                                $trows = '';
                                //$thead = '';
                                //$i = 0;
                                while($row = mysqli_fetch_assoc($query1)) {
                                    $trows .= '<tr>';
                                    
                                    /* foreach($row as $key => $data) {
                                        if (!is_numeric($key)) {
                                            if ($i == 0) {
                                                $thead .= '<th>'. $key .'</th>';
                                            }
                                            $trows .= '<td>'. $data .'</td>';
                                        }
                                    }
                                    $trows .= '</tr>';
                                    $i++; */
                                    
                                    $trows .= '<td>'. $row['customerFirstName'] .'</td>';
                                    $trows .= '<td>' . $row['customerLastName'] . '</td>';
                                    $trows .= '<td>' . $row['phone'] . '</td>';
                                    $trows .= '<td>' . $row['city'] . '</td>';
                                    $trows .= '<td>' . $row['state'] . '</td>';
                                    
                                    $trows .= '</tr>';
                 
                                }
                                $output1 = "<div class='table-responsive'>";
                                $output1 .= "<table class='table'>";
                                $output1 .= "<thead><th>First Name</th><th>Last Name</th><th>Phone Number</th>
                                <th>City</th><th>State</th></thead>";
                                $output1 .= "<tbody>$trows</tbody></table></div>";
                            }
                        }
                        
                        print("$output1");
                    ?>
                </div>
                <div class="col-6 shadow p-4 mb-4 bg-white">
                    Search by Employee Name
                    <form action="searchOptions.php" method="post"><br />
                        <input type="text" class="form-control" name="search2" placeholder="Search... " />
                        <input type="submit" value="Submit" class="mt-2 btn btn-default" />
                    </form>
                    <?php
                        $db = mysqli_connect('localhost', 'root', 'Biketowork!11', 'coffeeshop') or die("Could not connect." . mysqli_connect_error());
                        $output2 = '';
                        
                        if(isset($_POST['search2'])) {
                            $searchQuery2 = $_POST['search2'];
                            $searchQuery2 = preg_replace("#[^a-z]#i", "", $searchQuery2);
                            $query2 = mysqli_query($db, "SELECT * FROM employees WHERE firstName LIKE '%$searchQuery2%' OR lastName LIKE '%$searchQuery2%'") or die("Could not search. " . mysqli_connect_error());
                            $count2 = mysqli_num_rows($query2);
                            
                            if($count2 == 0) {
                                $output2 = "There was no search result. ";
                            } else {
                                $trows = '';
                                while($row = mysqli_fetch_assoc($query2)) {
                                    $trows .= '<tr>';
                                    $trows .= '<td>' . $row['firstName'] . '</td>';
                                    $trows .= '<td>' . $row['lastName'] . '</td>';
                                    $trows .= '<td>' . $row['email'] . '</td>';
                                    $trows .= '<td>' . $row['coffeeShopID'] . '</td>';
                                    
                                    $trows .= '</tr>';
                
                                    $output2 = "<div class='table-responsive'>";
                                    $output2 .= "<table class='table'>";
                                    $output2 .= "<thead><th>First Name</th><th>Last Name</th><th>Email</th><th>Coffee Shop ID</th></thead>";
                                    $output2 .= "<tbody>$trows</tbody></table></div>";
                                }
                            }
                            
                        }
                    
                        print("$output2");
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-6 shadow p-4 mb-4 bg-white">
                    Search Customer Orders by Order Number or Product ID
                    <form action="searchOptions.php" method="post"><br />
                        <input type="text" class="form-control" name="search3" placeholder="Search..." />
                        <input type="submit" value="Submit" class="mt-2 btn btn-default"/>
                    </form>
                    <?php
                        $db = mysqli_connect('localhost', 'root', 'Biketowork!11', 'coffeeshop') or die("Could not connect." . mysqli_connect_error());
                        $output3 = '';

    
                        if(isset($_POST['search3'])) {
                            $searchQuery3 = $_POST['search3'];
                            $searchQuery3 = preg_replace("#[^0-9]#", "", $searchQuery3);
                            $query3 = mysqli_query($db, "SELECT * FROM customerorders WHERE orderID = '$searchQuery3' OR productID = '$searchQuery3'") or die("Could not search." . mysqli_connect_error());
                            $count3 = mysqli_num_rows($query3);
                            if($count3 == 0) {
                                $output3 = "There was no search result. ";
                            } else {
                                $trows = '';
                                while($row = mysqli_fetch_assoc($query3)) {
                                    $trows .= '<tr>';
                                    $trows .= '<td>' . $row['orderID'] . '</td>';
                                    $trows .= '<td>' . $row['orderDate'] . '</td>';
                                    $trows .= '<td>' . $row['shippedDate'] . '</td>';
                                    $trows .= '<td>' . $row['quantityOrdered'] . '</td>';
                                    $trows .= '<td>' . $row['price'] . '</td>';
                                    $trows .= '<td>' . $row['productID'] . '</td>';
                                    $trows .= '<td>' . $row['totalPrice'] . '</td>';
                                    
                                    $trows .= '</tr>';
                                    
                                    $output3 = "<div class='table-responsive'>";
                                    $output3 .= "<table class='table'><thead><th>Order ID</th><th>Ordered Date</th><th>Shipped Date</th><th>Bags</th><th>Price</th><th>Product ID</th><th>Total Price</th></thead>";
                                    $output3 .= "<tbody>$trows</tbody></table></div>";
                                }
                            }
                        }
                    
                        print("$output3");
                    ?>
                </div>
                <div class="col-6 shadow p-4 mb-4 bg-white">
                    Search Employee Orders by Order Number or Product ID
                    <form action="searchOptions.php" method="post"><br />
                        <input type="text" class="form-control" name="search4" placeholder="Search..." />
                        <input type="submit" value="Submit" class="mt-2 btn btn-default" />
                    </form>
                    <?php
                        $db = mysqli_connect('localhost', 'root', 'Biketowork!11', 'coffeeshop') or die("Could not connect." . mysqli_connect_error());
                        $output4 = '';
                    
                        if(isset($_POST['search4'])) {
                            $searchQuery4 = $_POST['search4'];
                            $searchQuery4 = preg_replace("#[^0-9]#", "", $searchQuery4);
                            $query4 = mysqli_query($db, "SELECT * FROM employeeorders WHERE orderID = '$searchQuery4' OR productID = '$searchQuery4'") or die("Could not connect. " . mysqli_connect_error());
                            $count4 = mysqli_num_rows($query4);
                            if($count4 == 0) {
                                $output4 = "There was no search result.";
                            } else {
                                $trows = '';
                                while($row = mysqli_fetch_array($query4)) {
                                    $trows .= '<tr>';
                                    $trows .= '<td>' . $row['orderID'] . '</td>';
                                    $trows .= '<td>' . $row['orderDate'] . '</td>';
                                    $trows .= '<td>' . $row['shippedDate'] . '</td>';
                                    $trows .= '<td>' . $row['productID'] . '</td>';
                                    $trows .= '<td>' . $row['quantityOrdered'] . '</td>';
                                    $trows .= '<td>' . $row['priceEach'] . '</td>';
                                    $trows .= '</tr>';
                                    
                                    $output4 = "<div class='table-responsive'>";
                                    $output4 .= "<table class='table'><thead><th>Order ID</th><th>Ordered Date</th><th>Shipped Date</th><th>Product ID</th><th>Bags</th><th>Price</th></thead>";
                                    $output4 .= "<tbody>$trows</tbody></table></div>";
                                }
                            }
                        }
                    
                        print("$output4");
                    ?>
                </div>
            </div>
            <p>
                <a href="tpEmployeeOptions2.php" style="text-decoration: none;">Go back to employee options</a>
            </p>
        </div>
    </body>
</html>