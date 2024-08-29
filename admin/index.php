<?php
session_start();

if (!isset($_SESSION['user_login'])) {
    header("Location:loginform.php?error=You are not logged in, please login first." );
    die;
}

require_once "../connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administrative Panel - Swastik Ecommerce</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to administrative panel of Swastik Ecommerce.</h1>
        <p>Hello <?php echo $_SESSION['username']; ?> </p>
        <a onclick="return confirm('Are you sure to logout?');" href="logout.php">Logout</a>
    </div>
</body>
</html>