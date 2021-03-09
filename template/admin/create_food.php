<?php
  if(!isUserAuth()) {
    header('Location: /login.php');
  }
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  define('TITLE', 'Создание рецепта');
  define('SITE_NAME', 'Аля гурме');
?>
<?php
/*
  if(!empty($_POST['create_food_submut'])) {
    echo json_encode(createFood($_POST['create_food_title'], $_POST['create_food_desc'], $_POST['create_food_atach_files']));
   exit;
  }
*/
?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>

<?php
  include SITE_ROOT.'template/header.php';
?>

<body>

<?php

include SITE_ROOT.'temlate/head.php';
?>

<div class="content">



<?php

var_dump($_POST);
var_dump($_FILES);
?>

<div class="wrap1" style="padding:27px 37px 27px;text-align:left;width:540px;margin:27px auto;background-color: #FFF;border-radius:4px;border:1px solid #DDDFE1">


  <div style="font-size: 23px;margin-bottom:17px;text-align: center;">Создание рецепта</div>
  <div>Название</div>

  <FORM action="" method="POST" onSubmit="sennd();event.preventDefault();" enctype="multipart/form-data">
  <div style="padding:14px 0 14px;">
    <input type="text" id="create_food_title" name="create_food_title" class="text_field" placeholder="Название рецепта" autofocus="">
  </div>
  <div>Описание</div>
  <div style="padding:14px 0 14px;">
    <TEXTAREA class="text_field" style="height:207px;
    padding: 6px 14px;background-color: #FFF;" id="create_food_description" placeholder="Описание рецепта" name="create_food_description"></TEXTAREA>
  </div>

  <div style="padding:14px 0 0;">



<style type="text/css">
.nicEdit-main{background-color: #FFF;} 
.upload-files__container{margin-bottom:14px;}
.upload-file__progres{min-width:0;height:21px;transition:all 0.9s ease;background-color: #536e7b;text-align:center;color:#FFF;border-radius:7px;}
.upload-file__block{width:240px;height:21px;background-color:#DDD;width: 100%;margin-bottom:14px;}

.nicEdit-main  img {width:170px!important}  
</style>
<div id="upload-files__container">
	
</div>

  	<script type="text/javascript">

  	</script>

<div class="clear"></div>
  </div>

<div id="sample">
  <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>








<div style="margin-bottom: 17px;">Фото:</div>
<input type="file" name="TEST">

<div class="clear"></div>
  <div style="padding:14px 0 14px;">
    <input type="submit" name="create_food_submut" class="button" value="Создать рецепт" style="width:auto;padding:7px 24px;">
  </div>
</FORM>

</div>
</div>

<?php
  include SITE_ROOT.'template/footer.php';
?>

</body>
</html>