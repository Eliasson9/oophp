<?php

/**
*	This calss handle the database connection and functions related to the database
*/

class CDatabase {
	/**
	*	parameters
	*/	
	protected $options;                   // Options used when creating the PDO object
	protected $db = null;               	// The PDO object
	protected $stmt = null;               // The latest statement used to execute a query
	protected static $numQueries = 0;     // Count all queries made
	protected static $queries = array();  // Save all queries for debugging purpose
	protected static $params = array();   // Save all parameters for debugging purpose
 
	
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
	
	/**
	 * Function that execute an string and fetch it.
	 * 
	 * @param string $query the query sql
	 * @param array $params contains argument that replace ?
	 * @param boolean $debug check if debug is needed
	 * @return array with the resultset
	 */
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
	
	/**
 	* Use the current querystring as base, modify it according to $options and return the modified query string.
 	*
 	* @param array $options to set/change.
 	* @param string $prepend this to the resulting query string
 	* @return string with an updated query string.
 	*/
	function getQueryString($options, $prepend='?') {
  		// parse query string into array
  		$query = array();
		parse_str($_SERVER['QUERY_STRING'], $query);

  		// Modify the existing query string with new options
  		$query = array_merge($query, $options);
 		
 		// Return the modified querystring
  		return $prepend . http_build_query($query, '', '&amp;');
	}
}