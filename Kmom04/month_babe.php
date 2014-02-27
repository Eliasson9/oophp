<?php

include(__DIR__.'/config.php');
date_default_timezone_set('UTC');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
$cal = new CMonthBabe();
$temp = $cal->getCalendar();
$shire['stylesheets'][] = 'css/calendarStyle.css';
$shire['title'] = 'Min Kalender';

$shire['main'] = <<<POD
<h2>Månadens Babe!</h2>
<br />
<img class='calImg' src='img/BigBait-Logo-Liten.png' alt='calendar Iímage' />
<span class='calendarTitle'>{$cal->getMonthYear()}</span>
<div class='myCal'>
<div class='left'><a href='?p=Pre'>Föregående</a></div>
<div id='calendar'>
{$cal->week()}
{$cal->getCalendar()}
</div>
<div class='right'><a href='?p=Post'>Nästa</a></div>
</div>
POD;

include(SHIRE_THEME_PATH);