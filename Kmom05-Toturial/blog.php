<?php

include __DIR__.'/config.php';
include(__DIR__.'/filter.php');

// Add style for csource
$shire['stylesheets'][] = 'css/source.css';


$CBlog = new CBlog($shire['database']);
$CBlog->getContentAndBuildHtml();

$shire['title'] = "Bloggen";
$shire['main'] = null;

$shire['main'] = $CBlog->html;

include SHIRE_THEME_PATH;