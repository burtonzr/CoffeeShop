<?php
    include('bootstrapCode.html');

    $firstName = "";
    $lastName = "";
    $email = "";
    $coffeeShop = "";
    $errors = array();

    // connect to the database
    $db = mysqli_connect('localhost', 'root', 'Biketowork!11', 'coffeeshop') or die("Could not connect." . mysqli_connect_error());

    if(isset($_POST['sign_up_employee_button'])) {
        $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($db, $_POST['lastName']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $coffeeShop = mysqli_real_escape_string($db, $_POST['coffeeShop']);
        
        if(empty($firstName)) {
            array_push($errors, "First name is required. ");
        }
        
        if(empty($lastName)) {
            array_push($errors, "Last name is required. ");
        }
        
        if(empty($email)) {
            array_push($errors, "Email is required. ");
        }
        
        if(empty($coffeeShop)) {
            array_push($errors, "We need to know where you will work. ");
        }
        
        $employee_check_query = "SELECT firstName, lastName, email FROM employees WHERE firstName = '$firstName' 
        OR lastName = '$lastName' OR email = '$email'";
        $result = mysqli_query($db, $employee_check_query);
        $employee = mysqli_fetch_assoc($result);
        
        if($employee) {
            if($employee['email'] == $email) {
                array_push($errors, "Email already exists. ");
            }
        }
        
        if(count($errors) == 0) {
            $query = "INSERT INTO employees (firstName, lastName, email, coffeeShopID) VALUES('$firstName', '$lastName', '$email', $coffeeShop)";
            mysqli_query($db, $query);
            header('location: tpEmployeeLogin.php');
        }
     }

    $sql = "SELECT coffeeShopID, shopName FROM shop";
    $result = mysqli_query($db, $sql);
    
?>
<div class="jumbotron">
    <h1 class="text-center">Sign Up</h1>
</div>
<div class="container">
    <form method="post" action="tpEmployeeSignup.php">
        <?php include('tpErrors.php') ?>
        <strong>Once you sign up, we will have you login with your new email and coffee shop ID. </strong>
        <div class="row pt-2">
            <div class="col-4">
                <h3>First Name</h3><br />
                <input type="text" class="form-control" name="firstName" value="<?php echo $firstName; ?>"/>
            </div>
            <div class="col-4">
                <h3>Last Name</h3><br />
                <input type="text" class="form-control" name="lastName" value="<?php echo $lastName; ?>"/>
            </div>
            <div class="col-4">
                <h3>Email</h3><br />
                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>"/>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-4">
                <h3>Coffee Shop</h3>
                <?php
                    echo '<select name="coffeeShop" class="form-control" value="<?php echo $coffeeShop; ?>" >';
                    while($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row['coffeeShopID'] . "'>" . $row['shopName'] . "</option>";
                    }
                    echo '</select>';
                ?>
            </div>
        </div>
        <button class="mt-3 mb-3 btn btn-default" type="submit" name="sign_up_employee_button">Submit</button>
        <p>
            Already a user? <a href="tpEmployeeLogin.php" style="text-decoration: none;">Login</a>
        </p>
        <p>
            <a href="tpHome.php" style="text-decoration: none;">Go back home</a>
        </p>
    </form>
</div>