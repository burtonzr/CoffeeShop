<?php
    include('bootstrapCode.html');
    include('tpServer.php');
    if(!isset($_SESSION['employeeID'])) {
        header('location: tpEmployeeLogin.php');
    }
    $productID = 0;
    $productName = "";
    $originDescription = "";
    $quantityInStock = 0;
    $price = 0;
    //$image = "";
    $errors = array();

    // connect to the database
    $db = mysqli_connect('localhost', 'root', 'Biketowork!11', 'coffeeshop') or die("Could not connect." . mysqli_connect_error());
    $target_dir = "WWW/ServerSideProgrammingUCM/TeamProject/";
    $uploadOk = 1;

    if(isset($_POST['addProductButton'])) {
        $productID = mysqli_real_escape_string($db, $_POST['productID']);
        $productName = mysqli_real_escape_string($db, $_POST['productName']);
        $originDescription = mysqli_real_escape_string($db, $_POST['originDescription']);
        $quantityInStock = mysqli_real_escape_string($db, $_POST['quantityInStock']);
        $price = mysqli_real_escape_string($db, $_POST['price']);
        
        
        if(empty($productID)) {
            array_push($errors, "Product ID is required. ");
        }
        if(empty($productName)) {
            array_push($errors, "Product name is required. ");
        }
        if(empty($quantityInStock)) {
            array_push($errors, "Quantity in stock for sale is required. ");
        }
        if(empty($price)) {
            array_push($errors, "Price is required. ");
        }
        
        $product_check_query = "SELECT productID, productName FROM products WHERE productID = '$productID' OR productName = '$productName'";
        $result = mysqli_query($db, $product_check_query);
        $product = mysqli_fetch_array($result);
        
        if($product) {
            if($product['productID'] === $productID) {
                array_push($errors, "That product ID already exists. ");
            }
            if($product['productName'] === $productID) {
                array_push($errors, "That product name alreayd exists. ");
            }
        }
        
        if(count($errors) == 0) {
            //$target_file = $target_dir . basename($_FILES["filesToUpload"]["name"]);
            $file = $_FILES['filesToUpload']['name'];
            if(empty($file)) {
                array_push($errors, "Image is required.");
            }
            $target_file = $target_dir . $file;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            //$image = addslashes(file_get_contents($_FILES['image']));
            // check if image file is a actual image or fake image
            $check = getimagesize($_FILES['filesToUpload']["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            //Check if file already exists
            if(file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            //Allow certain files types
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
                $uploadOk = 0;
            }
            $query = "INSERT INTO products (productID, productName, originDescription, quantityInStock, price, image) VALUES ($productID, '$productName', '$originDescription', $quantityInStock, $price, '$file')";
            if(mysqli_query($db, $query)) {
                header('Location: tpThankYou.php');
            }
        }
    }
?>
<div class="jumbotron">
    <h1 class="text-center">Add Coffee Origin / Roast</h1>
</div>
<div class="container">
    <p><strong>
        <?php 
            //echo $_SESSION['employeeID'];
            echo $_SESSION['employeeName'];
        ?>
    </strong></p>
    <p> <a href="logout.php" style="color: red;text-decoration: none;" name="logout">Logout</a> </p>
    <form method="post" action="AddProduct.php" enctype="multipart/form-data">
        <?php include('tpErrors.php') ?>
        <div class="row pt-2">
            <div class="col-6">
                <h3>Product ID</h3>
                <input type="text" class="form-control" name="productID" value="<?php echo $productID ?>" required/>
            </div>
            <div class="col-6">
                <h3>Product Name</h3>
                <input type="text" class="form-control" name="productName" value="<?php echo $productName; ?>" required/>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-6">
                <h3>Coffee Origin Description</h3>
                <input type="text" class="form-control" name="originDescription" value="<?php echo $originDescription; ?>" />
            </div>
            <div class="col-6">
                <h3>Image</h3>
                <input type="file" class="form-control" name="filesToUpload" id="filesToUpload" required/>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-6">
                <h3>How many are available for sale?</h3>
                <input type="text" class="form-control" name="quantityInStock" value="<?php echo $quantityInStock ?>" required/>
            </div>
            <div class="col-6">
                <h3>Price</h3>
                <input type="text" class="form-control" name="price" value="<?php echo $price; ?>" required/>
            </div>
        </div>
        <button class="mt-3 mb-3 btn btn-default" type="submit" name="addProductButton">Submit</button>
    </form>
    <p>
        <a href="tpEmployeeOptions2.php" style="text-decoration: none">Go back to Employee Option</a>
    </p>
</div>
<script>
    $(document).ready(function() {
        $('#addProductButton').click(function() {
            var image_name = $('#image').val();
            if(image_name == '') {
                alert("Please insert image. ");
                return false;
            } else {
                var extension = $('#image').val().split('.').pop().toLowerCase();
                if(jQuery.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                    alert("Invalid Image File");
                    $('#image').val();
                    return false;
                }
            }
        });
    });
</script>