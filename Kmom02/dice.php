<?php

include(__DIR__.'/config.php');

$dice = new CDiceImage();
$dice->roll(2);

$shire['stylesheets'][] = 'css/diceImage.css';

$shire['title'] = 'Min Dice';

$shire['main'] = $dice->getRollsAsImageList();


include(SHIRE_THEME_PATH);