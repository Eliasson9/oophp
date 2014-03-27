<?php

/**
*	This calss handle the database connection and functions related to the database
*/

class CMovieDatabase extends CDatabase {
	
	
	/**
	*	constructor
	*/	
	public function __construct($options) {
		// The constructur of the baseclass
  		parent::__construct($options);
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
	
	/**
	 * Get id from Language
	 * 
	 * @param string $lang
	 * @return int as id in database
	 */
	 function getLanguage($lang) {
	 	$params = array($lang);
	 	$query = "SELECt id FROM Language WHERE lang = ?";
	 	$this->stmt = $this->db->prepare($query);
    	$this->stmt->execute($params);
    	$res = $this->stmt->fetchAll();
		return $res[0]->id;
	 }
	/**
	 * Get id from Quality
	 * 
	 * @param string $quality
	 * @return int as id in database
	 */
	function getQuality($quality) {
		$params = array($quality);
	 	$query = "SELECt id FROM Quality WHERE quality = ?";
	 	$this->stmt = $this->db->prepare($query);
    	$this->stmt->execute($params);
    	$res = $this->stmt->fetchAll();
		return $res[0]->id;
	}
	/**
	 * Get id from Format
	 * 
	 * @param string $format
	 * @return int as id in database
	 */
	function getFormat($format) {
	 	$params = array($format);
	 	$query = "SELECt id FROM Format WHERE format = ?";
	 	$this->stmt = $this->db->prepare($query);
    	$this->stmt->execute($params);
    	$res = $this->stmt->fetchAll();
		return $res[0]->id;
	}
}
