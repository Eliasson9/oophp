<?php
	
include(__DIR__.'/config.php');

//Get t parameters
$db = new CUser($shire['database']);
$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;


$res = $db->doLogin($username, $password);
if(isset($res[0])) {
	$_SESSION['user'] = $res[0];
}

$shire['stylesheets'][] = 'css/form.css';

$shire['title'] = "Login";
	
$shire['main'] = <<<EOD
<form method='POST'>
	<fieldset>
		<legend>Login</legend>
		<p>
			<label>Användarnamn</label>
			<input type='text' name='username'/>
		</p>
		<p>
			<label>Lösenord</label>
			<input type='password' name='password'/>
		</p>
		<p>
			<input type='submit' value='Login' name='login'/>
		</p>
		<p>
			<a href='logout.php'>Logout</a>
		</p>
	</fieldset>
</form>
{$db->getAcronym()}
EOD;
	
include(SHIRE_THEME_PATH);
	