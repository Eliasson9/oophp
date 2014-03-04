<?php

include(__DIR__.'/config.php');

$params = array();
$db = new CDatabase($shire['database']);
$sql = "";

if(isset($_GET['id'])) {
	$params[] = $_GET['id'];
	$sql = "SELECT * FROM VMovie WHERE id = ?";
	$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);
} else {
	header('Location: movieChoise.php?p=Update');
	exit;
}

if(isset($_POST['edit'])) {
	$params[] = $_POST['title'];	
	$sql = "INSERT INTO Movie (title) VALUES (?)";
	$db->ExecuteSelectQueryAndFetchAll($sql, $title);	
}

$shire['stylesheets'][] = 'css/form.css';

$shire['title'] = "Editera Film";

$shire['main'] = <<<EOD
<form method='POST'>
	<fieldset>
		<legend>Editera Film</legend>
		<p>
			<label>Titel: </label>
			<input type='text' name='title' value='{$res[0]->title}'/>
		</p>
		<p>
			<label>Director: </label>
			<input type='text' name='director' value='{$res[0]->director}'/>
		</p>
		<p>
			<label>Speltid: </label>
			<input type='number' name='length' value='{$res[0]->length}'/>
		</p>
		<p>
			<label>År: </label>
			<input type='number' name='year' value='{$res[0]->year}'/>
		</p>
		<p>
			<label>Bild: </label>
			<input type='text' name='img' value='{$res[0]->image}'/>
		</p>
		<p>
			<label>Innehåll: </label>
			<textarea name='plot'>{$res[0]->plot}</textarea>
		</p>
		<p>
			<label>Sub: </label>
			<input type='text' name='subText' value='{$res[0]->subtext}'/>
		</p>
		<p>
			<label>Språk: </label>
			<input type='text' name='speech' value='{$res[0]->speech}'/>
		</p>
		<p>
			<label>Kvalite: </label>
			<input type='text' name='quality' value='{$res[0]->quality}'/>
		</p>
		<p>
			<label>Format: </label>
			<input type='text' name='format' value='{$res[0]->format}'/>
		</p>
		<p>
			<input type='submit' value='Spara' name='edit'/>
		</p>
	</fieldset>
</form>
EOD;
	
include(SHIRE_THEME_PATH);