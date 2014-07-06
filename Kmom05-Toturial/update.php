<?php

include __DIR__.'/config.php';

// Add style for csource
$shire['stylesheets'][] = 'css/source.css';
$shire['stylesheets'][] = 'css/form.css';

//Connect to database and create params
$CContent = new CContent($shire['database']);

if(isset($_POST['edit'])) {
	$CContent->checkAndSetContentOfPost();
	$CContent->insertPostAndRefreshPage();
}

if(isset($_GET['id'])) {
	//Get data from the database
	$content = $CContent->getContentFromDb();
	
	//Control all data before load to page
	$CContent->checkAndSetContentFromGet($content);
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
		<input type='hidden' name='id' value='{$CContent->id}'/>
		<p>
			<label>Titel: </label>
			<input type='text' name='title' value='{$CContent->title}'/>
		</p>
		<p>
			<label>Slug: </label>
			<input type='text' name='slug' value='{$CContent->slug}'/>
		</p>
		<p>
			<label>URL: </label>
			<input type='text' name='url' value='{$CContent->url}'/>
		</p>
		<p>
			<label>Type: </label>
			<input type='text' name='TYPE' value='{$CContent->type}'/>
		</p>
		<p>
			<label>Filter: </label>
			<input type='text' name='filter' value='{$CContent->filter}'/>
		</p>
		<p>
			<label>Publisering: </label>
			<input type='datetime' name='published' value='{$CContent->published}'/>
		</p>
		<p>
			<label>Data: </label>
			<textarea name='data'>{$CContent->data}</textarea>
		</p>
		<p>
			<input type='submit' name='edit' value='Editera'/>
		</p>
	</fieldset>
</form>
EOD;

include SHIRE_THEME_PATH;