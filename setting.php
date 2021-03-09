<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
  session_set_cookie_params(199999);
  ini_set('session.gc_maxlifetime', 199999);
  ini_set('session.cookie_lifetime', 199999);
  session_name('sid');
  session_start();
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  define('TITLE', 'Аля гурме');
  define('SITE_NAME', 'Аля гурме');
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>

<?php
  include SITE_ROOT.'template/header.php';
?>
<style type="text/css">
  /*

.food{float:left;width:270px;height:353px;overflow:hidden;cursor:pointer;transition:all 0.3s ease;border-radius:7px;text-align: center;}
.food:hover {box-shadow: 0 0 51px #b7b1b1;background-color: #FFF;}
.food-photo__img{width:100%;border-radius:7px;height: 189px}
.food-title{font-size:24px;padding:7px 0 7px;color: #607d8b;text-transform:uppercase;font-size:18px;font-weight:bold;}
.food-wrap{padding:24px 14px;line-height:24px;}
.food-description{
  
    max-height: 42px;
    overflow: hidden;
}*/

</style>


<body>


<?php


  include SITE_ROOT.'template/head.php';
?>


<div class="content">
<div class="wrap1">

  












    <div class="setting-block" style="max-width:510px;margin:0 auto;padding:14px 0 14px;background-color: #FFF;padding:24px 24px;margin-bottom:24px;border:1px solid #DDD">




<?php
if($_POST['new_submit']) {

  define('MIN_FIRSTNAME', 3);
  define('MAX_FIRSTNAME', 74);

  define('MIN_LASTNAME', 3);
  define('MAX_LASTNAME', 74);

  function editInfo($firstname, $lastname) {

 // include SITE_ROOT.'lib/database.php';
   $owner_id = intval($_SESSION['user_id']);

  $firstname_length = htmlspecialchars($firstname);
  $lastname = htmlspecialchars($lastname);

  $firstname_length = mb_strlen($firstname);
  $lastname_length = mb_strlen($lastname);

  if($firstname_length < MIN_FIRSTNAME) {
    var_dump(array('is_error'=>true, 'error'=>array('error_code'=>21, 'error_message'=>'error', 'error_field'=>'firstname')));
  } else if($firstname_length > MAX_FIRSTNAME) {
    var_dump(array('is_error'=>true, 'error'=>array('error_code'=>22, 'error_message'=>'error', 'error_field'=>'firstname')));
  } else if(!preg_match('/^[а-яА-Яёa-zA-Z]*$/u', $firstname)) {
    var_dump(array('is_error'=>true, 'error'=>array('error_code'=>23, 'error_message'=>'error', 'error_field'=>'firstname')));
  }


  if($lastname_length < MIN_LASTNAME) {
    var_dump(array('is_error'=>true, 'error'=>array('error_code'=>21, 'error_message'=>'short_firstname', 'error_field'=>'firstname')));
  } else if($lastname_length > MAX_LASTNAME) {
    var_dump(array('is_error'=>true, 'error'=>array('error_code'=>22, 'error_message'=>'long_firstname', 'error_field'=>'firstname')));
  } else if(!preg_match('/^[а-яА-Яёa-zA-Z]*$/u', $lastname)) {
    var_dump(array('is_error'=>true, 'error'=>array('error_code'=>23, 'error_message'=>'incorrect_firstname', 'error_field'=>'firstname')));
  }
  $link = connectDatabase();



  $is_email_exist = $link->prepare("UPDATE `users` SET `first_name`= :first_name,`last_name`= :last_name WHERE `id` = :owner_id");
  $is_email_exist->execute(array(':first_name'=>$firstname,
                                 ':last_name' => $lastname,
                                 ':owner_id' => $owner_id));




/*
if($is_email_exist) {

  
     $_SESSION['first_name'] = $firstname;
     $_SESSION['last_name'] = $lastname;
     $_SESSION['photo_path'] = '';

  return 'success';

} */
return 'error';


  }
editInfo($_POST['new_firstname'], $_POST['new_lastname']);
}



























































