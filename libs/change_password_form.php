<?php
  ob_start();
  include SITE_ROOT.'templates/top_params.php';
?>

<?php
  if(isUserAuth()) {
   // header('Location: /menu.php');
  }
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<?php

 
  include SITE_ROOT.'templates/header.php';
?>

<link rel="stylesheet" type="text/css" href="/css/login.css?1">
<body>

  
<?php



include SITE_ROOT.'templates/head.php';
?>  


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
</div>

<?php
  include SITE_ROOT.'templates/footer.php';

ob_end_flush();
?>

</body>
</html>