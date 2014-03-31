<?php

include(__DIR__.'/config.php');

$params = array();
$db = new CMovieDatabase($shire['database']);
$sql = "";


if(isset($_GET['id'])) {
	$id = isset($_POST['id']) ?  strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
	is_numeric($id) or die('Check: Id must be numeric.');

	$params[] = $id;
	$sql = "SELECT * FROM VMovie WHERE id = ?";
	$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);
} else {
	header('Location: movieChoise.php?p=Update');
	exit;
}

	$id = isset($_POST['id']) ?  strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
	is_numeric($id) or die('Check: Id must be numeric.');



if(isset($_POST['edit'])) {
	$title = isset($_POST['title']) ? strip_tags($_POST['title']) : null;
	$director = isset($_POST['director']) ? strip_tags($_POST['director']) : null;
	$length = isset($_POST['length']) ? strip_tags($_POST['length']) : null;
	$year = isset($_POST['year']) ? strip_tags($_POST['year']) : null;
	$img = isset($_POST['img']) ? strip_tags($_POST['img']) : '';
	$plot = isset($_POST['plot']) ? strip_tags($_POST['plot']) : null;
	$subtext = isset($_POST['subtext']) ? strip_tags($_POST['subtext']) : null;
	$speech = isset($_POST['speech']) ? strip_tags($_POST['speech']) : null;
	$quality = isset($_POST['quality']) ? strip_tags($_POST['quality']) : null;
	$format = isset($_POST['format']) ? strip_tags($_POST['format']) : null;
	in_array($subtext, array('na', 'swe', 'fin', 'nor')) or die('Check: Not valid sub.');
	in_array($speech, array('na', 'swe', 'fin', 'nor')) or die('Check: Not valid language.');
	in_array($quality, array('na', 'xvid', 'mp4', 'hd')) or die('Check: Not valid quality.');
	in_array($format, array('na')) or die('Check: Not valid format.');
	$params = array($title, $director, $length, $year, $img, $plot, $db->getLanguage($subtext), $db->getLanguage($speech), $db->getQuality($quality), $db->getFormat($format), $id);
	$sql = "UPDATE Movie SET title = ?, director = ?, length = ?, year = ?, image = ?, plot = ?, subtext = ?, speech = ?, quality = ?, format = ? WHERE id = ?";
	$db->ExecuteSelectQueryAndFetchAll($sql, $params);
	//var_dump($params);
	//var_dump($_POST['subtext']);
	header('Location: updateMovie.php?id=' . $id);
	exit;	
}
$shire['stylesheets'][] = 'css/form.css';

$shire['title'] = "Editera Film";

$shire['main'] = <<<EOD
<form method='POST'>
	<fieldset>
		<legend>Editera Film</legend>
		<input type='hidden' name='id' value='{$id}'/>
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
			<input type='text' name='subtext' value='{$res[0]->subtext}'/>
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