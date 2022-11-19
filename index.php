<?php 
	include ("./objects/Database.php");
	include ("./objects/Product.php");

	// Products
	$product = new Product;
	$products = $product->getProducts();


	// QUERYS
	$queryResponse = "";
	if (isset($_GET['query'])) {
		if ($_GET['query'] == 'stock') {
			$queryResponse = $product->mostStock();
		}
		if ($_GET['query'] == 'best_selling') {
			$queryResponse = $product->bestSelling();
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Konecta | Coffe Shop</title>

	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 mx-auto w-11/12 md:w-7/12">
	<div class="flex items-center justify-between">
		<a href="./?query=best_selling" class="border border-blue-500 text-blue-500 px-3 py-2 text-xs rounded-md hover:bg-blue-500 hover:text-white">Más vendido</a>
		<div class="my-10 text-blue-500 text-center text-3xl font-bold">Konecta Coffee Shop</div>
		<a href="./?query=stock" class="border border-blue-500 text-blue-500 px-3 py-2 text-xs rounded-md hover:bg-blue-500 hover:text-white">Producto con más stock</a>
	</div>

	<?php if (!empty($queryResponse)) { ?>
		<div class="grid grid-cols-3 gap-5">
			<?php while ($response = $queryResponse->fetch_assoc()) { ?>
				<a href="./products/show.php?id=<?=$response['id'];?>" class="rounded-md p-3 hover:bg-white">
					<img src="./storage/<?=$response['id'];?>/<?=$response['url'];?>" class="w-full h-24 rounded-md shadow-md object-fit object-cover mb-1">
					<span class="flex items-center">
						<b class="text-green-500">
							<?=$response['stock'];?> unidades
						</b>
						<?php if (isset($response['quantity'])) {
							echo "<b class='text-orange-500 ml-3'>{$response["quantity"]} ventas</b>";
						} ?>
					</span>
					<div class="font-semibold text-gray-400"><?=$response['name'];?></div>
				</a>
				<?php
			} ?>
		</div>

		<div class="flex justify-end">
			<a href="./" class="text-green-500 border border-green-500 rounded-md px-3 py-1 hover:text-white hover:bg-green-500">Limpiar consulta</a>
		</div>
		<hr class="my-5">
		<?php
	} ?>

	<div class="bg-white rounded-md shadow-md p-5">
		<div class="flex items-center justify-between mb-10">
			<div class="text-gray-400 text-xl"><?php
				if (isset($products->num_rows))
					echo $products->num_rows;
				else
					echo "0";
				?> productos encontrados</div>
			<a href="./products/create.php" class="bg-blue-400 hover:bg-blue-500 text-white rounded-md px-7 py-2 font-semibold">Crear producto</a>
		</div>
		<?php
		if ($products) { ?>
			<div class="grid grid-cols-4 gap-5">
				<?php
				while ($product = $products->fetch_assoc()) { ?>
					<a href="./products/show.php?id=<?=$product['id'];?>" class="shadow-md rounded-md p-3">
						<img src="./storage/<?=$product['id'];?>/<?=$product['url'];?>" class="w-full h-32 rounded-md shadow-md object-fit object-cover mb-3">
						<?php if ($product['stock'] == 0) {
							echo '<small class="bg-red-500 text-white px-1 rounded-md">Agotado</small>';
						} ?>
						<div class="text-gray-500">$<?=number_format((INT) $product['price']);?></div>
						<div class="font-semibold"><?=$product['name'];?></div>
					</a><?php
				} ?>
			</div><?php
		}
		else { ?>
			<div class="bg-indigo-500 text-white p-5 rounded-md">
				<b>No hay productos</b>
				<p>Pero puedes comenzar a crearlos presionando el botón "Crear producto".</p>
			</div>
			<?php
		}
		?>
	</div>


	<div class="my-5 text-gray-400 text-xs text-center">
		Desarrollado y diseñado por Carlos Rodriguez para Konecta | 19 de noviembre del 2022
	</div>
</body>
</html>