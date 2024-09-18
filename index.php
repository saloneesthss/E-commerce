<?php
require_once "../logincheck.php";

$stmt=$con->prepare("SELECT * FROM categories where status=1");
$stmt->execute();
$categories=$stmt->fetch_all(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Swastik Ecommerce</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <!-- <h1>Swastik Ecommerce</h1> -->
        <div class="row">
            <div class="col-md-12">
                <h1>Swastik E-commerce</h1>
            </div>
        </div>
        <?php require_once "./menus.php" ?>
        <div class="navbar navbar-expand-lg navbar-light bg-primary">
            <div></div>
        </div>
    </div>
</body>
</html>