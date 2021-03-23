<?php
ob_start();
define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
define('TITLE', 'Выход');
define('SITE_NAME', 'Аля гурме');
include SITE_ROOT.'templates/top_params.php';

  ob_start();
?>

<?php
  include SITE_ROOT.'libs/user.php';
  include SITE_ROOT.'libs/database.php';
  include SITE_ROOT.'libs/restore.php';
//  include SITE_ROOT.'libs/i18n.php'
 // include SITE_ROOT.'libs/security.php';
  if(isUserAuth()) {
   // header('Location: /menu.php');
  }

  $act = '';

  if(!empty($_GET['act'])) {
    $act = $_GET['act'];
  }

  switch($act) {
    case 'email_check':
      // Сюда переходит пользователь с почты и тут надо сделать проверку на hash выборку и если есть то проверить время и если успешно редирект на установку нового пароя

        if(!empty($_GET['hash'])) {

  $database = connectDatabase();

  $is_email_exist = $database->prepare("SELECT `id`, `email`, `timestamp_created` FROM `restore` WHERE `hash` = :hash");
  $is_email_exist->execute(array(':hash' => $_GET['hash']));
  $row1 = $is_email_exist->fetch(PDO::FETCH_ASSOC);

if($row1['timestamp_created']) {

}
$_SESSION['is_restore'] = true;
//var_dump($row1);
$_SESSION['restore_email'] = $row1['email'];
header('Location: /restore.php?act=set_new_password&email='.$row1['email']);
}

      break;

    case 'set_new_password':
      
$is_restore = !empty($_SESSION['is_restore']) ? $_SESSION['is_restore']  : false;
//  if($is_restore === true) {
        
    include SITE_ROOT.'templates/change_password_form.php';

      
  //    }
      //  сюда saciton у формы
      //Сюда происходит сабмит и сюда перегаправляеи если успешно и тут action  у формы

      break;

  default:

    include SITE_ROOT.'templates/restore.php';


 //поазываем форму
    break;
}