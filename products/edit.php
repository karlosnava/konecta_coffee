<?php 
	include ("../objects/Database.php");
	include ("../objects/Product.php");

	// Product
	$product = new Product;
	$prod = $product->getProduct((INT) $_GET['id'])->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar producto | Konecta Coffee Shop</title>

	<link rel="stylesheet" href="../styles/global.css">
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="./js/create_functions.js" defer></script>
</head>
<body class="bg-gray-100 mx-auto w-11/12 md:w-7/12">
	<div class="flex items-center justify-between">
		<a href="../" class="bg-blue-400 hover:bg-blue-500 text-white rounded-md px-7 py-2 font-semibold">Regresar</a>
		<div class="my-10 text-blue-500 text-center text-3xl font-bold">Editar producto | Konecta Coffee Shop</div>
	</div>

	<div class="bg-white rounded-md shadow-md p-5">
		<form action="./actions/update.php" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="idproduct" value="<?=$prod['id'];?>">

			<div class="mb-3">
				<label for="inp" class="inp">
					<input type="text" name="name" value="<?=$prod['name'];?>" placeholder="&nbsp;">
					<span class="label">Nombre del producto</span>
					<span class="focus-bg"></span>
				</label>
			</div>
			<div>
				<label for="inp" class="inp">
					<input type="text" name="description" value="<?=$prod['description'];?>" placeholder="&nbsp;">
					<span class="label">Descripción</span>
					<span class="focus-bg"></span>
				</label>
			</div>

			<div class="grid grid-cols-3 gap-3 my-3">
				<div>
					<label for="inp" class="inp">
						<input type="text" name="reference" value="<?=$prod['reference'];?>" placeholder="&nbsp;">
						<span class="label">Referencia</span>
						<span class="focus-bg"></span>
					</label>
				</div>
				<div>
					<label for="inp" class="inp">
						<input type="text" name="price" value="<?=$prod['price'];?>" onkeypress="return onlyNumberKey(event)" placeholder="&nbsp;">
						<span class="label">Precio</span>
						<span class="focus-bg"></span>
					</label>
				</div>
				<div>
					<label for="inp" class="inp">
						<input type="text" name="weight" value="<?=$prod['weight'];?>" onkeypress="return onlyNumberKey(event)" placeholder="&nbsp;">
						<span class="label">Peso (kg)</span>
						<span class="focus-bg"></span>
					</label>
				</div>
			</div>

			<div class="grid grid-cols-2 gap-3">
				<div>
					<label for="inp" class="inp">
						<input type="text" name="category" value="<?=$prod['category'];?>" placeholder="&nbsp;">
						<span class="label">Categoría</span>
						<span class="focus-bg"></span>
					</label>
				</div>
				<div>
					<label for="inp" class="inp">
						<input type="text" name="stock" value="<?=$prod['stock'];?>" onkeypress="return onlyNumberKey(event)" placeholder="&nbsp;">
						<span class="label">Stock</span>
						<span class="focus-bg"></span>
					</label>
				</div>
			</div>

			<div class="my-3">
				<input id="files" type="file" name="images[]" accept="image/*">
			</div>

			<div class="flex items-center justify-between mt-5">
				<a href="./actions/delete.php?id=<?=$prod['id'];?>" class="text-red-400 text-xs">Eliminar producto</a>
				<button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white rounded-md px-7 py-2 font-bold">Actualizar producto</button>
			</div>

			<div class="grid grid-cols-5 gap-3 mt-5" id="preview"></div>
		</form>
	</div>

	<div class="my-5 text-gray-400 text-xs text-center">
		Desarrollado y diseñado por Carlos Rodriguez para Konecta | 19 de noviembre del 2022
	</div>
</body>
</html>