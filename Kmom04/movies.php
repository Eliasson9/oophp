<?php

include(__DIR__.'/config.php');
 
//Get t parameters
$db = new CDatabase($shire['database']);
$title = isset($_GET['title']) ? $_GET['title'] : null;
$genre = isset($_GET['genre']) ? $_GET['genre'] : null;
$hits = isset($_GET['hits']) ? $_GET['hits'] : 8;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$orderBy = isset($_GET['orderBy']) ? strtolower($_GET['orderBy']) : 'id';
$order = isset($_GET['order']) ? strtolower($_GET['order']) : 'asc';
$year1 = isset($_GET['year1']) && !empty($_GET['year1']) ? $_GET['year1'] : null;
$year2 = isset($_GET['year2']) && !empty($_GET['year2']) ? $_GET['year2'] : null;

//Check parametera
is_numeric($hits) or die('Not valid hits number');
is_numeric($page) or die('Not valid pagenumber');
is_numeric($year1) || !isset($year1)  or die('Check: Year must be numeric or not set.');
is_numeric($year2) || !isset($year2)  or die('Check: Year must be numeric or not set.');
in_array($orderBy, array('id', 'title', 'year')) or die('Check: Not valid column.');
in_array($order, array('asc', 'desc')) or die('Check: Not valid sort order.');

//Get all genres
$sql = "SELECT DISTINCT G.genre
			FROM Genre AS G
				INNER JOIN Movie2Genre AS MovGen ON G.id = MovGen.idGenre";

$res = $db->ExecuteSelectQueryAndFetchAll($sql);
$genres = null;
foreach($res as $val) {
	if($val->genre == $val) {
		$genres .= "$genre->genre";	
	} else {
		$genres .= "<a href='" . $db->getQueryString(array('genre' => $val->genre)) . "'>{$val->genre}</a> ";	
	}
}



//Combining sql string

$sql = "";
$where = null;
$params = array();
$limit = null;
//order
$order = " ORDER BY $orderBy $order ";
//title
if($title) {
  $where .= " AND title LIKE ?";
  $params[] = '%'.$title.'%';
} 
//year
if($year1) {
  $where .= " AND year >= ?";
  $params[] = $year1;
} 
if($year2) {
  $where .= " AND year <= ?";
  $params[] = $year2;
} 
//genre
if($genre) {
  $where .= " AND genre LIKE ?";
  $params[] = '%'.$genre.'%';
} 
//limit
if($hits && $page) {
  $limit = " LIMIT $hits OFFSET " . (($page - 1) * $hits);
}

//final
$where = $where ? " WHERE 1 {$where}" : null;
$sql .= "SELECT * FROM VMovie " . $where . $order . $limit;
$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);
$tr = "<table>\n<tr><th>Rad</th><th>Id " . $db->orderBy('id') . "</th><th>Bild</th><th>Titel " . $db->orderBy('title') . "</th><th>År " . $db->orderBy('year') . "</th><th>Genre</th></tr>\n";
foreach ($res as $key => $movie) {
	$tr .= "<tr>\n";
	$tr .= "<td>{$key}</td><td>{$movie->id}</td><td><img class='movieImg' src='{$movie->image}' alt='movieImage'></td><td>{$movie->title}</td><td>{$movie->year}</td><td>$movie->genre</td>\n";
	$tr .= "</tr>\n";
	var_dump($movie->image);
}
$tr .= "</table>\n";

$sql = "SELECT COUNT(id) AS nrRows FROM ( SELECT * FROM VMovie " . $where . $order . ") AS Movie";
$res = $db->ExecuteSelectQueryAndFetchAll($sql, $params);
$max = ceil($res[0]->nrRows / $hits);

$shire['stylesheets'][] = 'css/form.css';
$shire['stylesheets'][] = 'css/table.css';

$shire['title'] = "Multi sida";

$shire['main'] = <<<EOD
<form>
	<fieldset>
		<legend>Sök</legend>
		<p>
			<label>Titel (delsträng):</label> 
			<input type='search' name='title' value='{$title}'/>
		</p>
		<p>
			<label >Skapad mellan åren: </label> 
    		<input type='text' name='year1' value='{$year1}'/> - <input type='text' name='year2' value='{$year2}'/>
		</p>
		<p>
			<label>Välj genre:</label> {$genres}
		</p>
		<p>
			<input type='submit' name='submit' value='Sök'/>
		</p>		
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