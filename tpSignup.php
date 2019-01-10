<?php 
    include('bootstrapCode.html');
    include('tpServer.php');
?>
<div class="jumbotron">
    <h1 class="text-center">Sign Up</h1>
</div>
<div class="container">
    <form method="post" action="tpSignup.php">
        <?php include('tpErrors.php') ?>
        <strong>Once you sign up, you will have to login with your new username and password. </strong>
        <div class="row pt-2">
            <div class="col-4">
                <h3>Username</h3><br />
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>"/>
            </div>
            <div class="col-4">
               <h3>Password</h3><br />
                <input type="password" class="form-control" name="password1" />
            </div>
            <div class="col-4">
                <h3>Confirm Password</h3><br />
                <input type="password" class="form-control" name="password2" />
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-4">
                <h3>First Name</h3><br />
                <input type="text" class="form-control" name="customerFirstName" value="<?php echo $customerFirstName; ?>"/>
            </div>
            <div class="col-4">
                <h3>Last Name</h3><br />
                <input type="text" class="form-control" name="customerLastName" value="<?php echo $customerLastName; ?>"/>
            </div>
            <div class="col-4">
                <h3>Email</h3><br />
                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>"/>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-4">
                <h3>Address</h3><br />
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>"/>
            </div>
            <div class="col-4">
                <h3>City</h3><br />
                <input type="text" class="form-control" name="city" value="<?php echo $city; ?>"/>
            </div>
            <div class="col-4">
                <h3>State</h3><br />
                <input type="text" class="form-control" name="state" value="<?php echo $state; ?>"/>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-4">
                <h3>Phone Number</h3>
                <input type="tel" class="form-control" name="phone" value="<?php echo $phone; ?>"/>
            </div>
        </div>
        <button class="mt-3 mb-3 btn btn-default" type="submit" name="sign_up_button">Submit</button>
        <p>
            Already a user? <a href="tpLogin.php" style="text-decoration: none;">Login</a>
        </p>
        <p class="pt-4">
            <a href="tpHome.php" style="text-decoration: none;">Home Page</a>
        </p>
    </form>
</div>