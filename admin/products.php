<?php
require_once "logincheck.php";
require_once "../connection.php";

$sql="SELECT categories.name as category_name, products.* FROM products INNER JOIN categories ON categories.id=products.category_id";
$stmtProduct=$con->prepare($sql);
$stmtProduct->execute();
$products=$stmtProduct->fetchAll(PDO::FETCH_ASSOC);
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
            <h2>Products</h2>
            <div class="card">
                <div class="card-header">
                    Products Listing
                    <a href="addproduct.php" class="btn btn-primary">Add New</a>
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
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($products as $product) {
                            ?>
                            <tr>
                                <td><?php echo $product['id'];?></td>
                                <td><?php echo $product['sku'];?></td>
                                <td><?php echo $product['name'];?></td>
                                <td><?php echo $product['category_name'];?></td>
                                <td><?php echo number_format($product['price'],2);?></td>
                                <td>
                                    <?php if (!empty($product['image_name']) && file_exists('../product_images/' . $product['image_name'])) { ?>
                                        <img width="100" src="../product_images/<?php echo $product['image_name']; ?>" alt="">
                                    <?php } ?>
                                </td>
                                <td><?php echo $product['status']==1?'Active':'Inactive';?></td>
                                <td>
                                    <a class="btn btn-primary" href="editproduct.php?id=<?php echo $product['id']; ?>">Edit</a> 
                                    <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this product?')"
                                    href="deleteproduct.php?id=<?php echo $product['id']; ?>">Delete</a>
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