<?php

include ("../../objects/Database.php");
include ("../../objects/Product.php");
$product = new Product;

$name        = htmlspecialchars($_POST['name']);
$description = htmlspecialchars($_POST['description']);
$reference   = htmlspecialchars($_POST['reference']);
$price       = htmlspecialchars($_POST['price']);
$weight      = htmlspecialchars($_POST['weight']);
$category    = htmlspecialchars($_POST['category']);
$stock       = htmlspecialchars($_POST['stock']);
$images      = $_FILES['images'];

$response = $product->setProduct($name, $description, $reference, $price, $weight, $category, $stock, $images);

if ($response)
	header("Location: ../../");
else
	die("Hubo un error interno...");
