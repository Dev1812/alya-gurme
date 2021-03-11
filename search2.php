<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
  session_set_cookie_params(199999);
  ini_set('session.gc_maxlifetime', 199999);
  ini_set('session.cookie_lifetime', 199999);
  session_name('sid');
  session_start();

ob_start();
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  define('TITLE', 'Админ-панель');
  define('SITE_NAME', 'Аля гурме');

 // include SITE_ROOT.'lib/database.php';
  include SITE_ROOT.'lib/reg.php';
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<?php

 
  include SITE_ROOT.'template/header.php';
?>

<body>


<?php

include SITE_ROOT.'template/head.php';
?>


<div class="content">

<div class="wrap1">
  
<?php

  //var_dump($_SESSION);
  if(!empty($_POST['reg_submit'])) {
   // $admin_login = auth($_POST['login_login'], $_POST['login_password']);


    $reg = reg($_POST['reg_first_name'], $_POST['reg_last_name'], $_POST['reg_email'], $_POST['reg_password']);


  }
?>

<style type="text/css">
  
.label{text-align: left;}
</style>


<div style="padding:45px 0;">
  <div style="width:510px;margin:0 auto;background-color:#FFF;padding:34px 34px;border:1px solid #DDD;border-radius:7px;">
    <div style="font-size:19px;margin-bottom:27px;text-transform: uppercase;font-weight:bold;">Поиск</div>
<FORM action="" method="GET">
  

<?php
  include SITE_ROOT.'lib/search.php';

$search = search($_GET['q']);
?>


    <div class="input_wrap">
      <input type="text" class="text_field" name="q" placeholder="Введите поисковый запрос" value="<?php echo $_GET['q'];?>">
    </div>

    <div>
      <input type="submit" class="button" name="search_submit" value="Найти" style="width: auto;padding:7px 14px;">
    </div>

   

</FORM>
<div style="margin-top:14px;">








<?php
if(empty($_GET['search_submit'])) {

} else {
$search = search($_GET['q']);
$search_count = count($search);
  echo '
Вот что удалось найти';
if($search_count == 0 && empty($_POST['reg_submit'])) {

    echo '<div style="text-align:center;padding:47px 0;color:#808080">Не найдено ни отдной записи</div>'; 
}

if($search === false || empty($search)) {

} else {
foreach($search as $v) {
$photo_path = !empty($v['photo_path']) ? $v['photo_path'] : 'image/download.png';
?>
<a href="/food.php?food_id=<?echo $v['id'];?>" target="_blank">
	<div style="padding:7px 0;">
<img style="width:44px;" src="<?php echo $photo_path;?>">

<span style="position:relative;top:-15px;left:9px;"><?php echo $v['title'];?></span></div></a>	
<?php
}
}}
?>
</div>



  </div>
</div>
<div class="clear"></div>

</div>
</div>

<?php
  include SITE_ROOT.'template/footer.php';

ob_end_flush();
?>

</body>
</html>