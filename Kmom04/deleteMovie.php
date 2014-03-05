<?php

include(__DIR__.'/config.php');

$params = array();
$db = new CDatabase($shire['database']);
$sql = "";
$id = isset($_POST['id']) ?  strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);

if(isset($_GET['id']) && !isset($_GET['remove'])) {
	$params[] = $id;
	$sql = "SELECT (title) FROM VMovie WHERE id = ?";
	$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);	
} else if(isset($_GET['remove']) && isset($_GET['id'])) {
	$params[] = $id;	
	$sql = "DELETE FROM Movie WHERE id = ? LIMIT 1";
	$db->ExecuteSelectQueryAndFetchAll($sql, $params);
	header('Location: movies.php');
	exit;	
} else {
	header('Location: movieChoise.php?p=Delete');
	exit;
}

$shire['stylesheets'][] = 'css/form.css';

$shire['title'] = "Radera Film";

$shire['main'] = <<<EOD
<form>
	<fieldset>
		<legend>Radera Filmen: {$res[0]->title}</legend>
		<input type='hidden' name='id' value='{$id}'/>
		<p>
			<input type='submit' value='Ta Bort' name='remove'/>
		</p>
	</fieldset>
</form>
EOD;
	
include(SHIRE_THEME_PATH);