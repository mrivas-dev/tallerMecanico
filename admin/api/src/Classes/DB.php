<?php
namespace App;
use PDO;
/**
* 
 Clase DBConnect para la conexión con la base de datos
*
**/
class DB {
	protected $conn;
	function __construct() {}
	/**
	* Establishing database connection
	* @return database connection handler
	**/
	protected function db_connect(){
		try {
			include_once './src/config.php';
			$conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=UTF8", $DB_USERNAME, $DB_PASSWORD);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		$this->conn = $conn;
		return $conn;
	}
	protected function getConn(){
		return $this->conn;
	}
}

?>
