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

$user_type = !empty($_SESSION['user_type']) ? $_SESSION['user_type'] : '';
$act = !empty($_GET['act']) ? $_GET['act'] : '';

  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  include 'lib/user.php';
 // include 'lib/database.php';
  include 'lib/admin_page.php';


switch($act) {

  case 'show_menu':
    include 'template/admin/show_menu.php';
    break;


  case 'create_food':
    include 'template/admin/create_food.php';
    break;



  case 'ajax_create_food':
    include 'template/admin/ajax_create_food.php';
    break;


  case 'upload_photo':
    include 'lib/upload_photo.php';
    break;



  default:
    if(!isUserAuth()) {
      include 'template/admin/login.php';
    } else if($_SESSION['user_type'] == 'admin') {
      include 'template/admin/show_menu.php';
    } else {
      header('Location: /');
    }
    break;

}
?>