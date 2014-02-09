<?php

include(__DIR__.'/config.php');

$dice = new CDiceHand();
$dice->roll();

$shire['stylesheets'][] = 'css/diceImage.css';

$shire['title'] = 'Min Dice';

$shire['main'] = <<<POD
<h2>En tärningshamd med fem tärningar</h2>
<br />
<p><a href='dice.php'>Kasta</a> tärnigarna igen.</p>
<br />
{$dice->getRollsAsImages()}
<br />
<p>Den totala somman är {$dice->getTotal()}</p>
POD;

include(SHIRE_THEME_PATH);