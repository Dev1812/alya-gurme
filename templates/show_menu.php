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

<div class="wrap1" style="padding:77px 0 77px;max-width:400px;  margin:0 auto;">
  <div style="font-size: 23px;margin-bottom:14px;">Панель пользователя</div>
  <div style="padding:14px 0 14px;"><a href="/menu.php?act=create_food" style="border-bottom: 1px dashed blue;">Создать рецепт</a></div>
  <div style="padding:14px 0 14px;"><a href="/index.php" style="border-bottom: 1px dashed blue;">Удалить мой рецепт</a></div>
  <div style="padding:14px 0 14px;"><a href="/logout.php" style="border-bottom: 1px dashed blue">Выход</a></div>
</div>
</div>

<?php
  include SITE_ROOT.'template/footer.php';
?>

</body>
</html>