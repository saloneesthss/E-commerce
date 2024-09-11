<?php
require_once "./logincheck.php";

if (!isset($_GET['id'])) {
    header("Location: categories.php?error=No category found with the given ID.");
    die;
}

$id=(int) $_GET['id'];

$sql="delete from `categories` where id=$id";
$stmt=$con->prepare($sql);
$stmt->execute();

header("Location:categories.php?success=Selected category is deleted successfully.");
die;
