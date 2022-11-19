<?php

include ("../../objects/Database.php");
include ("../../objects/Product.php");
$product = new Product;

$idproduct   = htmlspecialchars((INT) $_POST['idproduct']);
$name        = htmlspecialchars($_POST['name']);
$description = htmlspecialchars($_POST['description']);
$reference   = htmlspecialchars($_POST['reference']);
$price       = htmlspecialchars($_POST['price']);
$weight      = htmlspecialchars($_POST['weight']);
$category    = htmlspecialchars($_POST['category']);
$stock       = htmlspecialchars($_POST['stock']);

$images = "";
if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
	$images = $_FILES['images'];
}

$response = $product->updateProduct($idproduct, $name, $description, $reference, $price, $weight, $category, $stock, $images);

if ($response)
	header("Location: ../show.php?id={$idproduct}");
else
	die("Hubo un error interno...");
