<?php


class CContent {

	public 	$title;
	public 	$slug; 
	public 	$url;
	public 	$type;
	public 	$filter; 
	public 	$published;
	public 	$data; 
	public 	$db;
	public 	$id;

	public function __construct($dbconfig) {
		$this->db = new CDatabase($dbconfig);
		$this->id = isset($_POST['id']) ? strip_tags($_POST['id']) : isset($_GET['id']) ? strip_tags($_GET['id']) : null; 
		is_numeric($this->id) or die('Check: Id must be numeric.');
	}

	public function checkAndSetContentOfPost() {
		$this->title = isset($_POST['title']) ? $_POST['title'] : null;
		$this->slug = isset($_POST['slug']) ? $_POST['slug'] : null;
		$this->url = isset($_POST['url']) ? $_POST['url'] : null;
		$this->type = isset($_POST['TYPE']) ? $_POST['TYPE'] : null;
		$this->filter = isset($_POST['filter']) ? $_POST['filter'] : null;
		$this->published = isset($_POST['published']) ? $_POST['published'] : null;
		$this->data = isset($_POST['data']) ? $_POST['data'] : null;
	}

	public function checkAndSetContentFromGet($content) {
		$this->title = htmlentities($content->title, null, 'UTF-8');
		$this->slug = htmlentities($content->slug, null, 'UTF-8');
		$this->url = htmlentities($content->url, null, 'UTF-8');
		$this->type = htmlentities($content->TYPE, null, 'UTF-8');
		$this->filter = htmlentities($content->FILTER, null, 'UTF-8');
		$this->published = htmlentities($content->published, null, 'UTF-8');
		$this->data = htmlentities($content->DATA, null, 'UTF-8');
	}


	public function insertPostAndRefreshPage()	{
		$sql = "UPDATE Content SET slug = ?, url = ?, TYPE = ?, title = ?, DATA = ?, FILTER = ?, published = ?, updated = NOW() WHERE id = ?;";
		$params = array($this->slug, $this->url, $this->type, $this->title,  $this->data, $this->filter, $this->published, $this->id);
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $params);
		header('Location: update.php?id='.$this->id);
		exit;
	}

	public function getContentFromDb() {
		$params[] = $this->id;
		$sql = "SELECT *, (published <= NOW()) AS available FROM Content WHERE id = ?;";
		$res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $params);
		return $res[0];
	}
}