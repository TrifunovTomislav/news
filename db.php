<?php
class DB {
	private static $instance;
	public $conn;
	private $dsn = "mysql:host=localhost;dbname=news";
	private $dbUser = "root";
	private $dbPass = "";
	private function __construct(){
		$this->conn = new PDO($this->dsn,$this->dbUser,$this->dbPass);
	}
	public static function getInstance(){
		if(!self::$instance){
			self::$instance = new DB;
		}
		return self::$instance;
	}
	
}

class Tables {
	
	public static function createTables(){
	 $query1 = "CREATE TABLE IF NOT EXISTS users (id int primary key auto_increment, name varchar(256), password varchar(256))";
	 $query2 = "CREATE TABLE IF NOT EXISTS articles (id int primary key auto_increment, article TEXT)";
	 $query3 = "CREATE TABLE IF NOT EXISTS comments (id int primary key auto_increment, comment TEXT, marker varchar(256))";
	
		$db = DB::getInstance();
		$db->conn->exec($query1);
		$db->conn->exec($query2);
		$db->conn->exec($query3);
		
	}
}
//try{
//	Tables::createTables();
//}catch(Exception $e){
//	echo $e->getMessage();
//}