<!doctype html>
<html lang='<?=$lang?>'>
<head>
<meta charset='utf-8'/>
<title><?=get_title($title)?></title>
<?php if(isset($favicon)): ?><link rel='shortcut icon' href='<?=$favicon?>'/><?php endif; ?>
<link rel='stylesheet' type='text/css' href='<?=$stylesheet?>'/>
<link rel="shortcut icon" href="favicon.ico" />
</head>
<body>
  <div id='wrapper'>
  	<?echo $navMenu?>
    <div id='header'><?=$header?></div>
    <div id='main'><?=$main?></div>
    <div id='footer'><?=$footer?></div>
  </div>
</body>
</html>