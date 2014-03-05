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
	* Function to create links for sorting
	*
	* @param string $column the name of the database column to sort by
	* @return string with links to order by column.
	*/
	function orderBy($column) {
		return "<span class='orderBy'><a href='".$this->getQueryString(array('orderBy' => $column, 'order' => 'asc'))."'>&darr;</a><a href='".$this->getQueryString(array('orderBy' => $column, 'order' => 'desc'))."'>&uarr;</a></span>";
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
	
	/**
 	* Create links for hits per page.
 	*
 	* @param array $hits a list of hits-options to display.
 	* @return string as a link to this page.
 	*/
	function getHitsPerPage($hits) {
  		$nav = "Träffar per sida: ";
  		foreach($hits AS $val) {
    		$nav .= "<a href='" . $this->getQueryString(array('hits' => $val)) . "'>$val</a> ";
  		}  
  		return $nav;
	}
	
	/**
 	* Create navigation among pages.
 	*
 	* @param integer $hits per page.
 	* @param integer $page current page.
 	* @param integer $max number of pages. 
 	* @param integer $min is the first page number.
 	* @return string as a link to this page.
 	*/
	function getPageNav($hits, $page, $max, $min=1) {
  		$nav  = "<a href='" . $this->getQueryString(array('page' => $min)) . "'>&lt;&lt;</a> ";
  		$nav .= "<a href='" . $this->getQueryString(array('page' => ($page > $min ? $page - 1 : $min) )) . "'>&lt;</a> ";
 
  		for($i=$min; $i<=$max; $i++) {
    		$nav .= "<a href='" . $this->getQueryString(array('page' => $i)) . "'>$i</a> ";
  		}
 	
  		$nav .= "<a href='" . $this->getQueryString(array('page' => ($page < $max ? $page + 1 : $max) )) . "'>&gt;</a> ";
  		$nav .= "<a href='" . $this->getQueryString(array('page' => $max)) . "'>&gt;&gt;</a> ";
  		return $nav;
	}
	
}