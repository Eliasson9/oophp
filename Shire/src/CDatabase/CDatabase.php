<?php

/**
*	This calss handle the database connection and functions related to the database
*/

class CDatabase {
	/**
	*	parameters
	*/	
	private $options;                   // Options used when creating the PDO object
	private $db = null;               	// The PDO object
	private $stmt = null;               // The latest statement used to execute a query
	private static $numQueries = 0;     // Count all queries made
	private static $queries = array();  // Save all queries for debugging purpose
	private static $params = array();   // Save all parameters for debugging purpose
 
	
	/**
	*	constructor
	*/	
	public function __construct($options) {
		$default = array(
    	'dsn' => null,
      	'username' => null,
      	'password' => null,
      	'driver_options' => null,
      	'fetch_style' => PDO::FETCH_OBJ,
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
	
	public function ExecuteSelectQueryAndFetchAll($query, $params=array(), $debug=false) {
 
    	self::$queries[] = $query; 
    	self::$params[]  = $params; 
    	self::$numQueries++;
 
    	if($debug) {
      		echo "<p>Query = <br/><pre>{$query}</pre></p><p>Num query = " . self::$numQueries . "</p><p><pre>".print_r($params, 1)."</pre></p>";
    	}
 
    	$this->stmt = $this->db->prepare($query);
    	$this->stmt->execute($params);
    	return $this->stmt->fetchAll();
  	}
	
	/**
   	* Get a html representation of all queries made, for debugging and analysing purpose.
   	* 
   	* @return string with html.
   	*/
  	public function Dump() {
    	$html  = '<p><i>You have made ' . self::$numQueries . ' database queries.</i></p><pre>';
    	foreach(self::$queries as $key => $val) {
      		$params = empty(self::$params[$key]) ? null : htmlentities(print_r(self::$params[$key], 1)) . '<br/></br>';
      		$html .= $val . '<br/></br>' . $params;
    	}
    	return $html . '</pre>';
  	}
	
	
}