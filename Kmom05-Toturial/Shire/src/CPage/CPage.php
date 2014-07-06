<?php


class CPage extends CBase {

	public 	$url; 
	
	public 	$res;
	public 	$content;
	public 	$title;
	public 	$data; 
	public 	$editLink;

	public function __construct($dbconfig, $sqlString) {
		parent::__construct($dbconfig, $sqlString);
		$this->url = $_GET['url'];		
	}

	public function setDataFromDatabase() {
		$this->res = $this->db->ExecuteSelectQueryAndFetchAll($this->sql, array($this->url));
		$this->content = $this->res[0];
		$this->title = htmlentities($this->content->title, null, 'UTF-8');
		$this->data = $this->filter->doFilter(htmlentities($this->content->DATA, null, 'UTF-8'), $this->content->FILTER);
		$this->editLink = $this->acronym ? "<a href='edit.php?id={$content->id}'>Updatera sidan</a>" : null;
	}
}