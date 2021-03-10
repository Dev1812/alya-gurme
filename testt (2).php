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
  include SITE_ROOT.'lib/user.php';
  include SITE_ROOT.'lib/database.php';
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

var_dump($_SESSION); 

if($row1['owner_id'] == $user_id || $user_type == 'admin') {


  $is_email_exist = $link->prepare("UPDATE `food` SET `is_deleted`= 'true' WHERE `id` = :food_id");
  $is_email_exist->execute(array(':food_id' => $food_id));



return true;
  } 



}
deleteFood($_GET['photo_id']);
?>