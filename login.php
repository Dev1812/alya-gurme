<?php

  if(!empty($_SESSION['user_id'])) {
    header('Location: /menu.php');
  }
ob_start();
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  define('TITLE', 'Админ-панель');
  define('SITE_NAME', 'Аля гурме');

  //include SITE_ROOT.'lib/database.php';
  include SITE_ROOT.'lib/login.php';
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

  $login = '';
  if(!empty($_POST['login_submit'])) {
   // $admin_login = auth($_POST['login_login'], $_POST['login_password']);


    $login = login($_POST['login_email'], $_POST['login_password']);


  }
?>

<style type="text/css">
  
.label{text-align: left;}
</style>

<style type="text/css">
  
.label{text-align: left;}
.form{
  background-color:#ffefe9;
  border:1px solid #f2ab99;
  padding:7px 12px;
  margin:7px 0 11px;
}

.form__title{font-size:19px;margin-bottom:7px;font-weight:bold;}
.form__description{}
.forma{}
</style>



<div style="padding:45px 0;">
  <div style="width:410px;margin:0 auto;background-color:#FFF;padding:34px 34px;border-radius:7px;border:1px solid #DDDFE1  ">
    <div style="font-size:19px;margin-bottom:27px;text-transform: uppercase;font-weight:bold;">Вход</div>
<FORM action="" method="POST">
  

        <?php
        if(isset($login['error']['error_message']) && !empty($login['error']['error_message'])) {
?>
<div class="form">
<div class="form__title"><?php echo $login['error']["error_message"];?></div>
<div class="form__description"><?php echo $login['error']["error_message"];?></div>
</div>
<?php

        }
        ?>
    <div class="label">Ваш email</div>
    <div class="input_wrap">
      <input type="text" class="text_field" name="login_email" placeholder="Введите Ваш email" autofocus="">
    </div>

    <div class="label">Ваш пароль</div>
    <div class="input_wrap">
      <input type="text" class="text_field" name="login_password" placeholder="Введите Ваш пароль">
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