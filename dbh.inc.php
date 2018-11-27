<?php

class Dbh {

	private $servername = "localhost";
	private $username = "root";
	private $password = "root";
	private $charset = "utf8mb4";
	private $dbname = "project";


	public function connect(){
		try{
			$dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
			$pdo = new PDO($dsn,$this->username,$this->password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch (PDOException $e) {
			echo "Connection failed: ".$e->getMessage();
		}
	}
}

?>