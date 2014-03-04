<?php

include(__DIR__.'/config.php');

$sort = "";
if(isset($_GET['selected']) && $_GET['selected'] == 'Update') {
	header('Location: updateMovie.php?id=' . $_GET['choise']);
  	exit;
} else if (isset($_GET['selected']) && $_GET['selected'] == 'Delete') {
	header('Location: deleteMovie.php?id=' . $_GET['choise']);
  	exit;
}
if(isset($_GET['p'])) {
	$sort = $_GET['p'];
}


$db = new CDatabase($shire['database']);
$sql = "SELECT * FROM VMovie ";
$res = $db->ExecuteSelectQueryAndFetchAll($sql);
$tr = "<table>\n<tr><th>Rad</th><th>Id</th><th>Bild</th><th>Titel</th><th>År</th><th>Genre</th></tr>\n";
foreach ($res as $key => $movie) {
	$tr .= "<tr>\n";
	$tr .= "<td>{$key}</td><td>{$movie->id}</td><td><img class='movieImg' src='{$movie->image}' alt='movieImage'></td><td>{$movie->title}</td><td>{$movie->year}</td><td>$movie->genre</td><td><input type='radio' name='choise' value='{$movie->id}'/></td>\n";
	$tr .= "</tr>\n";
}
$tr .= "</table>\n";

$shire['stylesheets'][] = 'css/form.css';
$shire['stylesheets'][] = 'css/table.css';

$shire['title'] = "Skapa Film";

$shire['main'] = <<<EOD
<form>
	{$tr}
	<br>
	<input type='submit' name='selected' value='{$sort}' style='float: right'/>
</form>
EOD;
	
include(SHIRE_THEME_PATH);