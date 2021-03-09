<?php
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  define('TITLE', 'Главная');
  include SITE_ROOT.'libs/top_vars.php';
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<?php
  include SITE_ROOT.'templates/header.php';
?>
<head>
	
</head>

<body>

<div id="wrap1" style="background-color: #F7F9FB">
	<style type="text/css">
.content{background-color: #F7F9FB}





.footer{    text-align: center;
    padding: 25px 0 24px;
    border-top: 1px solid #DDDFE1;
    background-color: #FFF;
    line-height: 34px;
}


.content-container{width:740px;margin:0 auto;padding:14px 0;}

.recipe{width:246.666666667px;float: left;padding:24px 0;}
.recipe-wrap{padding:7px 17px}
.recipe-photo{width: 100%}
.content{background-color: #F7F9FB}

	</style>


<?php
  include SITE_ROOT.'templates/head.php';
?>


<div class="content">
  <div class="content-container">


<?php
for($i=0;$i<7;$i++) {
?>
  	<div class="recipe" style="position: relative;">

  		<div style="    position: absolute;
    top: 0;
    right: 0;
    padding: 5px 5px;
    background: #000;
    cursor: pointer;
    margin: 30px 18px 0 0" onclick="deletemon(42);event.preventDefault();"><img src="/images/icons/close.png"></div>



  	<div class="recipe-wrap">
  	  <div class="recipe-photo__wrap">
  	  	<img src="/images/download.png" class="recipe-photo">
  	  </div>
  	  <div class="recipe-photo__info" style="text-align: center;margin-top:7px;margin-bottom:7px;">
  	  	<div class="recipe-photo__title"><a style="font-weight: bold;">нарткои</a></div>
  	  	<div class="recipe-photo__text" style="padding:3px 0 3px">нарткои</div>
  	  	<div class="recipe-photo__author"><a href="/" style="border-bottom:1px dashed #607d8b">нарткои</a></div>
  	  </div>
  	</div>
  	</div>

<?php
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