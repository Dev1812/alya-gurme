<?php
  ob_start();
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  define('TITLE', 'Аля гурме');
  define('SITE_NAME', 'Аля гурме');
  include SITE_ROOT.'templates/top_params.php';
  include SITE_ROOT.'libs/database.php';
  include SITE_ROOT.'libs/login.php';
  include SITE_ROOT.'libs/i18n.php';
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<?php

 
  include SITE_ROOT.'templates/header.php';
  include SITE_ROOT.'templates/gray_head.php';
  include SITE_ROOT.'templates/sidebar.php';
?>

<body>

	
<?php



include SITE_ROOT.'templates/head.php';
?>


<div class="content">

<div class="wrap1">
  
<?php

  $login = '';
  if(!empty($_POST['login_submit'])) {
    $login = login($_POST['login_email'], $_POST['login_password']);
  }
?>

<style type="text/css">  
.label{text-align: left;}
.form{background-color:#ffefe9;border:1px solid #f2ab99;padding:7px 12px;margin:7px 0 11px;}

.form__title{font-size:19px;margin-bottom:7px;font-weight:bold;}
.form__description{}
.login-container{padding:45px 0;}
.login-container__wrap{width:410px;margin:0 auto;background-color:#FFF;padding:34px 34px;border-radius:7px;border:1px solid #DDDFE1}
.login-container__title{font-size:19px;margin-bottom:27px;text-transform: uppercase;font-weight:bold}

.submit{width: auto;padding: 7px 14px;}
.restore{float: right;margin-top: 7px;}
.reg-wrap{text-align: center;margin-top:14px;padding:7px 0 0}
.not_registered{border-bottom:1px dashed #808080;padding:0 4px 4px 4px}

</style>



<div class="login-container">
  <div class="login-container__wrap">
    <div class="login-container__title">Вход</div>
<FORM action="" method="POST">
  

        <?php

        
        if(isset($login['error']['error_message']) && !empty($login['error']['error_message'])) {
?>
<div class="form">
<div class="form__title"><?php echo $login['error']["error_message"]['title'];?></div>
<div class="form__description"><?php echo $login['error']["error_message"]['description'];?></div>
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
      <input type="submit" class="button submit" name="login_submit" value="Войти">
      <a href="/restore.php" class="restore">Забыли пароль?</a>
    </div>

<div class="reg-wrap">
  
<a href="/reg.php" class="not_registered">Еще не зарегистрированы?</a>
</div>


</FORM>




  </div>
</div>
<div class="clear"></div>

</div>
</div>

<?php
  include SITE_ROOT.'templates/footer.php';

ob_end_flush();
?>

</body>
</html>