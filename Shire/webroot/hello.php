<?php

include(__DIR__.'/config.php');
include(__DIR__.'/dynamicMenu.php');


$menu = array(
	'home' => array('text' =>'Home', 'url' =>'?p=home'),
	'away' => array('text' =>'Away', 'url' =>'?p=away'),
	'about' => array('text' =>'About', 'url' =>'?p=about'));
	
$shire['navMenu'] = CNavigation::GenerateMenu($menu);
$shire['title'] = "Hello World!";
$shire['header'] = <<<EOD
<img class='sitelogo' src='img/anax.png' alt='Anax logo' />
<span class='stetitle'>Shire webbtemplate</span>
<span class='sitelogan'>Återanvändbara moduler för webbutveckling med PHP </span>
EOD;

$shire['main'] = <<<EOD
<h1>Hej världen!</h1>
<p>Detta är en exempelsida som visar hur shire ser ut och fungerar.</p>
EOD;

$shire['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Patrik Eliasson (pael10@student.bth.se) | <a href='https://github.com/Eliasson9/oophp'>Shire på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;

include(SHIRE_THEME_PATH);
