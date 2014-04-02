<?php

include __DIR__.'/config.php';

// Add style for csource
$shire['stylesheets'][] = 'css/source.css';
$shire['stylesheets'][] = 'css/form.css';

//Connect to database
$db = new CDatabase($shire['database']);
$params = array();
$sql = "";
$html = "";
$id = isset($_POST['id']) ? strip_tags($_POST['id']) : isset($_GET['id']) ? strip_tags($_GET['id']) : null; 
is_numeric($id) or die('Check: Id must be numeric.');

if(isset($_POST['edit'])) {
	$title = isset($_POST['title']) ? $_POST['title'] : null;
	$slug = isset($_POST['slug']) ? $_POST['slug'] : null;
	$url = isset($_POST['url']) ? $_POST['url'] : null;
	$type = isset($_POST['TYPE']) ? $_POST['TYPE'] : null;
	$filter = isset($_POST['filter']) ? $_POST['filter'] : null;
	$published = isset($_POST['published']) ? $_POST['published'] : null;
	$data = isset($_POST['DATA']) ? $_POST['DATA'] : null;
	
	$sql = "UPDATE Content SET slug = ?, url = ?, TYPE = ?, title = ? DATA = ?, FILTER = ?, published = ?, updated = NOW() WHERE id = ?;";
	$params[] = array($slug, $url, $type, $title,  $data, $filter, $published, $id);
	$db->ExecuteQuery($sql, $params);	
}

if(isset($_GET['id'])) {
	$params[] = $id;
	$sql = "SELECT *, (published <= NOW()) AS available FROM Content WHERE id = ?;";
	$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);
} 
else {
	header('Location: index.php');
	exit;	
}

// Do it and store it all in variables in the Shire container.
$shire['title'] = "Updatera Innehåll";

$shire['main'] = <<<EOD
<form method='POST'>
	<fieldset>
		<legend>Uppdatera Innehåll</legend>
		<input type='hidden' name='id' value='{$res[0]->id}'/>
		<p>
			<label>Titel: </label>
			<input type='text' name='title' value='{$res[0]->title}'/>
		</p>
		<p>
			<label>Slug: </label>
			<input type='text' name='slug' value='{$res[0]->slug}'/>
		</p>
		<p>
			<label>URL: </label>
			<input type='text' name='url' value='{$res[0]->url}'/>
		</p>
		<p>
			<label>Type: </label>
			<input type='text' name='TYPE' value='{$res[0]->TYPE}'/>
		</p>
		<p>
			<label>Filter: </label>
			<input type='text' name='filter' value='{$res[0]->FILTER}'/>
		</p>
		<p>
			<label>Publisering: </label>
			<input type='datetime' name='published' value='{$res[0]->available}'/>
		</p>
		<p>
			<label>Data: </label>
			<textarea name='data'>{$res[0]->DATA}</textarea>
		</p>
		<p>
			<input type='submit' name='edit' value='Editera'/>
		</p>
	</fieldset>
</form>
EOD;

include SHIRE_THEME_PATH;