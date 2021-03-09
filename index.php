<?php
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  define('TITLE', 'Главная');
  include SITE_ROOT.'libs/top_vars.php';
  include SITE_ROOT.'libs/database.php';
  include SITE_ROOT.'libs/user.php';
  include SITE_ROOT.'libs/index.php';
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<?php
  include SITE_ROOT.'templates/header.php';
?>
<head>
	
</head>

<body>
<link rel="stylesheet" type="text/css" href="/css/index.css?<?php echo rand();?>">
<div id="wrap1">
<?php
  include SITE_ROOT.'templates/head.php';
?>


<div class="content">
  <div class="content-container">


<?php

$food = getAllFood();
if(isset($food) && !empty($food)) {
foreach($food as $v) {

?>
  	<div class="recipe" style="position: relative;">


  		<div class="recipe-delete__wrap" style="" onclick="deletemon(42);event.preventDefault();"><img src="/images/icons/close.png"></div>



  	<div class="recipe-wrap">
  	  <div class="recipe-photo__wrap">
  	  	<img src="/images/download.png" class="recipe-photo">
  	  </div>
  	  <div class="recipe-photo__info__wrap">
  	  	<div class="recipe-photo__title"><a class="recipe-photo__title_text">нарткои</a></div>
  	  	<div class="recipe-photo__text">нарткои</div>
  	  	<div class="recipe-photo__text_date_created">24 dec of 2021</div>
  	  	<div class="recipe-photo__author"><a href="/" class="recipe-photo__author_link">нарткои</a></div>
  	  </div>
  	</div>
  	</div>

<?php
}
}
?>


  </div>
</div>

<div style="clear: both;"></div>

<?php
  include SITE_ROOT.'templates/footer.php';
?>


</div>

</body>

</html>