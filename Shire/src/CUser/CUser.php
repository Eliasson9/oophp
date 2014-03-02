<?php

/**
*	This calss handle the user information/connection
**/

class CUser {
	/**
	*	parameters
	**/	
	private $options;                   // Options used when creating the PDO object
	private $db = null;               	// The PDO object
	private $stmt = null;               // The latest statement used to execute a query
	
	/**
	*	constructor
	**/	
	public function __construct($options) {
		$default = array(
			'dsn' => null,
			'username' => null,
			'password' => null,
			'driver_options' => null,
			'fetch_style' => PDO::FETCH_OBJ
		);
		$this->options = array_merge($default, $options);
		
		try {
    		$this->db = new PDO($this->options['dsn'], $this->options['username'], $this->options['password'], $this->options['driver_options']);
    	}
    	catch(Exception $e) {
    		//throw $e; // For debug purpose, shows all connection details
      		throw new PDOException('Could not connect to database, hiding connection details.'	); // Hide connection details.
    	}
 
    	$this->db->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->options['fetch_style']); 
	}
	
	/**
	 * check if user is logged in
	 * @return string with acronym or "Du är inte inloggad"
	 */
	public function getAcronym() {
		$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
 
		if($acronym) {
		  return "Du är inloggad med acronym: $acronym ({$_SESSION['user']->acronym})";
		}
		else {
		  return "Du är INTE inloggad.";
		}	
	}
	
	/**
	 * Check username, password and login if correct
	 * @param string $user
	 * @param string $password
	 * @return array with the result from the query
	 */
	public function doLogin($user, $password) {
		$sql = "SELECT acronym, name FROM USER WHERE acronym = ? AND password = md5(concat(?, salt))";
		$this->stmt = $this->db->prepare($sql);
		$this->stmt->execute(array($user, $password));
		return $this->stmt->fetchAll();
	}
	
	/**
	 * Logout and unset SESSION
	 */
	public function doLogout() {
		unset($_SESSION['user']);
		header('Location: logout.php');
	}
	
	/**
	 * Check if user is logged in
	 * @return true if logged in and else false
	 */
	public function checkAuthenticated() {
		if(isset($_SESSION['user'])) {
			return true;
		} else {
			return false;
		}
	}
	
	
}