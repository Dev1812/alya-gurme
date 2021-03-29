<?php
ob_start();
define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
define('TITLE', 'Админ-панель');
define('SITE_NAME', 'Аля гурме');
include SITE_ROOT.'templates/top_params.php';
include SITE_ROOT.'libs/user.php';
include SITE_ROOT.'libs/database.php';
function deleteFood($food_id) {
  $link = connectDatabase();
  $is_email_exist = $link->prepare("SELECT `id`, `owner_id` FROM `food` WHERE `id` = :food_id");
  $is_email_exist->execute(array(':food_id' => $food_id));
  $row1 = $is_email_exist->fetch(PDO::FETCH_ASSOC);

  $user_type =  !empty($_SESSION['user_type']) ?  $_SESSION['user_type'] : '';
  $user_id =  !empty($_SESSION['user_id']) ?  $_SESSION['user_id'] : '';

  if($row1['owner_id'] == $user_id || $user_type == 'admin') {
    $sql = "DELETE FROM `food` WHERE `id` = :owner_id";
    $is_email_exist1 = $link->prepare($sql);
    $is_email_exist1->execute(array(':owner_id' => $food_id));
    return true;
  } 
}
if(empty($_GET['photo_id'])) {
  return false;
}
deleteFood($_GET['photo_id']);