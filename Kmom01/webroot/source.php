<?php

include(__DIR__.'/config.php');

// Add style for csource
$shire['stylesheets'][] = 'css/source.css';


// Create the object to display sourcecode
//$source = new CSource();
$source = new CSource(array('secure_dir' => '..', 'base_dir' => '..'));


// Do it and store it all in variables in the Anax container.
$shire['title'] = "Visa källkod";

$shire['main'] = "<h1>Visa källkod</h1>\n" . $source->View();

include(SHIRE_THEME_PATH);