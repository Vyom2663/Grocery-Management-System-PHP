<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee | GMS</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/employee.css">

</head>

<body>

    <?php require 'employee_header.php'; ?>

    <section class="dashboard">

        <h1 class="title">dashboard</h1>

        <div class="box-container">

            <div class="box">
                <?php
                $total_pendings = 0;
                $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                $select_pendings->execute(['pending']);
                while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
                    $total_pendings += $fetch_pendings['total_price'];
                };
                ?>
                <h3>$<?= $total_pendings; ?>/-</h3>
                <p>total pendings</p>
                <a href="employee_orders.php" class="btn">see orders</a>
            </div>

            <div class="box">
                <?php
                $total_completed = 0;
                $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                $select_completed->execute(['completed']);
                while ($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)) {
                    $total_completed += $fetch_completed['total_price'];
                };
                ?>
                <h3>$<?= $total_completed; ?>/-</h3>
                <p>completed orders</p>
                <a href="employee_orders.php" class="btn">see orders</a>
            </div>

            <div class="box">
                <?php
                $select_orders = $conn->prepare("SELECT * FROM `orders`");
                $select_orders->execute();
                $number_of_orders = $select_orders->rowCount();
                ?>
                <h3><?= $number_of_orders; ?></h3>
                <p>orders placed</p>
                <a href="employee_orders.php" class="btn">see orders</a>
            </div>



        </div>

    </section>






    <script src="js/script.js"></script>

</body>

</html>