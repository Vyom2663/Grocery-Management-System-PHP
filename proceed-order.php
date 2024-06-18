<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceed Order</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/employee.css">

</head>

<body>

    <?php include 'employee_header.php'; ?>

    <section class="placed-orders">

        <h1 class="title">proceed order</h1>

        <div class="box-container">

            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            if ($select_orders->rowCount() > 0) {
                while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box">
                        <p> user id : <span><?= $fetch_orders['user_id']; ?></span> </p>
                        <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
                        <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
                        <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
                        
                        
                        <label style="font-size: 18px; color: green">OTP : 
                        <input type="text" placeholder="Enter here" style="border-bottom: 2px solid green;" maxlength="6">
                        </label>

                        <form action="proceed-order.php" method="POST">
                            <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">

                            <div class="flex-btn">
                                <input type="submit" name="update_order" class="option-btn" value="Resend OTP">
                            </div>
                            <div class="flex-btn">
                                <input type="submit" name="update_order" class="btn" value="Done">
                            </div>
                            
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no orders placed yet!</p>';
            }
            ?>

        </div>

    </section>












    <script src="js/script.js"></script>

</body>

</html>