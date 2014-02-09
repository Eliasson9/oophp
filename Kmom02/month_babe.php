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
<span class='calTitle'>{$cal->getMonth()}</span>
<div id='calendar'>
<br />
{$cal->getCalendar()}
</div>
POD;

include(SHIRE_THEME_PATH);