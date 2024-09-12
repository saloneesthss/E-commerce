<?php
require_once "./logincheck.php";

$stmtProduct=$con->prepare("select * from categories");
$stmtProduct->execute();
$categories=$stmtProduct->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD']==='POST') {
    //handle login submit
    $sku=$_POST['sku'];
    $name=$_POST['name'];
    $price=$_POST['price'];
    $category_id=$_POST['category_id'];
    $description=$_POST['description'];
    $status=$_POST['status'];
    
    $sql="insert into products set 
    sku='$sku', 
    name='$name', 
    price='$price', 
    category_id='$category_id', 
    description='$description', 
    status='$status'";
    $catStmt=$con->prepare($sql);
    $catStmt->execute();

    //redirect the user to product
    header("Location:products.php?success=Product added successfully.");
    die;
}
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
                    Add New Product
                    <a href="addproduct.php" class="btn btn-primary">Add New</a>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="sku">SKU:</label>
                            <input type="text" class="form-control" name="sku" id="sku">
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category:</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo $category['name']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" min="0" class="form-control" name="price" id="price">
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" accept=".jpg,.jpeg,.png" class="form-control" name="image" id="image">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="products.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>

        <div class="footer">
            Copyright @ Swastik Ecommerce
        </div>
    </div>
</body>
</html>