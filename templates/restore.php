<?php
  $restore = '';
  if(!empty($_GET['restore_submit'])) {
      $restore = restore($_GET['restore_email']);
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
  include SITE_ROOT.'templates/gray_head.php';
  include SITE_ROOT.'templates/sidebar.php';
?>


<div class="content">

<div class="wrap1">

<style type="text/css">
  

.label{text-align: left;}


.restore-container{padding:45px 0;}
.restore-container__wrap{width:410px;margin:0 auto;background-color:#FFF;padding:34px 34px;border-radius:7px;border:1px solid #DDDFE1}
.restore-container__title{font-size:19px;margin-bottom:27px;text-transform: uppercase;font-weight:bold}

</style>






<div style="padding:45px 0;">

<div class="restore-container">
  <div class="restore-container__wrap">
    <div class="restore-container__title">Восстановление пароля</div>
<FORM action="/restore.php" method="GET">
  

        <?php
        if(isset($restore['error']['error_message']) && !empty($restore['error']['error_message'])) {
?>
<div class="form">
<div class="form__title"><?php echo $restore['error']["error_message"]['title'];?></div>
<div class="form__description"><?php echo $restore['error']["error_message"]['description'];?></div>
</div>
<?php

        } else if(!empty($restore['messages']['title'])) {
?>

<div class="form form-success">
<div class="form__title"><?php echo $restore['messages']['title'];?></div>
<div class="form__description"><?php echo $restore['messages']['description'];?></div>
</div>  
<?php
        }
        ?>
    <div class="label">Ваш email</div>
    <div class="input_wrap">
      <input type="text" class="text_field" name="restore_email" placeholder="Введите Ваш email" autofocus="">
    </div>

    <div>
      <input type="submit" class="button" name="restore_submit" value="Восстановить пароль" style="padding: 7px 14px;">
    </div>



<div style="text-align: center;margin-top:14px;padding:7px 0 0">
  
<a href="/reg.php" style="border-bottom:1px dashed #808080;padding:0 4px 4px 4px">Вход</a>
<div style="margin-top:14px;">
<a href="/reg.php" style="border-bottom:1px dashed #808080;padding:0 4px 4px 4px">Еще не зарегистрированы?</a>
</div>
</div>

</FORM>




  </div>
</div>







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