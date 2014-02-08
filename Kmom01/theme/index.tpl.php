<!doctype html>
<html lang='<?=$lang?>'>
<head>
<meta charset='utf-8'/>
<meta name="viewport" content="width=device-width">
<title><?=get_title($title)?></title>
<?php if(isset($favicon)): ?><link rel='shortcut icon' href='<?=$favicon?>'/><?php endif; ?>
<link rel='stylesheet' type='text/css' href='<?=$stylesheet?>'/>
<link rel="shortcut icon" href="favicon.ico" />
</head>
<body>
  <div id='wrapper'>
    <div id='header'><?=$header?></div>
  	<?=$navMenu?>
    <div id='main'>
    	<div id='content'>
			<?=$main?>
        </div>
    </div>
    <div id='footer'><?=$footer?></div>
  </div>
</body>
</html>