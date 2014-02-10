<?php

include(__DIR__.'/config.php');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
$cal = new CMonthBabe();
$temp = $cal->getCalendar();
$shire['stylesheets'][] = 'css/calendarStyle.css';
$shire['title'] = 'Min Kalender';

$shire['main'] = <<<POD
<h2>Månadens Babe!</h2>
<br />
<span class='calendarTitle'>{$cal->getMonthYear()}</span>
<br />
<div class='myCal'>
<div class='left'><a href='?p=Pre'>Föregående</a></div>
<div id='calendar'>
<br />
{$cal->week()}
{$cal->getCalendar()}
</div>
<div class='right'><a href='?p=Post'>Nästa</a></div>
</div>
POD;

include(SHIRE_THEME_PATH);