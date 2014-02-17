<?php

include(__DIR__.'/config.php');

$db = new CDatabase($shire['database']);
$sql = "SELECT COUNT(id) FROM VMovie";
$res = $db->ExecuteSelectQueryAndFetchAll($sql);
$db->Dump();
dump($res);
$hits = isset($_GET['hits']);
$page = isset($_GET['page']);
$max = 5;
$orderby = isset($_GET['orderby']) ? strtolower($_GET['orderby']) : 'id';
$order = isset($_GET['order']) ? strtolower($_GET['order']) : 'asc';
$year1 = isset($_GET['year1']) && !empty($_GET['year1']) ? $_GET['year1'] : null;
$year2 = isset($_GET['year2']) && !empty($_GET['year2']) ? $_GET['year2'] : null;
dump($max[0]);
in_array($orderby, array('id', 'title', 'year')) or die('Check: Not valid column.');
in_array($order, array('asc', 'desc')) or die('Check: Not valid sort order.');

$sql = "SELECT * FROM VMovie ORDER BY $orderby $order";
$res = $db->ExecuteSelectQueryAndFetchAll($sql);

$sql = "SELECT * FROM VMovie LIMIT $hits OFFSET " . (($page - 1) * $hits);
$res = $db->ExecuteSelectQueryAndFetchAll($sql);

$tr = "<table>\n<tr><th>Rad</th><th>Id " . $db->orderBy('id') . "</th><th>Bild</th><th>Titel " . $db->orderBy('title') . "</th><th>År " . $db->orderBy('year') . "</th><th>Genre</th></tr>\n";
foreach ($res as $key => $movie) {
	$tr .= "<tr>\n";
	$tr .= "<td>{$key}</td><td>{$movie->id}</td><td><img class='movieImg' src='{$movie->image}' alt='movieImage'></td><td>{$movie->title}</td><td>{$movie->year}</td><td>$movie->genre</td>\n";
	$tr .= "</tr>\n";
}
$tr .= "</table>\n";


$shire['stylesheets'][] = 'css/form.css';
$shire['stylesheets'][] = 'css/table.css';

$shire['title'] = "Me-Sida";

$shire['main'] = <<<EOD
<form>
	<fieldset>
		<legend>Sök</legend>
		<p><label>Skapad mellan åren: 
    	<input type='text' name='year1' value='{$year1}'/> - <input type='text' name='year2' value='{$year2}'/>
  		</label>
		</p>
		<p><input type='submit' name='submit' value='Sök'/></p>
		<p><a href='?'>Visa alla</a></p>
	</fieldset>
</form>
<div id='above'>
	{$db->getHitsPerPage(array(2, 4, 6))}
</div>
{$tr}
<div id='below'>
	{$db->getPageNav($hits, $page, $max)}
</div>
EOD;

include(SHIRE_THEME_PATH);