if($_POST['upload_photo_submit']) {

var_dump('F');

  function uploadPhoto() {
    var_dump('ZI');
    $MaxFileSizeInBytes = 5242880;// Максимально допустимый размер загружаемого файла - 5Мб
    $MinFileSizeInBytes = 880;// Максимально допустимый размер загружаемого файла - 5Мб

    $AllowFileExtension = array('jpg', 'png', 'jpeg', 'gif', 'rar', 'zip', 'doc', 'pdf', 'djvu');// Разрешение расширения файлов для загрузки

  //  var_dump($_FILES);
    $FileName = $_FILES['photo_upload']['name'];// Оригинальное название файла
    $TempName = $_FILES['photo_upload']['tmp_name'];// Полный путь до временного файла

    var_dump($FileName);
    $UploadDir = "public/";// Папка где будут загружатся файлы   
    $NewFilePatch = $UploadDir.sha1($FileName.time()).'.jpeg';// Полный путь к новому файлу в папке сервера
if($FileName) {
    // Проверка если расширение файла находится в массиве доступных
    $FileExtension = pathinfo($FileName, PATHINFO_EXTENSION);
    if(!in_array($FileExtension, $AllowFileExtension)) {
        echo "Файлы с расширением {$FileExtension} не допускаются";
    }
     else {
         // Проверка размера файла
         if(filesize($TempName) > $MaxFileSizeInBytes) {
             echo "Размер загружаемого файла превышает 5МБ";
         }
         // Проверка размера файла
         if(filesize($TempName) < $MinFileSizeInBytes) {
             echo "Размер загружаемого файла менее 3МБ";
         }
          else {
              // Проверяем права доступа на папку
              if(!is_writable($UploadDir)) {
                  echo "Папка ".$UploadDir." не имеет прав на запись";
              }
               else {
                   // Копируем содержимое временного файла $TempName и создаем нового в папке сервера
                   $CopyFile = copy($TempName, $NewFilePatch);
                   if(!$CopyFile) {
                       echo "Возникла ошибка, файл не удалось загрузить!";
                   }
                    else {



$title = !empty($_POST['title']) ?  $_POST['title'] : 'Нет описания';
$owner_id = $_SESSION['user_id'];

$timestamp_created = time();











/***********************************************************************************
Функция img_resize(): генерация thumbnails
Параметры:
  $src             - имя исходного файла
  $dest            - имя генерируемого файла
  $width, $height  - ширина и высота генерируемого изображения, в пикселях
Необязательные параметры:
  $rgb             - цвет фона, по умолчанию - белый
  $quality         - качество генерируемого JPEG, по умолчанию - максимальное (100)
***********************************************************************************/
function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 100)
{  
    if (!file_exists($src))
        return false;
 
    $size = getimagesize($src);
      
    if ($size === false)
        return false;
 
    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
    $icfunc = 'imagecreatefrom'.$format;
     
    if (!function_exists($icfunc))
        return false;
 
    $x_ratio = $width  / $size[0];
    $y_ratio = $height / $size[1];
     
    if ($height == 0)
    { 
        $y_ratio = $x_ratio;
        $height  = $y_ratio * $size[1];
    }
    elseif ($width == 0)
    { 
        $x_ratio = $y_ratio;
        $width   = $x_ratio * $size[0];
    }
     
    $ratio       = min($x_ratio, $y_ratio);
    $use_x_ratio = ($x_ratio == $ratio);
     
    $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
    $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
    $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width)   / 2);
    $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);
      
    // если не нужно увеличивать маленькую картинку до указанного размера
    if ($size[0]<$new_width && $size[1]<$new_height)
    {
        $width = $new_width = $size[0];
        $height = $new_height = $size[1];
    }
 
    $isrc  = $icfunc($src);
    $idest = imagecreatetruecolor($width, $height);
      
    imagefill($idest, 0, 0, $rgb);
    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);
 
    $i = strrpos($dest,'.');
    if (!$i) return '';
    $l = strlen($dest) - $i;
    $ext = substr($dest,$i+1,$l);
     
    switch ($ext)
    {
        case 'jpeg':
        case 'jpg':
        imagejpeg($idest,$dest,$quality);
        break;
        case 'gif':
        imagegif($idest,$dest);
        break;
        case 'png':
        imagepng($idest,$dest);
        break;
    }
 
    imagedestroy($isrc);
    imagedestroy($idest);
 
    return true;  
}




$src = $NewFilePatch;
$photo_path = $src;
$dest = 'public/'.sha1(time()).'.jpg';

img_resize($src, $dest, 150, 70);

//var_dump($_SESSION['user_id']);




  $link = connectDatabase();

                        //echo "Файл успешно загружен!<br />Ссылка на файл: <a href='{$NewFilePatch}'>{$NewFilePatch}</a>";
$id = $_SESSION['user_id'];

var_dump($src);

    $reg_user = $link->prepare("UPDATE `users` SET `photo_path`=:photo_big_path WHERE `id`=:id");
    $reg_user->execute(array(':photo_big_path' => $dest,
                             ':id' => $id));


$_SESSION['photo_path'] = $src;


/*
    $target_id = $this->database->lastInsertId();
    $reg_user = $this->database->prepare("INSERT INTO `user_actions`(`id`, `owner_id`, `target_id`, `ts`, `type`, `is_deleted`) VALUES 
                                                                    ('',:owner_id,:target_id,:ts,:type,'0')");
    $owner_id = $_SESSION['user_id'];
    $ts=time();
    $reg_user->execute(array(':owner_id' => $owner_id,
                             ':target_id' => $target_id,
                             ':ts' => $ts,
                             ':type' => 'mem'));
*/




                    }
               }
          }
     }
}
  }uploadPhoto();

}













  $link = connectDatabase();



  $is_email_exist = $link->prepare("SELECT `id`, `first_name`, `last_name` FROM `users` WHERE `id` = :user_id");
  $is_email_exist->execute(array(':user_id'=>$_SESSION['user_id']));

  $info =  $is_email_exist->fetch(PDO::FETCH_ASSOC);


