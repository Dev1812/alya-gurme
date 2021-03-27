<?php
ob_start();
define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
define('TITLE', 'Админ-панель');
define('SITE_NAME', 'Аля гурме');
include SITE_ROOT.'templates/top_params.php';
include SITE_ROOT.'libs/database.php';
include SITE_ROOT.'libs/settings.php';
include SITE_ROOT.'libs/i18n.php';

if(empty($_SESSION['user_id'])) {
  //header('Location: /login.php');
}
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

<div class="setting-block">




<?php
$new_submit = !empty($_POST['new_submit']) ? $_POST['new_submit'] : '';

if(!empty($new_submit)) {
  $edit_info = editInfo($_POST['new_firstname'], $_POST['new_lastname']);
}


$upload_photo_submit = !empty($_POST['upload_photo_submit']) ? $_POST['upload_photo_submit'] : '';

if(!empty($upload_photo_submit)) {
  uploadPhoto();

}
$info = init();

?>

  <div class="setting-block__title">Информация</div>


  <div class="form-message__global_wrap" id="form-message__global_wrap_user_info"></div>



        <?php
      //  var_dump($edit_info);

        if(isset($edit_info['error']['error_message']['title']) && !empty($edit_info['error']['error_message']['description'])) {
?>
<div class="form">
<div class="form__title"><?php echo $edit_info['error']["error_message"]['title'];?></div>
<div class="form__description"><?php echo $edit_info['error']["error_message"]['description'];?></div>
</div>
<?php

        } else if(!empty($edit_info['message']['title'])) {
?>

<div class="form form-success">
<div class="form__title"><?php echo $edit_info['message']['title'];?></div>
<div class="form__description"><?php echo $edit_info['message']['description'];?></div>
</div>  
<?php
        }
        ?>


  
<form action="" method="POST">
  
  <div class="input_wrap">
    <input type="text" name="new_firstname" class="text_field" placeholder="Ваше имя" id="edit_info_first_name" autofocus="">
    <div class="text_field_tips">Старое имя: <?php echo $info['first_name'];?></div>
  </div>

  <div class="input_wrap">
    <input type="text" name="new_lastname" class="text_field" placeholder="Ваша фамилия" id="edit_info_last_name">
    <div class="text_field_tips">Старая фамилия: <?php echo $info['last_name'];?></div>
  </div>


  <div class="input_wrap">
    <input type="submit" name="new_submit" value="Сохранить изменения" class="button" style="width:auto;padding:7px 14px;" onClick="Settings.changeUserInfo();">
  </div>
</form>



    </div>





    <div class="setting-block">



<?php

$photo_path = !empty($_SESSION['photo_path']) ? $_SESSION['photo_path'] : 'image/Pmz7l.png';

?>
<style type="text/css">
.setting-block{max-width:510px;margin:0 auto;padding:14px 0 14px;background-color: #FFF;padding:24px 24px;margin-bottom:24px;border:1px solid #DDD}
.setting-block__title{margin-bottom: 14px;font-weight:bold;}

.text_field_tips{padding:4px 4px;font-size:13px;color:#808080}
.setting-block__title{margin-bottom: 14px;font-weight:bold;}
.setting-block__title_wrap{float: left;}
.setting-block__title_wrap_image{width:52px}
.setting-block__wrap{margin-left:67px}
</style>

  <div class="setting-block__title">Смена фото</div>
<form action="" method="POST" enctype="multipart/form-data">
  <div class="setting-block__title_wrap"><img class="setting-block__title_wrap_image" src="<?php echo $photo_path;?>"></div>

<div class="setting-block__wrap">
  



<div>
  <input type="file" name="photo_upload">
</div>




  <div class="input_wrap">
    <input type="submit" name="upload_photo_submit" value="Сохранить фото" class="button" style="width:auto;padding:7px 14px;" onClick="Settings.changeUserInfo();">
  </div>





</div>


</form>



    </div>








  </div>

</div>
<?php
  include SITE_ROOT.'templates/footer.php';
?>

</body>
</html>