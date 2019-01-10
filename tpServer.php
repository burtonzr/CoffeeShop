<?php
    session_start();
    error_reporting(E_ERROR | E_PARSE);
    // initalizing variables
    $customerFirstName = "";
    $customerLastName = "";
    $email = "";
    $address = "";
    $city = "";
    $state = "";
    $username = "";
    $origin = "";
    $shop = "";
    $orderedDate = "";
    $shippedDate = "";
    $comments = "";
    $phone = "";
    $quantityOrdered = 0;
    $priceEach = 0;
    //$totalPrice = 0;
    $errors = array();
    // connect to the database
    $db = mysqli_connect('localhost', 'root', 'Biketowork!11', 'coffeeshop') or die("Could not connect." . mysqli_connect_error());

    // Register User (Sign Up)
    if(isset($_POST['sign_up_button'])) {
        // mysqli_real_escape_string escapes special characters in a string for use in an SQL statement. 
        $customerFirstName = mysqli_real_escape_string($db, $_POST['customerFirstName']);
        $customerLastName = mysqli_real_escape_string($db, $_POST['customerLastName']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $city = mysqli_real_escape_string($db, $_POST['city']);
        $state = mysqli_real_escape_string($db, $_POST['state']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password1 = mysqli_real_escape_string($db, $_POST['password1']);
        $password2 = mysqli_real_escape_string($db, $_POST['password2']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        
        // form validation: ensure that the form is correctly filled out. 
        // by adding array_push(), corresponding errors go into $errors array
        if(empty($customerFirstName)) {
            array_push($errors, "First Name is required!");
        }
        if(empty($customerLastName)) {
            array_push($errors, "Last name is required!");
        }
        if(empty($email)) {
            array_push($errors, "Email is required!");
        }
        if(empty($address)) {
            array_push($errors, "Address is required!");
        }
        if(empty($city)) {
            array_push($errors, "City is required!");
        }
        if(empty($state)) {
            array_push($errors, "State is required!");
        }
        if(empty($username)) {
            array_push($errors, "Username is required!");
        }
        if(empty($password1)) {
            array_push($errors, "Password is required!");
        }
        if(empty($phone)) {
            array_push($errors, "Phone number is required. ");
        }
        if($password1 != $password2) {
            array_push($errors, "The two passwords do not match. ");
        }
        
        // first check the database to make sure a user does not already 
        // exists with the same username and / or email
        $user_check_query = "SELECT username, email FROM customers WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $customer = mysqli_fetch_assoc($result);

        if($customer) {
            // if customer exists
            if($customer['username'] === $username) {
                array_push($errors, "Username already exists!");
            }
            if($customer['email'] === $email) {
                array_push($errors, "Email already exists!");
            }
        }

        // Finally, register user if there are no errors in the form
        if(count($errors) == 0) {
            $password = md5($password1); 
            // encrpyt the password before saving in the database
            $query = "INSERT INTO customers (customerFirstName, customerLastName, phone, address, city, state, username, password, email) 
                VALUES('$customerFirstName', '$customerLastName', '$phone', '$address', '$city', '$state', '$username', '$password', '$email')";

            mysqli_query($db, $query);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now signed up!";
            header('location: tpLogin.php');
        } else {
            array_push($errors, "Information is wrong. Customer can't be added.");
        }
    }

    // Customer Orders Form
    if(isset($_POST['order_button'])) {
        $origin = mysqli_real_escape_string($db, $_POST['origin']);
        $shop = mysqli_real_escape_string($db, $_POST['shop']);
        $quantityOrdered = mysqli_real_escape_string($db, $_POST['quantityOrdered']);
        $shippedDate = mysqli_real_escape_string($db, $_POST['shippedDate']);
        $orderedDate = mysqli_real_escape_string($db, $_POST['orderedDate']);
        $comments = mysqli_real_escape_string($db, $_POST['comments']);

        if(empty($origin)) {
            array_push($errors, "Coffee origin is required. ");
        }
        if(empty($shop)) {
            array_push($errors, "Coffee shop location is required. ");
        }
        if(empty($quantityOrdered)) {
            array_push($errors, "Coffee quantity in bags is required. ");
        }
        if(empty($orderedDate)) {
            array_push($errors, "Ordered date is required. ");
        }
        if(empty($shippedDate)) {
            array_push($errors, "Shipped date is required. You can make it the same as the ordered date for fast shipping. ");
        }

        if(count($errors) == 0) {
            $origin = $_POST['origin'];
            $productID = $_POST['origin'];
            $customerID = $_SESSION['customerID'];
            //$quantityOrdered = $_POST['quantityOrdered'];
            //$quantityOrdered = $_SESSION['quantityOrdered'];
            //$orderedDate = "SELECT NOW()";
            //$queryOrderedDate = mysqli_query($db, $orderedDate);
            
            $sql = "SELECT price FROM products WHERE productID = $productID";
            $price = mysqli_query($db, $sql);
            $result = mysqli_fetch_array($price);
            $price = $result['price'];
            
            $totalPrice = $result['price'] * $quantityOrdered;
            
            $query = "INSERT INTO customerorders (orderDate, shippedDate, comments, productID, quantityOrdered, price, customerID, totalPrice) VALUES ('$orderedDate', '$shippedDate', '$comments', $productID, $quantityOrdered, $price, $customerID, $totalPrice)";
            mysqli_query($db, $query);
            $orderID = mysqli_insert_id($db); 
            header('location: tpPaymentCustomer.php?order=' . $orderID);
        } else {
            array_push($errors, "Order did not process.");
            header('location: tpCustomerOrder.php');
        }
    }

    
    // Employee Orders Form
    if(isset($_POST['order_button2'])) {
        $origin = mysqli_real_escape_string($db, $_POST['origin']);
        $shop = mysqli_real_escape_string($db, $_POST['shop']);
        $quantityOrdered = mysqli_real_escape_string($db, $_POST['quantityOrdered']);
        $shippedDate = mysqli_real_escape_string($db, $_POST['shippedDate']);
        $orderedDate = mysqli_real_escape_string($db, $_POST['orderedDate']);
        $comments = mysqli_real_escape_string($db, $_POST['comments']);
        
        if(empty($origin)) {
            array_push($errors, "Coffee origin is required. ");
        }
        if(empty($shop)) {
            array_push($errors, "Coffee shop location is required. ");
        }
        if(empty($quantityOrdered)) {
            array_push($errors, "Coffee quantity in bags is required. ");
        }
        if(empty($orderedDate)) {
            array_push($errors, "Ordered date is required.");
        }
        if(empty($shippedDate)) {
            array_push($errors, "Shipped date is required. You can make it the same as the ordered date for fast shipping. ");
        }
        
        if(count($errors) == 0) {
            $origin = $_POST['origin'];
            $productID = $_POST['origin'];
            $employeeID = $_SESSION['employeeID'];
            
            $sql = "SELECT price FROM products WHERE productID = $productID";
            $query = mysqli_query($db, $sql);
            $result1 = mysqli_fetch_array($query);
            $price = $result1['price'];
            
            $totalPrice = $result1['price'] * $quantityOrdered;
            //$quantityOrdered = $_POST['quantityOrdered'];
            /*
            $now = "SELECT NOW()";
            $queryNow = mysqli_query($db, $now);
            $resultNow = mysqli_fetch_array($queryNow);
            //echo $resultNow;
            $addDate = "SELECT ADDDATE(NOW(), 2)";
            $queryAddDate = mysqli_query($db, $addDate);
            $resultAddDate = mysqli_fetch_array($db, $queryAddDate);
            */
            
            //$currentDate = date('Y/M/D');
            
            $query3 = "INSERT INTO employeeorders (orderDate, shippedDate, comments, productID, quantityOrdered, priceEach, employeeID , totalPrice) VALUES ('$orderedDate', '$shippedDate', '$comments', $productID, $quantityOrdered, $price, $employeeID, $totalPrice)";
            mysqli_query($db, $query3);
            //var_dump($query3);
            //$orderID = mysqli_insert_id($db); 
            //header('location: tpPayment.php?order=' . $orderID);
            header('location: tpPayment.php');
        } else {
            array_push($errors, "Order did not process. ");
            header('location: tpEmployeeOrder.php');
        }
    }
//INSERT INTO TestTable (orderedDate, shippedDate) VALUES (NOW(), ADDDATE(NOW(), 2));
?>


