<?php
require_once "./logincheck.php";

if (!isset($_GET['id'])) {
    header("Location:products.php?error=Please provide a valid ID for the product.");
    die;
}
$id=(int) $_GET['id'];

$sql="select * from `products` where id=$id";
$stmt=$con->prepare($sql);
$stmt->execute();
$product=$stmt->fetch(PDO::FETCH_ASSOC);
if(!$product) {
    header("Location:products.php?error=No product found with the given ID.");
    die;
}
// print_r($product);
// die;

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
    
    $sql="update products set sku='$sku', 
    name='$name', 
    price='$price', 
    category_id='$category_id', 
    description='$description', 
    status='$status' where id=$id";
    $catStmt=$con->prepare($sql);
    $catStmt->execute();

    //redirect the user to product listing page
    header("Location:products.php?success=Product updated successfully.");
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
                    Edit Product
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="sku">SKU:</label>
                            <input type="text" required
                            value="<?php echo $product['sku'] ?>"
                            class="form-control" 
                            name="sku" 
                            id="sku">
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" 
                            value="<?php echo $product['name'] ?>"
                            class="form-control" 
                            name="name" 
                            id="name">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category:</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option <?php echo $product['category_id']==$category['id']?'selected':'';?> value="<?php echo $category['id']; ?>">
                                        <?php echo $category['name']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" 
                            value="<?php echo $product['price'] ?>"
                            class="form-control" 
                            name="price" 
                            id="price">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" 
                            id="description" 
                            rows="5" 
                            class="form-control"> <?php echo $product['description'] ?> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Select Status</option>
                                <option <?php echo $product['status']==1?'selected':'';?> value="1">Active</option>
                                <option <?php echo $product['status']==0?'selected':'';?> value="0">Inactive</option>
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