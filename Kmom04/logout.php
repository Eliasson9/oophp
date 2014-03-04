<?php
	
include(__DIR__.'/config.php');

//Get t parameters
$db = new CUser($shire['database']);

if(isset($_POST['logout'])) {
	$db->doLogout();
}

$shire['stylesheets'][] = 'css/form.css';

$shire['title'] = "Logout";

$shire['main'] = <<<EOD
<form method='POST'>
	<fieldset>
		<legend>Logout</legend>
		<p>
			{$db->getAcronym()}
		</p>
		<p>
			<input type='submit' name='logout' value='Logout'/>
		</p>
		<p>
			<a href='login.php'>Login</a>
		</p>
	</fieldset>
</form>
EOD;
	
include(SHIRE_THEME_PATH);