<?php
ob_start();
define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
define('TITLE', 'Админ-панель');
define('SITE_NAME', 'Аля гурме');
include SITE_ROOT.'templates/top_params.php';
include SITE_ROOT.'libs/database.php';
include SITE_ROOT.'libs/i18n.php';

$user_type = !empty($_SESSION['user_type']) ? $_SESSION['user_type'] : '';
$act = !empty($_GET['act']) ? $_GET['act'] : '';

include 'libs/user.php';
include 'libs/admin_page.php';

switch($act) {

  case 'show_menu':
    include 'templates/admin/show_menu.php';
    break;


  case 'create_food':
    include 'templates/admin/create_food.php';
    break;



  case 'ajax_create_food':
    include 'templates/admin/ajax_create_food.php';
    break;


  case 'upload_photo':
    include 'libs/upload_photo.php';
    break;


  default:
    if(!isUserAuth()) {
      include 'templates/admin/login.php';
    } else if($_SESSION['user_type'] == 'admin') {
      include 'templates/admin/show_menu.php';
    } else {
      include 'templates/admin/login.php';
    }
    break;

}
?>