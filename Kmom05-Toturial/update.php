<?php

include __DIR__.'/config.php';

// Add style for csource
$shire['stylesheets'][] = 'css/source.css';
$shire['stylesheets'][] = 'css/form.css';

//Connect to database and create params
$db = new CDatabase($shire['database']);
$params = array();
$sql = "";
$html = "";
$id = isset($_POST['id']) ? strip_tags($_POST['id']) : isset($_GET['id']) ? strip_tags($_GET['id']) : null; 
is_numeric($id) or die('Check: Id must be numeric.');

if(isset($_POST['edit'])) {
	//Get all data
	$title = isset($_POST['title']) ? $_POST['title'] : null;
	$slug = isset($_POST['slug']) ? $_POST['slug'] : null;
	$url = isset($_POST['url']) ? $_POST['url'] : null;
	$type = isset($_POST['TYPE']) ? $_POST['TYPE'] : null;
	$filter = isset($_POST['filter']) ? $_POST['filter'] : null;
	$published = isset($_POST['published']) ? $_POST['published'] : null;
	$data = isset($_POST['DATA']) ? $_POST['DATA'] : null;
	
	//Load information to the database
	$sql = "UPDATE Content SET slug = ?, url = ?, TYPE = ?, title = ? DATA = ?, FILTER = ?, published = ?, updated = NOW() WHERE id = ?;";
	$params = array($slug, $url, $type, $title,  $data, $filter, $published, $id);
	$db->ExecuteSelectQueryAndFetchAll($sql, $params);
	var_dump($db->Dump());	
	header('Location: update.php?id='.$id);
	exit;
}

if(isset($_GET['id'])) {
	//Get data from the database
	$params[] = $id;
	$sql = "SELECT *, (published <= NOW()) AS available FROM Content WHERE id = ?;";
	$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);
	$content = $res[0];
	
	//Control all data before load to page
	$title = htmlentities($content->title, null, 'UTF-8');
	$slug = htmlentities($content->slug, null, 'UTF-8');
	$url = htmlentities($content->url, null, 'UTF-8');
	$type = htmlentities($content->TYPE, null, 'UTF-8');
	$filter = htmlentities($content->FILTER, null, 'UTF-8');
	$published = htmlentities($content->published, null, 'UTF-8');
	$data = htmlentities($content->DATA, null, 'UTF-8');
} 
else {
	//Return to main page
	header('Location: index.php');
	exit;	
}

$shire['title'] = "Updatera Innehåll";

//Create main content
$shire['main'] = <<<EOD
<form method='POST'>
	<fieldset>
		<legend>Uppdatera Innehåll</legend>
		<input type='hidden' name='id' value='{$id}'/>
		<p>
			<label>Titel: </label>
			<input type='text' name='title' value='{$title}'/>
		</p>
		<p>
			<label>Slug: </label>
			<input type='text' name='slug' value='{$slug}'/>
		</p>
		<p>
			<label>URL: </label>
			<input type='text' name='url' value='{$url}'/>
		</p>
		<p>
			<label>Type: </label>
			<input type='text' name='TYPE' value='{$type}'/>
		</p>
		<p>
			<label>Filter: </label>
			<input type='text' name='filter' value='{$filter}'/>
		</p>
		<p>
			<label>Publisering: </label>
			<input type='datetime' name='published' value='{$published}'/>
		</p>
		<p>
			<label>Data: </label>
			<textarea name='data'>{$data}</textarea>
		</p>
		<p>
			<input type='submit' name='edit' value='Editera'/>
		</p>
	</fieldset>
</form>
EOD;

include SHIRE_THEME_PATH;