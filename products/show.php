<?php 
	include ("../objects/Database.php");
	include ("../objects/Product.php");
	include ("../objects/Helpers.php");

	$helpers = new Helpers;

	// Product
	$product   = new Product;
	$prod      = $product->getProduct((INT) $_GET['id'])->fetch_assoc();
	$purchases = $product->getPurchases((INT) $_GET['id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=$prod['name'];?> | Konecta Coffee Shop</title>

	<link rel="stylesheet" href="../styles/global.css">
	<script src="./js/show_functions.js" defer></script>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 mx-auto pb-16 w-11/12 md:w-7/12">
	<div class="flex items-center justify-between my-10">
		
		<a href="../" class="bg-blue-400 hover:bg-blue-500 text-white rounded-md px-7 py-2 font-semibold">Regresar</a>
		<div class="text-blue-500 text-center text-3xl font-bold">Konecta Coffee Shop</div>
		<a href="./edit.php?id=<?=$prod['id'];?>" class="bg-blue-400 hover:bg-blue-500 text-white rounded-md px-7 py-2 font-semibold">Editar</a>
	</div>

	<div class="bg-white rounded-md shadow-md p-5">
		<div class="grid grid-cols-2 gap-10">
			<div>
				<img src="../storage/<?=$prod['id'];?>/<?=$prod['url'];?>" class="w-full h-80 rounded-md shadow-md object-fit object-cover mb-3">

				<?php if (!empty($purchases)) { ?>
					<div class="font-semibold text-gray-400">Compras</div>
					<hr class="my-3">
					<?php
					while ($purchase = $purchases->fetch_assoc()) { ?>
						<div class="w-full shadow-md mb-3 rounded-md px-4 py-2">
							<div class="text-gray-400 text-xs"><?=$helpers->time_passed($purchase['created_at']);?></div>
							<div class="flex items-center justify-between">
								<?=$purchase['name'];?>
								<small class="bg-green-500 text-white rounded-md p-2">-<?=$purchase['quantity'];?></small>
							</div>
						</div><?php

					}
				} ?>
			</div>
			<div>
				<?php
				if (isset($_GET['response'])) {
					if ($_GET['response'] == 'sold_out') { ?>
						<div class="w-100 bg-orange-500 rounded-md text-white p-5 mb-5">
							<b>No puede ser...</b>
							<p>Estás pidiendo más productos de los que tenemos, intenta pedir un poco menos.</p>
						</div>
						<?php
					}
					if ($_GET['response'] == 'success') { ?>
						<div class="w-100 bg-green-500 rounded-md text-white p-5 mb-5">
							<b>¡HURRAAA!</b>
							<p>Tu pago se ha procesado correctamente, gracias por tu compra.</p>
						</div>
						<?php
					}
				}
				?>

				<div class="flex items-center justify-between mb-3">
					<div class="text-gray-400 text-xs">Publicado el <?=$helpers->dateLatam($prod['created_at']);?></div>

					<?php if ($prod['stock'] == 0) {
						echo '<span class="bg-red-500 text-white px-2 rounded-md">Agotado</span>';
					} ?>
				</div>

				<div class="flex items-center">
					<span class="bg-pink-500 mr-3 text-white rounded-md px-3 text-xs"><?=$prod['reference'];?></span>
					<span class="bg-indigo-500 text-white rounded-md px-3 text-xs"><?=$prod['category'];?></span>
				</div>

				<h1 class="text-3xl font-bold text-gray-700"><?=$prod['name'];?></h1>
				<div class="text-2xl text-semibold text-gray-500">$<?=number_format((INT) $prod['price']);?></div>
				<p class="my-3 text-gray-500"><?=$prod['description'];?></p>

				<form action="./actions/purchase.php" method="POST" class="w-100 border p-5 rounded-md" id="divActionButtons" style="display: none;">
					<input type="hidden" name="idproduct" value="<?=$prod['id'];?>">
					
					<div class="font-bold text-gray-600 mb-4">¡Estás a un paso!</div>
					<div class="mb-3">
						<label for="inp" class="inp">
							<input type="text" name="name" placeholder="&nbsp;" required>
							<span class="label">Nombre completo</span>
							<span class="focus-bg"></span>
						</label>
					</div>
					<div class="mb-3">
						<label for="inp" class="inp">
							<input type="text" name="quantity" placeholder="&nbsp;" required>
							<span class="label">Cantidad</span>
							<span class="focus-bg"></span>
						</label>
					</div>

					<div class="grid grid-cols-2 gap-5 mt-5">
						<button type="button" id="btnCancel" class="text-red-500 w-full py-3">Cancelar</button>
						<button type="submit" id="btnBuy" class="bg-blue-500 hover:bg-blue-600 text-white rounded-md w-full py-3 font-bold">Comprar ahora</button>
					</div>
				</form>

				<button type="button" id="btnPreBuy" class="bg-blue-500 hover:bg-blue-600 text-white rounded-md w-full py-3 font-bold mt-5">Comprar ahora</button>

				<hr class="my-5">
				<div class="grid grid-cols-2 text-gray-700">
					<div class="border p-2 font-semibold">Referencia</div>
					<div class="border p-2 "><?=$prod['reference'];?></div>

					<div class="border p-2 font-semibold">Peso</div>
					<div class="border p-2 "><?=$prod['weight'];?> kg</div>

					<div class="border p-2 font-semibold">Unidades disponibles</div>
					<div class="border p-2 "><?=$prod['stock'];?></div>
				</div>
			</div>
		</div>
	</div>

	<div class="my-5 text-gray-400 text-xs text-center">
		Desarrollado y diseñado por Carlos Rodriguez para Konecta | 19 de noviembre del 2022
	</div>
</body>
</html>