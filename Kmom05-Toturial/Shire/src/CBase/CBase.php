<?php

class CBase {

	public 	$db; 
	public 	$acronym;
	public 	$sql;
	public 	$filter;

	public function __construct($dbconfig, $sqlString) {
		$this->acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;
		$this->db = new CDatabase($dbconfig);
		$this->sql = $sqlString;
		$this->filter = new CTextFilter();
	}
}