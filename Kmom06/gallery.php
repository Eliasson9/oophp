<?php

include __DIR__.'/config.php';

// Add style for csource
$shire['stylesheets'][] = 'css/source.css';
$shire['stylesheets'][] = 'css/galllery.css';
$shire['stylesheets'][] = 'css/figure.css';


define('GALLERY_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'img');
define('GALLERY_BASEURL', '');

function errorMessage($message) {
  header("Status: 404 Not Found");
  die('gallery.php says 404 - ' . htmlentities($message));
}

function readAllItemsInDir($path) {
	$validformat = array('png', 'jpg', 'jpeg');
	$files = glob($path . '/*');
	$gallery = "<ul class='gallery'>\n";
	$len = strlen(GALLERY_PATH);

	foreach ($files as $file) {
		$partsOfFile = pathinfo($file);
		$href = str_replace('\\', '/', substr($file, $len+1));

		if(is_file($file) && in_array($partsOfFile['extension'], $validformat)) {
			$item = "<img src='img.php?src=". GALLERY_BASEURL . $href . "&amp;width=128&amp;height=128&amp;crop-to-fit' alt=''/>";
			$caption = basename($file);
		} else if (is_dir($file)) {
			$item = "<img src='img/folder.png' alt=''/>";
			$caption = basename($file) . '/';
		} else {
			continue;
		}

		$fullCapt = $caption;
		if(strlen($caption > 18)) {
			$caption = substr(string, 0, 10) . "..." . substr($caption, -5);
		}

		$gallery .= "<li><a href='?path={$href}' title='{$fullCapt}'><figure class='figure overview'>{$item}<figcaption>{$caption}</figcaption></figure></a></li>\n";
	}
	$gallery .= "</ul>";
	return $gallery;
}

$path = isset($_GET['path']) ? $_GET['path'] : null;

$pathToGallery = realpath(GALLERY_PATH . DIRECTORY_SEPARATOR . $path);

is_dir(GALLERY_PATH) or errorMessage('The galley dir is not a valid directory');
substr_compare(GALLERY_PATH, $pathToGallery, 0, strlen(GALLERY_PATH)) == 0 or errorMessage('Security constraint: Source gallery is not directly below the directory GALLERY_PATH.');

if(is_dir($pathToGallery)) {
	$gallery = readAllItemsInDir($pathToGallery);
} else if (is_file($pathToGallery)) {
	$gallery = readItem($pathToGallery);
}


$shire['title'] = "Visa Innehåll";

$shire['main'] = <<<EOD
<h1>{$shire['title']}</h1>
$gallery
EOD;

include SHIRE_THEME_PATH;

