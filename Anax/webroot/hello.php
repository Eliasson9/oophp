<?php

include(__DIR__.'/config.php');

$anax['title'] = "Hello World!";
$anax['header'] = <<<EOD
<img class='sitelogo' src='img/anax.png' alt='Anax logo' />
<span class='stetitle'>Anax webbtemplate</span>
<span class='sitelogan'>Återanvändbara moduler för webbutveckling med PHP </span>
EOD;

$anax['main'] = <<<EOD
<h1>Hej världen!</h1>
<p>Detta är en exempelsida som visar hur anax ser ut och fungerar.</p>
EOD;

$anax['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Mikael Roos (me@mikaelroos.se) | <a href='https://github.com/mosbth/Anax-base'>Anax på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;

include(ANAX_THEME_PATH);
