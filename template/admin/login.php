<?php
ob_start();
  define('TITLE', 'Админ-панель');
  define('SITE_NAME', 'Аля гурме');
  if(isUserAuth()) {
    header('Location:/admin.php?act=create_food');
  }
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

  $admin_login = '';
  if(!empty($_POST['login_submit'])) {
    $admin_login = auth($_POST['login_login'], $_POST['login_password']);
  }
  
?>

<style type="text/css">
  
.label{text-align: left;}
</style>


<div style="padding:45px 0 124px;">
  <div style="width:410px;margin:0 auto;background-color:#FFF;padding:34px 34px;border:1px solid #DDDFE1;border-radius:7px;">
    <div style="font-size:19px;margin-bottom:27px;text-transform: uppercase;font-weight:bold;">Войти в Админ-паенль</div>
<FORM action="" method="POST">
  


    <div class="label">Ваш email</div>
    <div class="input_wrap">
      <input type="text" class="text_field" name="login_login" placeholder="Ваш email" autofocus="" value="admin@mail.ru">
    </div>

    <div class="label">Ваш пароль</div>
    <div class="input_wrap">
      <input type="text" class="text_field" name="login_password" placeholder="Ваш пароль" value="admin">
    </div>

    <div>
      <input type="submit" class="button" name="login_submit" value="Войти">
    </div>



</FORM>




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