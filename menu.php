<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
  session_set_cookie_params(199999);
  ini_set('session.gc_maxlifetime', 199999);
  ini_set('session.cookie_lifetime', 199999);
  session_name('sid');
  session_start();
  

ob_start();

  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  include 'lib/user.php';
 // include 'lib/database.php';

if(empty($_SESSION['user_id'])) {
  header('Location: /');
}

$act = !empty($_GET['act']) ? $_GET['act'] : '';
switch($act) {

  case 'create_food':
    include 'template/create_food.php';
    break;




  case 'show_menu':
    include 'template/show_menu.php';
    break;





  default:
   //if(!isUserAuth()) {
      header('Location: /menu.php?act=show_menu');
  //  } else {
   //   header('Location: /menu.php?act=create_food');
   // }

    break;

}
?>