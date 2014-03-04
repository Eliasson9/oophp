<?php

include(__DIR__.'/config.php');

$title = array();

if(isset($_POST['create'])) {
	$title[] = $_POST['title'];
	$db = new CDatabase($shire['database']);
	$sql = "INSERT INTO Movie (title) VALUES (?)";
	$db->ExecuteSelectQueryAndFetchAll($sql, $title);	
}

$shire['stylesheets'][] = 'css/form.css';

$shire['title'] = "Skapa Film";

$shire['main'] = <<<EOD
<form method='POST'>
	<fieldset>
		<legend>Skapa Ny</legend>
		<p>
			<label>Titel</label>
			<input type='text' name='title'/>
		</p>
		<p>
			<input type='submit' value='Skapa' name='create'/>
		</p>
	</filedset>
</form>
EOD;
	
include(SHIRE_THEME_PATH);
