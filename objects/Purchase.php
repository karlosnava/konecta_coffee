<?php

class Purchase extends Database
{
	public function setPurchase($idproduct, $name, $quantity)
	{
		$stmt = $this->mysqli->prepare("UPDATE products SET stock = stock-? WHERE id = ?");
		$stmt->bind_param('ii', $quantity, $idproduct);
		
		if ($stmt->execute()) {
			$stmt = $this->mysqli->prepare("INSERT INTO orders (product_id, name, quantity) VALUES (?,?,?)");
			$stmt->bind_param('isi', $idproduct, $name, $quantity);
			
			if ($stmt->execute())
				return $this->mysqli->insert_id;
		}

		return false;
	}

	public function checkAvailability($idproduct)
	{
		$stmt = $this->mysqli->prepare("SELECT stock FROM products WHERE id = ? LIMIT 1");
		$stmt->bind_param('i', $idproduct);
		
		if ($stmt->execute())
			$response = $stmt->get_result();
			return $response;

		return false;
	}
}
