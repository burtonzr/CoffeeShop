<?php 
    include('bootstrapCode.html');
    
    $db = mysqli_connect('localhost', 'root', 'Biketowork!11', 'coffeeshop') or die("Could not connect." . mysqli_connect_error());
    $email = "";
    $coffeeShopID = 0;
    $errors = array();

    session_start(); // start a session
    if(isset($_POST['login_button2'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $coffeeShopID = mysqli_real_escape_string($db, $_POST['coffeeShopID']);
        if(empty($email)) {
            array_push($errors, "Email is required. ");
        }
        if(empty($coffeeShopID)) {
            array_push($errors, "Coffee Shop ID is required. ");
        }
        if(count($errors) == 0) {
            $query = "SELECT * FROM Employees WHERE email = '$email' AND coffeeShopID = '$coffeeShopID'";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $_SESSION['employeeID'] = $row['employeeID'];
                $_SESSION['employeeName'] = $row['firstName'];
                $_SESSION['totalPrice'] = $row['totalPrice'];
                //$_SESSION['productID'] = $row['productID'];
                header('Location: tpEmployeeOptions2.php'); // sends the user to another page
            } else {
                array_push($errors, "Wrong email or wrong coffee shop ID.");
            }
        }
    }
?>
<div class="jumbotron">
    <h1 class="text-center">Login</h1>
</div>
<div class="container">
    <form method="post" action="tpEmployeeLogin.php">
        <?php include('tpErrors.php') ?>
        <div class="row">
            <div class="col-6">
                <h3>Email</h3><br />
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>"/><br />
            </div>
            <div class="col-6">
                <h3>Coffee Shop ID</h3><br />
                <input type="text" name="coffeeShopID" class="form-control" value="<?php echo $coffeeShopID; ?>"/>
            </div>
        </div>
        <button class="btn btn-default mt-3 mb-3" type="submit" name="login_button2">Submit</button>
        <p>
            Not an employee? <a href="tpEmployeeSignup.php" style="text-decoration: none;">Sign up</a>
        </p>
        <p>
            <a href="tpHome.php" style="text-decoration: none;">Go back home</a>
        </p>
    </form>
</div>