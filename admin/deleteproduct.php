<?php
require_once "./logincheck.php";

if (!isset($_GET['id'])) {
    header("Location: products.php?error=No product found with the given ID.");
    die;
}

$id=(int) $_GET['id'];

$sql="delete from `products` where id=$id";
$stmt=$con->prepare($sql);
$stmt->execute();

header("Location:products.php?success=Selected product is deleted successfully.");
die;
