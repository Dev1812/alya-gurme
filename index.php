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

<div id="wrap1">
	<style type="text/css">
.content{background-color: #F7F9FB}





.footer{    text-align: center;
    padding: 25px 0 24px;
    border-top: 1px solid #DDDFE1;
    background-color: #FFF;
    line-height: 34px;
}

	</style>


<?php
  include SITE_ROOT.'templates/head.php';
?>


<div class="content">
	ЕУЫЕ
</div>

<?php
  include SITE_ROOT.'templates/footer.php';
?>


</div>

</body>

</html>