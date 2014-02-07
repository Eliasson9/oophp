<?php
/**
 * Config-file for Anax. Change settings here to affect installation.
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
 * Define Anax paths.
 *
 */
define('SHIRE_INSTALL_PATH', __DIR__ . '/..');
define('SHIRE_THEME_PATH', SHIRE_INSTALL_PATH . '/theme/render.php');
 var_dump(SHIRE_INSTALL_PATH . '/theme/render.php');
 
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
 * Create the Anax variable.
 *
 */
$shire = array();
 
 
/**
 * Site wide settings.
 *
 */
$shire['lang']         = 'sv';
$shire['title_append'] = ' | Shire en webbtemplate';

/**
 * Theme related settings.
 *
 */
$shire['stylesheet'] = 'css/style.css';
$shire['favicon']    = 'favicon.ico';