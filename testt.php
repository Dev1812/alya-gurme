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
  include SITE_ROOT.'libs/user.php';
  include SITE_ROOT.'libs/database.php';
function deleteFood($food_id) {



  $link = connectDatabase();



  $is_email_exist = $link->prepare("SELECT `id`, `owner_id` FROM `food` WHERE `id` = :food_id");
  $is_email_exist->execute(array(':food_id' => $food_id));

     $row1 = $is_email_exist->fetch(PDO::FETCH_ASSOC);
/*
     $owner_id = !empty($row1['owner_id']) ? $row1['owner_id'] : '';
     $user_id = !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
     $user_type = !empty($_SESSION['user_type']) ? $_SESSION['user_type'] : '';

var_dump($owner_id);
  if($owner_id == $user_id || $user_type == 'admin') {*/


$user_type =  !empty($_SESSION['user_type']) ?  $_SESSION['user_type'] : '';
$user_id =  !empty($_SESSION['user_id']) ?  $_SESSION['user_id'] : '';


if($row1['owner_id'] == $user_id || $user_type == 'admin') {

//var_dump($_SESSION); /*
$sql = "UPDATE `food` SET `is_deleted`='true'  WHERE `id` = :food_id";
 // $is_email_exist = $link->prepare("UPDATE `food` SET `is_deleted`= 'true' WHERE `id` = :food_id");
  $is_email_exist = $link->prepare($sql);
  $is_email_exist->execute(array(':food_id' => $food_id));



//$sql = "UPDATE `food` SET `is_deleted`='true' WHERE `id` = :owner_id";

$sql = "DELETE FROM `food` WHERE `id` = :owner_id";

  $is_email_exist1 = $link->prepare($sql);
  $is_email_exist1->execute(array(':owner_id' => $food_id));


//var_dump($is_email_exist1);


return true;
  } 



}
deleteFood($_GET['photo_id']);
?>