<?php

define('IMG_PATH', __DIR__.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR);
define('CACHE_PATH', __DIR__. DIRECTORY_SEPARATOR. 'cache' . DIRECTORY_SEPARATOR);

function errorMessage($message) {
  header("Status: 404 Not Found");
  die('img.php says 404 - ' . htmlentities($message));
}

function sharpenImage($image) {
  $matrix = array(
    array(-1,-1,-1,),
    array(-1,16,-1,),
    array(-1,-1,-1,)
  );
  $divisor = 8;
  $offset = 0;
  imageconvolution($image, $matrix, $divisor, $offset);
  return $image;
}

function createImageKeepTransparency($width, $height) {
    $img = imagecreatetruecolor($width, $height);
    imagealphablending($img, false);
    imagesavealpha($img, true);  
    return $img;
}

function outputImage($file) {
  $info = getimagesize($file);
  !empty($info) or errorMessage("The file doesn't seem to be an image.");
  $mime   = $info['mime'];
 
  $lastModified = filemtime($file);  
  $gmdate = gmdate("D, d M Y H:i:s", $lastModified);
 
  if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $lastModified){
   	header('HTTP/1.0 304 Not Modified');
  } else {  
    header('Content-type: ' . $mime);  
    readfile($file);
  }
  exit;
}

$maxWidth = $maxHeight = 2300;

$src = isset($_GET['src']) ? $_GET['src'] : null;
$saveAs = isset($_GET ['save-as']) ? $_GET['save-as'] : null;
$quality = isset($_GET['quality']) ? $_GET['quality'] : 60;
$ignoreCache = isset($_GET['no-cache']) ? true : null;
$newWidth = isset($_GET['width']) ? $_GET['width'] : null;
$newHeight = isset($_GET['height']) ? $_GET['height'] : null;
$cropToFit = isset($_GET['crop-to-fit']) ? true : null;
$sharpen = isset($_GET['sharpen']) ? true : null;

$pathToImg = realpath(IMG_PATH.$src);

is_dir(IMG_PATH) or errorMessage('The image dir is not a valid directory.');
is_writable(CACHE_PATH) or errorMessage('The cache dir is not a writable directory.');
isset($src) or errorMessage('Must set src-attribute.');
preg_match('#^[a-z0-9A-Z-_\.\/]+$#', $src) or errorMessage('Filename contains invalid characters.');
substr_compare(IMG_PATH, $pathToImg, 0, strlen(IMG_PATH)) == 0 or errorMessage('Security constraint: Source image is not directly below the directory IMG_PATH.');
is_null($saveAs) or in_array($saveAs, array('png', 'jpg', 'jpeg')) or errorMessage('Not a valid extension to save image as');
is_null($quality) or (is_numeric($quality) and $quality > 0 and $quality <= 100) or errorMessage('Quality out of range');
is_null($newWidth) or (is_numeric($newWidth) and $newWidth > 0 and $newWidth <= $maxWidth) or errorMessage('Width out of range');
is_null($newHeight) or (is_numeric($newHeight) and $newHeight > 0 and $newHeight <= $maxHeight) or errorMessage('Height out of range');
is_null($cropToFit) or ($cropToFit and $newWidth and $newHeight) or errorMessage('Crop to fit needs both width and height to work');
 


$imgInfo = list($width, $height, $type, $attr) = getimagesize($pathToImg);
$mime = $imgInfo['mime'];

$aspectRatio = $width / $height;
if($cropToFit && $newWidth && $newHeight) {
	$targetRatio = $newWidth / $newHeight;
  	$cropWidth   = $targetRatio > $aspectRatio ? $width : round($height * $targetRatio);
  	$cropHeight  = $targetRatio > $aspectRatio ? round($width  / $targetRatio) : $height;
}else if($newWidth && !$newHeight) {
	$newHeight = round($newWidth / $aspectRatio);
} else if (!$newWidth && $newHeight) {
	$newWidth = round($newHeight * $aspectRatio);
} else if ($newHeight && $newWidth) {
	$ratioWidth  = $width  / $newWidth;
  	$ratioHeight = $height / $newHeight;
  	$ratio = ($ratioWidth > $ratioHeight) ? $ratioWidth : $ratioHeight;
  	$newWidth  = round($width  / $ratio);
  	$newHeight = round($height / $ratio);
} else {
	$newWidth = $width;
	$newHeight = $height;
}


$parts = pathinfo($pathToImg);
$fileExtension  = $parts['extension'];
$saveAs = is_null($saveAs) ? $fileExtension : $saveAs;
$quality_ = is_null($quality) ? null : "_q{$quality}";
$dirName = preg_replace('/\//', '-', dirname($src));
$cropToFit_ = is_null($cropToFit) ? null : "_cf";
$sharpen_ = is_null($sharpen) ? null : "_s";
$cacheFileName = CACHE_PATH . "-{$dirName}-{$parts['filename']}_{$newWidth}_{$newHeight}{$quality_}{$cropToFit_}{$sharpen_}.{$saveAs}";
$cacheFileName = preg_replace('/^a-zA-Z0-9\.-_/', '', $cacheFileName);

$imageModifiedTime = filemtime($pathToImg);
$cacheModifiedTime = is_file($cacheFileName) ? filemtime($cacheFileName) : null;

if(!$ignoreCache && is_file($cacheFileName) && $imageModifiedTime < $cacheModifiedTime) {
  outputImage($cacheFileName);
}

switch($fileExtension) {  
  case 'jpg':
  case 'jpeg': 
    $image = imagecreatefromjpeg($pathToImg);
    break;  
 
  case 'png':  
    $image = imagecreatefrompng($pathToImg); 
    break;  
}

if($cropToFit) {
	$cropX = round(($width - $cropWidth) / 2);  
  	$cropY = round(($height - $cropHeight) / 2);    
  	$imageResized = createImageKeepTransparency($newWidth, $newHeight);
  	imagecopyresampled($imageResized, $image, 0, 0, $cropX, $cropY, $newWidth, $newHeight, $cropWidth, $cropHeight);
  	$image = $imageResized;
  	$width = $newWidth;
  	$height = $newHeight;
} else if(!($newWidth == $width && $newHeight == $height)) {
	$imageResized = createImageKeepTransparency($newWidth, $newHeight);
  	imagecopyresampled($imageResized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
  	$image = $imageResized;
  	$width = $newWidth;
  	$height = $newHeight;
}

if($sharpen) {
  $image = sharpenImage($image);
}

switch($saveAs) {
  case 'jpeg':
  case 'jpg':
    imagejpeg($image, $cacheFileName, $quality);
  break;  
 
  case 'png':  
    imagealphablending($image, false);
    imagesavealpha($image, true);
    imagepng($image, $cacheFileName);  
  break;  
}

outputImage($cacheFileName);


