<?php

include __DIR__.'/config.php';

// Add style for csource
$shire['stylesheets'][] = 'css/source.css';

//Connect to database
$db = new CDatabase($shire['database']);

/**
 * Create a link to the content, based on its type.
 *
 * @param object $content to link to.
 * @return string with url to display content.
 */
function getUrlToContent($site) {
  	switch($site->TYPE) {
    	case 'page': 
    		return "page.php?url={$site->url}"; 
    	break;
	    case 'post': 
	    	return "blog.php?slug={$site->slug}"; 
	    break;
	    default: 
	    	return null; 
	    break;
  	}
}

$sql = "SELECT *, (published <= NOW()) AS available FROM Content;";
$res = $db->ExecuteSelectQueryAndFetchAll($sql);

$html = "";
$html .= "<ul>";
foreach ($res as $key => $site) {
	$html .= "<li>";	
		$html .= "Type: ".$site->TYPE."<br> Title: ".$site->title." (<a href='update.php?id={$site->id}'>Editera</a> <a href='".getUrlToContent($site)."'>Visa</a>)";
	$html .= "</li><br>";
}
$html .= "</ul>";


// Do it and store it all in variables in the Shire container.
$shire['title'] = "Visa Innehåll";

$shire['main'] = <<<EOD
<h1>Visa Innehåll</h1> 
{$html}
EOD;

include SHIRE_THEME_PATH;