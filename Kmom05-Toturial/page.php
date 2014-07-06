<?php

include __DIR__.'/config.php';
include(__DIR__.'/filter.php');

// Add style for csource
$shire['stylesheets'][] = 'css/source.css';
$sql = "SELECT * FROM Content 
	WHERE TYPE = 'page' AND url = ? AND published <= NOW()";
$CPage = new CPage($shire['database'], $sql);
$CPage->setDataFromDatabase();
$shire['title'] = $CPage->title;

$shire['main'] = <<<EOD
<article>
<header>
<h1>{$CPage->title}</h1>
</header>
 
{$CPage->data}
 
<footer>
{$CPage->editLink}
</footer
</article>
EOD;

include SHIRE_THEME_PATH;