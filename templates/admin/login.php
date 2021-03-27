<?php
  /*
  if(isUserAuth()) {
    header('Location:/admin.php?act=create_food');
  }*/
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

  $admin_login = array();
  if(!empty($_POST['login_submit'])) {
    $admin_login = auth($_POST['login_login'], $_POST['login_password']);
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


<div style="padding:45px 0 124px;">
  <div style="width:410px;margin:0 auto;background-color:#FFF;padding:34px 34px;border:1px solid #DDDFE1;border-radius:7px;">
    <div style="font-size:19px;margin-bottom:27px;text-transform: uppercase;font-weight:bold;">Войти в Админ-паенль</div>
<FORM action="" method="POST">
  

        <?php
        if(isset($admin_login['error']['error_message']) && !empty($admin_login['error']['error_message'])) {
?>
<div class="form">
<div class="form__title"><?php echo $admin_login['error']["error_message"]['title'];?></div>
<div class="form__description"><?php echo $admin_login['error']["error_message"]['description'];?></div>
</div>
<?php

        }
        ?>


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
  include SITE_ROOT.'templates/footer.php';

?>

</body>
</html>