<?php

include(__DIR__.'/config.php');

// Do it and store it all in variables in the Anax container.
$shire['title'] = "404";
$shire['header'] = "";
$shire['main'] = "This is a Anax 404. Document is not here.";
$shire['footer'] = "";
 
// Send the 404 header 
header("HTTP/1.0 404 Not Found");
 
 
// Finally, leave it all to the rendering phase of Anax.
include(SHIRE_THEME_PATH);
