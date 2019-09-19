<?php
    include('bootstrapCode.html');
    include('tpServer.php');
    if(!isset($_SESSION['employeeID'])) {
        header('location: tpEmployeeLogin.php');
    }
    $coffeeShopID = 0;
    $city = "";
    $address = "";
    $state = "";
    $phone = "";
    $shopName = "";
    $errors = array();
    
    // connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'coffeeshop') or die("Could not connect." . mysqli_connect_error());

    if(isset($_POST['addShopButton'])) {
        $coffeeShopID = mysqli_real_escape_string($db, $_POST['coffeeShopID']);
        $city = mysqli_real_escape_string($db, $_POST['city']);
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $state = mysqli_real_escape_string($db, $_POST['state']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $shopName = mysqli_real_escape_string($db, $_POST['shopName']);
        
        if(empty($coffeeShopID)) {
            array_push($errors, "Coffee shop ID is required. ");
        }
        if(empty($city)) {
            array_push($errors, "City is required. ");
        }
        if(empty($address)) {
            array_push($errors, "Address is required. ");
        }
        if(empty($phone)) {
            array_push($errors, "Phone number is required. ");
        }
        if(empty($shopName)) {
            array_push($errors, "Coffee shop name is required. ");
        }
        
        $shop_check_query = "SELECT coffeeShopID FROM shop WHERE coffeeShopID = '$coffeeShopID'";
        $result = mysqli_query($db, $shop_check_query);
        $shop = mysqli_fetch_assoc($result);
        
        if($shop) {
            if($shop['coffeeShopID'] === $coffeeShopID) {
                array_push($errors, "Coffee Shop ID is already being used. ");
            }
        }
        
        if(count($errors) == 0) {
            $query = "INSERT INTO shop (coffeeShopID, city, address, state, phone, shopName) VALUES ($coffeeShopID, '$city', '$address', '$state', '$phone', '$shopName')";
            mysqli_query($db, $query);
            header('Location: tpThankYou.php');
        }
    }

    
?>
<div class="jumbotron">
    <h1 class="text-center">Add Coffee Shops</h1>
</div>
<div class="container">
    <p><strong>
        <?php 
            //echo $_SESSION['employeeID'];
            echo $_SESSION['employeeName'];
        ?>
    </strong></p>
    <p> <a href="logout.php" style="color: red;text-decoration: none;" name="logout">Logout</a> </p>
    <form method="post" action="AddCoffeeShop.php">
        <?php include('tpErrors.php') ?>
        <div class="row pt-2">
            <div class="col-4">
                <h3>Coffee Shop ID</h3>
                <input type="text" class="form-control" name="coffeeShopID" value="<?php echo $coffeeShopID ?>" required/>
            </div>
            <div class="col-4">
                <h3>City</h3>
                <input type="text" class="form-control" name="city" value="<?php echo $city; ?>" required/>
            </div>
            <div class="col-4">
                <h3>Address</h3>
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>" required/>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-4">
                <h3>State</h3>
                <input type="text" class="form-control" name="state" value="<?php echo $state; ?>" required/>
            </div>
            <div class="col-4">
                <h3>Phone</h3>
                <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" required/>
            </div>
            <div class="col-4">
                <h3>Shop Name</h3>
                <input type="text" class="form-control" name="shopName" value="<?php echo $shopName; ?>" required/>
            </div>
        </div>
        <button class="mt-3 mb-3 btn btn-default" type="submit" name="addShopButton">Submit</button>
    </form>
    <p>
        <a href="tpEmployeeOptions2.php" style="text-decoration: none">Go back to Employee Option</a>
    </p>
</div>
