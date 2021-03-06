<?php 
    include('bootstrapCode.html');
    include('tpServer.php');
    //session_start();
    if(!isset($_SESSION['employeeID'])) {
        $_SESSION['msg'] = "You must log in first. ";
        header('location: tpEmployeeLogin.php');
    }
    $sql = "SELECT productID, price, productName FROM products";
    $result = mysqli_query($db, $sql);
    $sql2 = "SELECT shopName FROM shop";
    $result2 = mysqli_query($db, $sql2);
?>
<div class="jumbotron text-center">
    <h1>Online Orders</h1>
</div>
<div class="container pt-4">
    <p><strong>
        <?php 
            //echo $_SESSION['employeeID'];
            echo $_SESSION['employeeName'];
        ?>
    </strong></p>
    <p> <a href="logout.php" style="color: red;text-decoration: none;" name="logout">Logout</a> </p>
    <form method="post" action="tpEmployeeOrder.php">
        <?php include('tpErrors.php') ?>
        <div class="row">
            <div class="col-4">
                <h3>Origin / Roast</h3> <br />
                <?php
                    echo '<select name="origin" class="form-control" value="<?php echo $origin; ?>">';
                    while($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row['productID'] . "'>" . $row['productName'] . "</option>";
                    }
                    echo '</select>';
                ?>
            </div>
            <div class="col-4">
                <h3>Coffee Shop</h3><br />
                <?php 
                    echo '<select name="shop" class="form-control" value="<?php echo $shop;?>">';
                    while($row = mysqli_fetch_array($result2)) {
                        echo "<option value='" . $row['shopName'] . "'>" . $row['shopName'] . "</option>";
                    }
                    echo '</select>';
                ?>
            </div>
            <div class="col-4">
                <h3>Quantity (bags)</h3><br />
                <input type="number" class="form-control" name="quantityOrdered" value="<?php echo $quantityOrdered; ?>" id="quantityOrdered" placeholder="Bag number..." />
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-4">
                <!--<h3>Order Date</h3><br />-->
                <input type="hidden" name="orderedDate" class="form-control" value="<?php echo date('Y/m/d'); ?>"/>
            </div>
            <div class="col-4">
                <!--<h3>Shipped Date</h3><br />-->
                <input type="hidden" name="shippedDate" class="form-control" value="<?php echo date('Y/m/d', strtotime("+2 days"));  ?>"/>
            </div>
            <div class="col-6">
                <h3>Comments</h3><b />
                <textarea name="comments" class="form-control" value="<?php echo $comments; ?>">
                    
                </textarea>
            </div>
        </div>
        <button type="submit" class="mt-3 mb-3 btn btn-default" name="order_button2" value="Submit">Submit</button>
        <p>
            <a href="tpEmployeeOptions2.php" style="text-decoration: none">Go back to Employee Option</a>
        </p>
    </form>
</div>