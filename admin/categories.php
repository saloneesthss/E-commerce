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
                    Category Listing
                    <a href="addcategory.php" class="btn btn-primary">Add New</a>
                </div>
                <div class="card-body p-0">
                    <?php if(isset($_GET['error'])) { ?>
                    <div class="alert alert-danger">
                        <?php echo $_GET['error']; ?>
                    </div>
                    <?php } ?>
                    <?php if(isset($_GET['success'])) { ?>
                    <div class="alert alert-success">
                        <?php echo $_GET['success']; ?>
                    </div>
                    <?php } ?>

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
                                <td>
                                    <a href="editcategory.php?id=<?php echo $category['id']; ?>">Edit</a> |
                                    <a onclick="return confirm('Are you sure to delete this category?')"
                                    href="deletecategory.php?id=<?php echo $category['id']; ?>">Delete</a>
                                </td>
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