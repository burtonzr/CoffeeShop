<!DOCTYPE>
<html>
    <head>
      <?php include('bootstrapCode.html') ?>
    </head>
    <body>
        <div class="jumbotron text-center">
            <h1>Employee Options</h1>
        </div>
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-6 shadow p-4 mb-4 bg-white">
                    <h2><a href="tpEmployeeSignup.php" style="text-decoration: none;">Sign Up</a></h2><br />
                    <h6 class="muted">If you are a new employee, you need to sign up to make online orders and be assigned to a coffee shop. </h6>
                </div>
                <div class="col-md-6 shadow p-4 mb-4 bg-white">
                    <h2><a href="tpEmployeeLogin.php" style="text-decoration: none;">Make Order Login</a></h2>
                    <h6 class="muted">This is for returning employees who work at a location and need to place an order. </h6>
                </div>
            </div>
            <!---
            <div class="row">
                <div class="col-md-12 shadow p-4 mb-4 bg-white">
                    <h2><a href="nonOrderLogin.php" style="text-decoration: none;">Non-Order Login</a></h2>
                    <h6 class="muted">This is for returning employees who need to add coffee shops, products, and view information. </h6>
                </div>
            </div>--->
            <p class="pt-4">
                <a href="tpHome.php" style="text-decoration: none;">Home Page</a>
            </p>
        </div>
    </body>
</html>