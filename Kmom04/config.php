<?php
/**
 * Config-file for Shire. Change settings here to affect installation.
 *
 */
 
/**
 * Set the error reporting.
 *
 */
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors 
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly
 
 
/**
 * Define Shire paths.
 *
 */
define('SHIRE_INSTALL_PATH', __DIR__ . '/../Shire');
define('SHIRE_THEME_PATH', SHIRE_INSTALL_PATH . '/theme/render.php');
/**
 * Include bootstrapping functions.
 *
 */
include(SHIRE_INSTALL_PATH . '/src/bootstrap.php');
 
 
/**
 * Start the session.
 *
 */
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();
 
 
/**
 * Create the Shire variable.
 *
 */
$shire = array();
 
/**
 * Settings for the database.
 *
 */
$shire['database']['dsn'] = 'mysql:host=localhost;dbname=Movies;';
$shire['database']['username'] = 'root';
$shire['database']['password'] = '';
$shire['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"); 


//$shire['database']['dsn'] = 'mysql:host=blu-ray.student.bth.se;dbname=pael10;';
//$shire['database']['username'] = 'pael10';
//$shire['database']['password'] = 'G+&0\fO4';
//$shire['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"); 
 

 
/**
 * Site wide settings.
 *
 */
$shire['lang']         = 'sv';
$shire['title_append'] = ' | oophp';

/**
 * Theme related settings.
 *
 */
$shire['stylesheets'] = array('css/style.css');
$shire['favicon']    = 'favicon.ico';

/**
* The header
*
*/
$shire['header'] = <<<EOD
<img class='sitelogo' src='img/blad.jpg' alt='Dbwebb logo' />
<span class='sitetitle'>Me oophp</span>
<br />
<span class='siteslogan'>Detta är min me-sida i oophp</span>
EOD;

/**
* The nav menu
*
*/
$shire['navMenu'] = array(
	// Use for styling the menu
  	'class' => 'topNav',
 
  	// Here comes the menu strcture
  	'items' => array(
    	// This is a menu item
    	'home'  => array('text'  =>'Hem', 'url'   =>'index.php', 'title' => 'Some title 1'),
		'report' => array('text' =>'Redovisning', 'url' =>'report.php', 'title' => 'Some title 1'),
		'source' => array('text' =>'Källkod', 'url' =>'source.php', 'title' => 'Some title 1'),
		'monthBabe' => array('text' => 'Månadens Babe', 'url' => 'month_babe.php', 'title' => 'Some title 1'),
		'movies' => array('text' => 'Filmer', 'url' => 'movies.php', 'title' => 'Some title 1',
			'submenu' => array( 
				'items' => array(
					'login' => array('text'  =>'Login', 'url' =>'login.php', 'title' => 'Some title 1'),
					'logout' => array('text'  =>'Logout', 'url' =>'logout.php', 'title' => 'Some title 1')	
				),
			),
		),
	),
  	// This is the callback tracing the current selected menu item base on scriptname
  	'callback' => function($url) {
    	if(basename($_SERVER['SCRIPT_FILENAME']) == $url) {
      		return true;
    	}
  	}
);

/**
* The footer
*
*/
$shire['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Patrik Eliasson (pael10@student.bth.se) | <a href='https://github.com/Eliasson9/oophp'>Shire på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;

