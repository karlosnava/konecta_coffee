<?php

class Database
{
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	public  $database = "konecta_coffee";

	public $mysqli = false;
	private $connected = false;

	function __construct()
	{
		$conn = new mysqli(
			$this->servername,
			$this->username,
			$this->password,
			$this->database
		);
		$this->mysqli = $conn;

		if ($conn->connect_error)
			$this->connected = false;

		$this->connected = true;
	}

	public function testConnection()
	{
		return $this->connected;
	}

	public function getConnection()
	{
		return $this->mysqli;
	}

	public function __destruct()
	{
		$this->mysqli->close();
	}
}
