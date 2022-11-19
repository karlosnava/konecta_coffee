<?php

include ("../../objects/Database.php");
include ("../../objects/Purchase.php");
$purchase = new Purchase;

$idproduct = htmlspecialchars($_POST['idproduct']);
$name      = htmlspecialchars($_POST['name']);
$quantity  = htmlspecialchars($_POST['quantity']);


$stock = $purchase->checkAvailability($idproduct)->fetch_assoc()['stock'];

if ($quantity <= $stock) {
	$response = $purchase->setPurchase($idproduct, $name, $quantity);

	if ($response)
		header("Location: ../show.php?id={$idproduct}&response=success");
	else
		die("Hubo un error interno...");
}
else {
	header("Location: ../show.php?id={$idproduct}&response=sold_out");
}
