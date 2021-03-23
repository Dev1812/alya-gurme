<?php

  define('MIN_FIRSTNAME', 3);
  define('MAX_FIRSTNAME', 74);

  define('MIN_LASTNAME', 3);
  define('MAX_LASTNAME', 74);


  function editInfo($firstname, $lastname) {


   if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
   return array();
   } else {
    $user_id = $_SESSION['user_id'];
   }
   $owner_id = intval($user_id);

  $firstname_length = htmlspecialchars($firstname);
  $lastname = htmlspecialchars($lastname);

  $firstname_length = mb_strlen($firstname);
  $lastname_length = mb_strlen($lastname);

  if($firstname_length < MIN_FIRSTNAME) {
    return array('is_error'=>true, 'error'=>array('error_code'=>21, 'error_message'=>'error', 'error_field'=>'firstname'));
  } else if($firstname_length > MAX_FIRSTNAME) {
    return array('is_error'=>true, 'error'=>array('error_code'=>22, 'error_message'=>'error', 'error_field'=>'firstname'));
  } else if(!preg_match('/^[а-яА-Яёa-zA-Z]*$/u', $firstname)) {
    return array('is_error'=>true, 'error'=>array('error_code'=>23, 'error_message'=>'error', 'error_field'=>'firstname'));
  }


  if($lastname_length < MIN_LASTNAME) {
    return array('is_error'=>true, 'error'=>array('error_code'=>21, 'error_message'=>'short_firstname', 'error_field'=>'firstname'));
  } else if($lastname_length > MAX_LASTNAME) {
    return array('is_error'=>true, 'error'=>array('error_code'=>22, 'error_message'=>'long_firstname', 'error_field'=>'firstname'));
  } else if(!preg_match('/^[а-яА-Яёa-zA-Z]*$/u', $lastname)) {
    return array('is_error'=>true, 'error'=>array('error_code'=>23, 'error_message'=>'incorrect_firstname', 'error_field'=>'firstname'));
  }
  $link = connectDatabase();



  $is_email_exist = $link->prepare("UPDATE `users` SET `first_name`= :first_name,`last_name`= :last_name WHERE `id` = :owner_id");
  $is_email_exist->execute(array(':first_name'=>$firstname,
                                 ':last_name' => $lastname,
                                 ':owner_id' => $owner_id));
  
     $_SESSION['first_name'] = $firstname;
     $_SESSION['last_name'] = $lastname;
  return 'error';
  }
























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










  function uploadPhoto() {
        $MaxFileSizeInBytes = 5242880;// Максимально допустимый размер загружаемого файла - 5Мб
    $MinFileSizeInBytes = 880;// Максимально допустимый размер загружаемого файла - 5Мб

    $AllowFileExtension = array('jpg', 'png', 'jpeg', 'gif', 'rar', 'zip', 'doc', 'pdf', 'djvu');// Разрешение расширения файлов для загрузки

  //  var_dump($_FILES);
    $FileName = $_FILES['photo_upload']['name'];// Оригинальное название файла
    $TempName = $_FILES['photo_upload']['tmp_name'];// Полный путь до временного файла

    //var_dump($FileName);
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





$src = $NewFilePatch;
$photo_path = $src;
$dest = 'public/'.sha1(time().rand()).'.jpg';

img_resize($src, $dest, 150, 70);

//var_dump($_SESSION['user_id']);




  $link = connectDatabase();

                        //echo "Файл успешно загружен!<br />Ссылка на файл: <a href='{$NewFilePatch}'>{$NewFilePatch}</a>";
$id = $_SESSION['user_id'];

//var_dump($src);

    $reg_user = $link->prepare("UPDATE `users` SET `photo_path`=:photo_big_path WHERE `id`=:id");
    $reg_user->execute(array(':photo_big_path' => $dest,
                             ':id' => $id));


$_SESSION['photo_path'] = $src;



                    }
               }
          }
     }
}
  }








  function init() {

  $link = connectDatabase();



  if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    //return array();
  } else {
    $user_id = $_SESSION['user_id'];
  }

  $user_id = !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

  $is_email_exist = $link->prepare("SELECT `id`, `first_name`, `last_name` FROM `users` WHERE `id` = :user_id");
  $is_email_exist->execute(array(':user_id'=>$user_id));

    return $is_email_exist->fetch(PDO::FETCH_ASSOC);
  }

  ?>


