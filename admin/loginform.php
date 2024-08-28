<?php
session_start();
if($_SERVER['REQUEST_METHOD']==='POST') {
    //handle login submit
    $username=$_POST['username'];
    $pwd=$_POST['pwd'];
    if ($username==='sita' && $pwd==='sita@123') {
        echo 'Correct login.';
    } else {
        echo 'Invalid credintals.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login - Swastik Ecommerce</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <div class="row">
                <div class="col-4">
                    <label for="username">Username</label>
                </div>
                <div class="col-8">
                    <input type="text" name="username" id="username">
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label for="pwd">Password</label>
                </div>
                <div class="col-8">
                    <input type="password" name="pwd" id="pwd">
                </div>
            </div> 
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </div>            
        </form>
    </div>
</body>
</html>