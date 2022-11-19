<?php

class Product extends Database
{
	public function setProduct($name, $description, $reference, $price, $weight, $category, $stock, $images)
	{
		$stmt = $this->mysqli->prepare("INSERT INTO products (name, description, reference, price, weight, category, stock) VALUES (?,?,?,?,?,?,?)");
		$stmt->bind_param('sssiisi', $name, $description, $reference, $price, $weight, $category, $stock);
		
		if ($stmt->execute())
			$idproduct = $this->mysqli->insert_id;
			return $this->storeImages($images, $idproduct);
		
		return false;
	}

	public function getProducts()
	{
		$stmt = $this->mysqli->prepare("SELECT p.*, img.url FROM products p
				INNER JOIN images img ON img.product_id = p.id
			ORDER BY p.id DESC LIMIT 100");
		$stmt->execute();	
		$response = $stmt->get_result();

		if ($response->num_rows <> 0)
		    return $response;

		return false;
	}

	public function getProduct($idproduct)
	{
		$stmt = $this->mysqli->prepare("SELECT p.*, img.url FROM products p
				INNER JOIN images img ON img.product_id = p.id
			WHERE p.id =? LIMIT 1");
		$stmt->bind_param('i', $idproduct);
		$stmt->execute();
		$response = $stmt->get_result();

		if ($response->num_rows > 0)
		    return $response;

		return false;
	}

	public function getPurchases($idproduct)
	{
		$stmt = $this->mysqli->prepare("SELECT * FROM orders WHERE product_id = ? ORDER BY id DESC");
		$stmt->bind_param('i', $idproduct);
		$stmt->execute();
		$response = $stmt->get_result();

		if ($response->num_rows > 0)
		    return $response;

		return false;
	}

	public function updateProduct($idproduct, $name, $description, $reference, $price, $weight, $category, $stock, $images)
	{
		$stmt = $this->mysqli->prepare("UPDATE products SET name=?, description=?, reference=?, price=?, weight=?, category=?, stock=?");
		$stmt->bind_param('sssiisi', $name, $description, $reference, $price, $weight, $category, $stock);
		
		if ($stmt->execute())
			if (!empty($images))
				return $this->storeImages($images, $idproduct);
			return true;
		
		return false;
	}

	public function deleteProduct($idproduct)
	{
		$stmt = $this->mysqli->prepare("DELETE FROM products WHERE id = ?");
		$stmt->bind_param('i', $idproduct);
		
		if ($stmt->execute())
			array_map('unlink', glob("../../storage/{$idproduct}/*.*"));
			if (rmdir("../../storage/{$idproduct}/"))
				return true;
		
		return false;
	}

	public function mostStock()
	{
		$stmt = $this->mysqli->prepare("SELECT p.*, img.url FROM products p
				INNER JOIN images img ON img.product_id = p.id
			ORDER BY stock DESC LIMIT 3");
		$stmt->execute();
		$response = $stmt->get_result();

		if ($response->num_rows > 0)
		    return $response;

		return false;
	}

	public function bestSelling()
	{
		$stmt = $this->mysqli->prepare("SELECT
			img.url,
			p.name, p.stock, p.id,
			SUM(o.quantity) as quantity
			FROM orders o
		    	JOIN products p ON o.product_id = p.id
		    	INNER JOIN images img ON img.product_id = p.id
		    GROUP BY p.id
		    ORDER BY SUM(o.quantity) DESC LIMIT 1");
		$stmt->execute();
		$response = $stmt->get_result();

		if ($response->num_rows > 0)
		    return $response;

		return false;
	}

	public function storeImages($images, $idproduct) : bool
	{
		$stmt = $this->mysqli->prepare("DELETE FROM images WHERE product_id = ?");
		$stmt->bind_param('i', $idproduct);
		$stmt->execute();

		$status = true;
		foreach($images['name'] as $key => $image)
		{
			$tempname = $images["tmp_name"][$key];
			$name = $images["name"][$key];
			$tmp = explode('.', $name);
			$ext = end($tmp);

			$filename = $this->generate_string("abcdefgh", 5) .".". $ext;
			$folder   = "../../storage/{$idproduct}/";
			$target   = "../../storage/{$idproduct}/{$filename}";

			if (!is_dir($folder) && !mkdir($folder)){
				die("Error creando carpeta $folder");
			}

			if (move_uploaded_file($tempname, $target))
			{
				$stmt = $this->mysqli->prepare("INSERT INTO images (product_id, url) VALUES (?,?)");
				$stmt->bind_param('is', $idproduct, $filename);
				$stmt->execute();

			} else {
				$status = false;
			}
		}

		return $status;
	}

	private function generate_string($input, $strength = 100) {
	    $input_length = strlen($input);
	    $random_string = '';

	    for ($i = 0; $i < $strength; $i++) {
	        $random_character = $input[mt_rand(0, $input_length - 1)];
	        $random_string .= $random_character;
		}
		return $random_string;
	}
}
