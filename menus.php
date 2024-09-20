<?php
// get all categories for menu/navigation
$stmt = $con->prepare("SELECT * FROM categories WHERE status=1");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">
<li class="nav-item active">
<a class="nav-link text-white" href="./index.php">Home<span class="sr-only">(current)</span></a>
</li>

<li class="nav-item active">
<a class="nav-link text-white" href="./products.php">All Products<span class="sr-only">(current)</span></a>
</li>

<?php foreach ($categories as $category) { ?>
<li class="nav-item text-white">
<a class="nav-link text-white" href="products.php?category_id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
</li>
<?php } ?>
</ul>
</div>
</nav>