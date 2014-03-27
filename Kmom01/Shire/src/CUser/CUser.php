<?php

/**
*	This calss handle the user information/connection
**/

class CUser extends CDatabase {
	
	/**
	*	constructor
	**/	
	public function __construct($options) {
		// The constructur of the baseclass
  		parent::__construct($options); 
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