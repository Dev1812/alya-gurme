<?php
ob_start();
define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
define('TITLE', 'Меню | Аля-гурме');
define('SITE_NAME', 'Аля гурме');
include SITE_ROOT.'templates/top_params.php';
include SITE_ROOT.'libs/i18n.php';
  
ob_start();
include 'libs/user.php';
include SITE_ROOT.'libs/database.php';

if(empty($_SESSION['user_id'])) {
  header('Location: /login.php');
}

$act = !empty($_GET['act']) ? $_GET['act'] : '';
switch($act) {

  case 'create_food':
    include 'templates/create_food.php';
    break;

  case 'show_menu':
    include 'templates/show_menu.php';
    break;


  default:
    header('Location: /menu.php?act=show_menu');
    break;

}
?>