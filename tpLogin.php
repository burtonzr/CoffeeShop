<?php 
    include('bootstrapCode.html');
    // Login Customer
    $db = mysqli_connect('localhost', 'root', 'Biketowork!11', 'coffeeshop') or die("Could not connect." . mysqli_connect_error());
    $username = "";
    $password = "";
    session_start();
    $errors = array();
    if(isset($_POST['login_button'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(empty($username)) {
            array_push($errors, "Username is required!");
        }
        if(empty($password)) {
            array_push($errors, "Password is required!");
        }

        if(count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM Customers WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $_SESSION['customerID'] = $row['customerID'];
                $_SESSION['customerFirstName'] = $row['customerFirstName'];
                $_SESSION['totalPrice'] = $row['totalPrice'];
                $_SESSION['username'] = $row['username'];
                //$_SESSION['quantityOrdered'] = $row['quantityOrdered'];
                header('location: tpCustomerOptions.php');
            } else {
                array_push($errors, "Wrong username/password combination.");
            }
        }
    }
?>
<div class="jumbotron">
    <h1 class="text-center">Login</h1>
</div>
<div class="container">
    <form method="post" action="tpLogin.php">
        <?php include('tpErrors.php') ?>
        <div class="row">
            <div class="col-6">
                <h3>Username</h3><br />
                <input type="username" name="username" class="form-control"/><br />
            </div>
            <div class="col-6">
                <h3>Password</h3><br />
                <input type="password" name="password" class="form-control"/>
            </div>
        </div>
        <button class="btn btn-default mt-3 mb-3" type="submit" name="login_button">Submit</button>
        <p>
            Not a user yet? <a href="tpSignup.php" style="text-decoration: none;">Sign Up</a>
        </p>
        <p class="pt-4">
            <a href="tpHome.php" style="text-decoration: none;">Home Page</a>
        </p>
    </form>
</div>