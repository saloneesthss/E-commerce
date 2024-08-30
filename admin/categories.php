<?php
require_once "logincheck.php";
require_once "../connection.php";

$stmtCategory=$con->prepare("select * from categories");
$stmtCategory->execute();
$categories=$stmtCategory->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administrative Panel - Swastik Ecommerce</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
    <div class="container">
        <p class="text-right">
            Hello <?php echo $_SESSION['username']; ?> 
            <a onclick="return confirm('Are you sure to logout?');" href="logout.php">Logout</a>
        </p>

        <?php require_once("menus.php"); ?>

        <div class="main">
            <h2>Categories</h2>
            <div class="card">
                <div class="card-header">
                    Products Listing
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($categories as $category) {
                            ?>
                            <tr>
                                <td><?php echo $category['id'];?></td>
                                <td><?php echo $category['name'];?></td>
                                <td><?php echo $category['status']==1?'Active':'Inactive';?></td>
                                <td>Edit | Delete</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="footer">
            Copyright @ Swastik Ecommerce
        </div>
    </div>
</body>
</html>