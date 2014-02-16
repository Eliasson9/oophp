<?php

/**
*	This calss handle the database connection and functions related to the database
*/

class CDatabase {
	/**
	*	parameters
	*/	
	private $pdo;
	
	/**
	*	constructor
	*/	
	public function __construct() {
		$dsn      = 'mysql:host=localhost;dbname=Movies;';
		$login    = 'root';
		$password = '';
		$options  = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
		try {
  			$this->pdo = new PDO($dsn, $login, $password, $options);
			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		}
		catch(Exception $e) {
		  //throw $e; // For debug purpose, shows all connection details
		  throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
		}
	}
	
	public function getRes() {
		$sql = "SELECT * FROM Movie;";
		$sth = $this->pdo->prepare($sql);
		$sth->execute();
		$res = $sth->fetchAll();
		return $res;
	}
	
	
}