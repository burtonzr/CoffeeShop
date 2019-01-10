<!DOCTYPE>
<html>
    <head>
      <title>Coffee Shop</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include('bootstrapCode.html') ?>
    </head>
    <body>
        <div class="jumbotron text-center">
            <h1>Bean Boox</h1>
        </div>
        <div class="container pt-5">
            <div class="row pb-4">
                <div class="col-md-6 shadow p-4 mb-4 bg-white">
                    <h2><a href="tpEmployeeOptions.php" style="text-decoration: none;">Order Beans</a></h2><br />
                    <h6 class="muted">Employees Only</h6>
                </div>
                <div class="col-md-6 shadow p-4 mb-4 bg-white">
                    <h2><a href="tpSignUpOrLogin.php" style="text-decoration: none;">Online Orders</a></h2>
                    <h6 class="muted">Customers Only</h6>
                </div>
            </div>
            <!--
            <div class="row">
                <div class="col-md-12 shadow p-4 mb-4 bg-white">
                    <h2><a href="contact.php" style="text-decoration: none;">Contact Us</a></h2><br />
                    <h6 class="muted">This is where you can contact us to reset your password or ask questions you may have. </h6>
                </div>
            </div>
-->
            <h1 class="text-center pb-2">Products For Sale</h1>
            <?php
                // connect to the database
                $db = mysqli_connect('localhost', 'root', 'Biketowork!11', 'coffeeshop') or die("Could not connect." . mysqli_connect_error());
                $productName = "";
                $originDescription = "";
                $price = "";
                $image = "";
                $query = "SELECT productName, originDescription, price, image FROM products ORDER BY productName ASC";
                $result = mysqli_query($db, $query);
                $count = mysqli_num_rows($result);
                echo '<div class="table-responsive">';
                echo '<table class="table table-striped">';
                echo '<th class="pl-5">Product Name</th><th class="pl-5">Origin Description</th><th class="pl-5">Price</th><th class="pl-5">Image</th>';
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr><td class='pl-5'>" . $row['productName'] . "</td><td class='pl-5'>" . $row['originDescription'] . "</td><td class='pl-5'>" . $row['price'] .  "</td><td class='pl-5 img-responsive'><img src='" . $row['image'] . "' width='20%'/></td></tr>";
                }
                echo '</table>';
                echo '</div>';
            ?>
        </div>
    </body>
</html>