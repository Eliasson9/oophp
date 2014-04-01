<?

include __DIR__.'/config.php';

// Add style for csource
$shire['stylesheets'][] = 'css/source.css';

//Connect to database
$db = new CDatabase($shire['database']);


$sql = "SELECT *, (published <= NOW()) AS available FROM Content;";
$res = $db->ExecuteSelectQueryAndFetchAll($sql);
var_dump($res);



// Do it and store it all in variables in the Shire container.
$shire['title'] = "Visa Innehåll";

$shire['main'] = "<h1>Visa Innehåll</h1>\n";

include SHIRE_THEME_PATH;