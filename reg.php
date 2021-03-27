<?php
if(!empty($_SESSION['user_id'])) {
    //header('Location: /menu.php');
  }
  ob_start();
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  define('TITLE', 'Админ-панель');
  define('SITE_NAME', 'Аля гурме');
  include SITE_ROOT.'templates/top_params.php';
  include SITE_ROOT.'libs/reg.php';
  include SITE_ROOT.'libs/database.php';
  include SITE_ROOT.'libs/i18n.php';
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
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

<div class="wrap1">
  
<?php
  if(!empty($_POST['reg_submit'])) {
    $reg = reg($_POST['reg_first_name'], $_POST['reg_last_name'], $_POST['reg_email'], $_POST['reg_password']);
  }
?>

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
  <div style="width:410px;margin:0 auto;background-color:#FFF;padding:34px 34px;border:1px solid #DDD;border-radius:7px;">
    <div style="font-size:19px;margin-bottom:27px;text-transform: uppercase;font-weight:bold;">Регистрация</div>
<FORM action="" method="POST">
  

        <?php

        if(isset($reg['error']['error_message']['title']) && !empty($reg['error']['error_message']['title'])) {
?>
<div class="form">
<div class="form__title"><?php echo $reg['error']["error_message"]['title'];?></div>
<div class="form__description"><?php echo $reg['error']["error_message"]['description'];?></div>
</div>
<?php

        }
        ?>

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
      <input type="submit" class="button" name="reg_submit" value="Зарегестрироваться">
    </div>

<div style="text-align: center;margin-top:14px;padding:7px 0 0">
  
<a href="/login.php" style="border-bottom:1px dashed #808080;padding:0 4px 4px 4px">Авторизация</a>
</div>
  

</FORM>




  </div>
</div>
<div class="clear"></div>

</div>
</div>

<?php
  include SITE_ROOT.'templates/footer.php';

?>

</body>
</html>