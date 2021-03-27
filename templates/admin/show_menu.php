<?php
/*
define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
define('TITLE', 'Аля гурме');
define('SITE_NAME', 'Аля гурме');*/

  
?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd"><html>

<?php
  include SITE_ROOT.'templates/header.php';
?>

<body>




<?php
include SITE_ROOT.'templates/head.php';
  include SITE_ROOT.'templates/gray_head.php';
  include SITE_ROOT.'templates/sidebar.php';
?>



<div class="content">

<div class="wrap1" style="padding:77px 0 77px;max-width:400px;  margin:0 auto;">
  <div style="font-size: 23px;margin-bottom:14px;">Админ-панель</div>
  <div style="padding:14px 0 14px;"><a href="/menu.php?act=create_food" style="border-bottom: 1px dashed blue;">Создать запись</a></div>
  <div style="padding:14px 0 14px;"><a href="/index.php" style="border-bottom: 1px dashed blue;">Удалить запись</a></div>
  <div style="padding:14px 0 14px;"><a href="/logout.php" style="border-bottom: 1px dashed blue">Выход</a></div>
</div>
</div>

<?php
  include SITE_ROOT.'templates/footer.php';
?>

</body>
</html>