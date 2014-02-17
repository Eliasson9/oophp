<?php

include(__DIR__.'/config.php');

/**
* Function to create links for sorting
*
* @param string $column the name of the database column to sort by
* @return string with links to order by column.
*/
function orderBy($column) {
	return "<span class='orderBy'><a href='?orderBy={$column}&order=asc'>&darr;</i></a><a href='?orderby={$column}&order=desc'>&uarr;</a></span>";
}

$db = new CDatabase($shire['database']);
$sql = "SELECT COUNT(id) FROM VMovie";
$res = $db->ExecuteSelectQueryAndFetchAll($sql);
echo $db->Dump();

$shire['stylesheets'][] = 'css/form.css';

$shire['title'] = "Me-Sida";

$shire['main'] = <<<EOD

EOD;

include(SHIRE_THEME_PATH);