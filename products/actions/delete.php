<?php

include ("../../objects/Database.php");
include ("../../objects/Product.php");
$product = new Product;

$idproduct = htmlspecialchars((INT) $_GET['id']);
$response  = $product->deleteProduct($idproduct);

if ($response)
	header("Location: ../../");
else
	die("Hubo un error interno...");
