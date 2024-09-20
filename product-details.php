<?php
require_once "./connection.php";

// get all the latest/new products (3)
$categoryId = (int) $_GET['category_id'];
if (empty($categoryId)) {
echo "Invalid category, please choose category first.";
die;
}
$sql = "SELECT
categories.name as category_name,
products.*
FROM products
INNER JOIN categories ON categories.id=products.category_id
WHERE products.category_id=$categoryId
ORDER BY products.id DESC";

$stmt = $con->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Swastik Ecommerce</title>
<link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<h1>Swastik Ecommerce</h1>
</div>
</div>

<?php require_once("menus.php"); ?>

<div class="card">
<div class="card-header">Products</div>
<div class="card-body">
<div class="row">
<?php foreach ($products as $product) { ?>
<div class="col-md-3">
<h4><?php echo $product['name']; ?></h4>
<br>
<?php echo $product['category_name']; ?>
<?php if (!empty($product['image_name']) && file_exists('./product_images/' . $product['image_name'])) { ?>
<img class="img-thumbnail" src="./product_images/<?php echo $product['image_name']; ?>" alt="">
<?php } ?>
<p>
Price: Rs. <?php echo number_format($product['price'], 2); ?>
</p>
<a class="btn btn-primary" href="">View More</a>
</div>
<?php } ?>
</div>
</div>
</div>
</div>
</body>

</html>