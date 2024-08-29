<?php
session_start();

require_once "../connection.php";

if($_SERVER['REQUEST_METHOD']==='POST') {
    //handle login submit
    $username=$_POST['username'];
    $pwd=$_POST['pwd'];
    
    $sql="select * from users where username='$username' and password='$pwd'";
    $loginStmt=$con->prepare($sql);
    $loginStmt->execute();

    $loginUser=$loginStmt->fetch(PDO::FETCH_ASSOC);
    if ($loginUser) {
        $_SESSION['user_login']=true;
        $_SESSION['username']=$loginUser['username'];
        $_SESSION['userid']=$loginUser['id'];  //stores user id in session
        header("Location:index.php");
        die;
    } else {
        header("Location: loginform.php?error=Your entered credintials do not match our records.");
        die;
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
        
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger">
                <?php echo $_GET['error']; ?>
            </div>
        <?php } ?>

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