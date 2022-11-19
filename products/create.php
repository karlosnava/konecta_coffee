<?php 
	include ("../objects/Database.php");
	include ("../objects/Product.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Crear producto | Konecta Coffee Shop</title>

	<link rel="stylesheet" href="../styles/global.css">
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="./js/create_functions.js" defer></script>
</head>
<body class="bg-gray-100 mx-auto w-11/12 md:w-7/12">
	<div class="flex items-center justify-between">
		<a href="../" class="bg-blue-400 hover:bg-blue-500 text-white rounded-md px-7 py-2 font-semibold">Regresar</a>
		<div class="my-10 text-blue-500 text-center text-3xl font-bold">Crear producto | Konecta Coffee Shop</div>
	</div>

	<div class="bg-white rounded-md shadow-md p-5">
		<form action="./actions/store.php" method="POST" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="inp" class="inp">
					<input type="text" name="name" placeholder="&nbsp;" required>
					<span class="label">Nombre del producto</span>
					<span class="focus-bg"></span>
				</label>
			</div>
			<div>
				<label for="inp" class="inp">
					<input type="text" name="description" placeholder="&nbsp;" required>
					<span class="label">Descripción</span>
					<span class="focus-bg"></span>
				</label>
			</div>

			<div class="grid grid-cols-3 gap-3 my-3">
				<div>
					<label for="inp" class="inp">
						<input type="text" name="reference" placeholder="&nbsp;" required>
						<span class="label">Referencia</span>
						<span class="focus-bg"></span>
					</label>
				</div>
				<div>
					<label for="inp" class="inp">
						<input type="text" name="price" placeholder="&nbsp;" onkeypress="return onlyNumberKey(event)" required>
						<span class="label">Precio</span>
						<span class="focus-bg"></span>
					</label>
				</div>
				<div>
					<label for="inp" class="inp">
						<input type="text" name="weight" placeholder="&nbsp;" onkeypress="return onlyNumberKey(event)" required>
						<span class="label">Peso (kg)</span>
						<span class="focus-bg"></span>
					</label>
				</div>
			</div>

			<div class="grid grid-cols-2 gap-3">
				<div>
					<label for="inp" class="inp">
						<input type="text" name="category" placeholder="&nbsp;" required>
						<span class="label">Categoría</span>
						<span class="focus-bg"></span>
					</label>
				</div>
				<div>
					<label for="inp" class="inp">
						<input type="text" name="stock" placeholder="&nbsp;" onkeypress="return onlyNumberKey(event)" required>
						<span class="label">Stock</span>
						<span class="focus-bg"></span>
					</label>
				</div>
			</div>

			<div class="flex items-center justify-between mt-5">
				<input id="files" type="file" name="images[]" accept="image/*" required>
				<button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white rounded-md px-7 py-2 font-bold">Crear producto</button>
			</div>
		</form>
		<hr class="my-3">
		<div class="grid grid-cols-5 gap-3 mt-5" id="preview"></div>

	</div>

	<div class="my-5 text-gray-400 text-xs text-center">
		Desarrollado y diseñado por Carlos Rodriguez para Konecta | 19 de noviembre del 2022
	</div>
</body>
</html>