?>
  <div class="setting-block__title" style="margin-bottom: 14px;font-weight:bold;">Информация</div>


  <div class="form-message__global_wrap" id="form-message__global_wrap_user_info"></div>

  
<form action="" method="POST">
  
  <div class="input_wrap">
    <input type="text" name="new_firstname" class="text_field" placeholder="Ваше имя" id="edit_info_first_name">
    <div style="padding:4px 4px;font-size:13px;color:#808080">Старое имя: <?php echo $info['first_name'];?></div>
  </div>

  <div class="input_wrap">
    <input type="text" name="new_lastname" class="text_field" placeholder="Ваша фамилия" id="edit_info_last_name">
    <div style="padding:4px 4px;font-size:13px;color:#808080">Старая фамилия: <?php echo $info['last_name'];?></div>
  </div>


  <div class="input_wrap">
    <input type="submit" name="new_submit" value="Сохранить изменения" class="button" style="width:auto;padding:7px 14px;" onClick="Settings.changeUserInfo();">
  </div>
</form>



    </div>





    <div class="setting-block" style="max-width:510px;margin:0 auto;padding:14px 0 14px;background-color: #FFF;padding:24px 24px;margin-bottom:24px;border:1px solid #DDD">





  <div class="setting-block__title" style="margin-bottom: 14px;font-weight:bold;">Смена фото</div>
<form action="" method="POST" enctype="multipart/form-data">
  


<div>
  <input type="file" name="photo_upload">
</div>




  <div class="input_wrap">
    <input type="submit" name="upload_photo_submit" value="Сохранить фото" class="button" style="width:auto;padding:7px 14px;" onClick="Settings.changeUserInfo();">
  </div>



</form>



    </div>








  </div>

</div>
<?php
  include SITE_ROOT.'template/footer.php';
?>

</body>
</html>