<?php
    include('bootstrapCode.html');
    include('tpServer.php');
?>
<div class="jumbotron">
    <h1 class="text-center">Thank You</h1>
</div>
<div class="container">
    <p class="text-center">Thank you, 
        <strong>
        <?php 
            //echo $_SESSION['employeeID'];
            echo $_SESSION['employeeName'];
        ?>
        </strong>, for your submission and for improving Bean Boox. 
    </p>
    <p>
        <a href="tpEmployeeOptions2.php" style="text-decoration: none">Go back to Employee Option</a>
    </p>
    <p class="pt-4">
        <a href="logout.php" style="text-decoration: none;color: red">Logout</a>
    </p>
</div>