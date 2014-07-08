<?php

include __DIR__.'/config.php';

// Add style for csource
$shire['stylesheets'][] = 'css/source.css';




$shire['title'] = "Visa Innehåll";

$shire['main'] = <<<EOD
<img src="img.php?src=BigBait-Logo-stor.png&save-as=png&sharpen" alt="Big-Bait Logo"/>
EOD;

include SHIRE_THEME_PATH;