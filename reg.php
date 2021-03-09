<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
  session_set_cookie_params(199999);
  ini_set('session.gc_maxlifetime', 199999);
  ini_set('session.cookie_lifetime', 199999);
  session_name('sid');
  session_start();

  if(!empty($_SESSION['user_id'])) {
    header('Location: /menu.php');
  }
ob_start();
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  define('TITLE', 'Админ-панель');
  define('SITE_NAME', 'Аля гурме');

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

  var_dump($_SESSION);
  if(!empty($_POST['reg_submit'])) {
   // $admin_login = auth($_POST['login_login'], $_POST['login_password']);


    $reg = reg($_POST['reg_first_name'], $_POST['reg_last_name'], $_POST['reg_email'], $_POST['reg_password']);


  }
?>

<style type="text/css">
  
.label{text-align: left;}
</style>


<div style="padding:45px 0;">
  <div style="width:410px;margin:0 auto;background-color:#FFF;padding:34px 34px;box-shadow:0 0 13px #EEE;border-radius:7px;">
    <div style="font-size:19px;margin-bottom:27px;text-transform: uppercase;font-weight:bold;">Регистрация</div>
<FORM action="" method="POST">
  


    <div class="label">Ваше имя</div>
    <div class="input_wrap">
      <input type="text" class="text_field" name="reg_first_name" placeholder="Введите Ваше имя" autofocus="">
    </div>



    <div class="label">Ваша фамилия</div>
    <div class="input_wrap">
      <input type="text" class="text_field" name="reg_last_name" placeholder="Введите Вашу фамилию" autofocus="">
    </div>

    <div class="label">Ваш email</div>
    <div class="input_wrap">
      <input type="text" class="text_field" name="reg_email" placeholder="Введите Ваш email" autofocus="">
    </div>

    <div class="label">Ваш пароль</div>
    <div class="input_wrap">
      <input type="text" class="text_field" name="reg_password" placeholder="Введите Ваш пароль">
    </div>

    <div>
      <input type="submit" class="button" name="reg_submit" value="Зарегистрироваться">
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