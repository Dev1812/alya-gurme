<?php
  ob_start();
  //include SITE_ROOT.'template/top_params.php';
?>

<?php
  if(isUserAuth()) {
   // header('Location: /menu.php');
  }
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<?php

 
  include SITE_ROOT.'template/header.php';
?>

<link rel="stylesheet" type="text/css" href="/css/login.css?1">
<body>

  
  <style type="text/css">
    

body{

}


  </style>

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
    <div style="font-size:19px;margin-bottom:27px;text-transform: uppercase;font-weight:bold;">Смена пароля</div>
<FORM action="/restore.php?act=set_new_password" method="POST">
  

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
    <div class="label">Ваш новый пароль</div>
    <div class="input_wrap">
      <input type="text" class="text_field" name="restore_password" placeholder="Введите Ваш новый пароль" autofocus="">
    </div>


    <div>
      <input type="submit" class="button" name="restore_submit" value="Восстанововить пароль" style="padding: 7px 14px;">

    </div>


    </div>



</FORM>



</div>
  </div>
</div>
<div class="clear"></div>

</div>


<!--
<div class="content">

<div class="wrap1">
  
<?php
  $restore = '';
  if(!empty($_POST['restore_submit'])) {
    $restore_password = !empty($_POST['restore_password']) ? $_POST['restore_password'] : '';
    $restore = savePassword($restore_password);
  }
?>

<style type="text/css">
  
.label{text-align: left;}
</style>

<div class="login-container">
  <div class="login-wrap">
    <div class="login-container__title">Смена пароля</div>
<FORM action="/restore.php?act=set_new_password" method="POST">



        <?php
          if(isset($restore['error']) && !empty($restore['error'])) {
        ?>
<div class="form-message form-message__error">
  <div class="form-message__title"><?php echo $restore['error']["error_message"]["title"];?></div>
  <div class="form-message__text"><?php echo $restore['error']["error_message"]["description"];?></div>
</div>
        <?php
}
        ?>
  
    <div class="label">Ваш новый пароль</div>
    <div class="input_wrap">
      <input type="text" class="text_field" name="restore_password" placeholder="Введите Ваш новый пароль" autofocus="">
    </div>


    <div>
      <input type="submit" class="button" name="restore_submit" value="Восстанововить пароль" style="padding: 7px 14px;">

    </div>


</FORM>




  </div>
</div>
<div class="clear"></div>

</div>
</div>-->

<?php
  include SITE_ROOT.'template/footer.php';

ob_end_flush();
?>

</body>
</html>