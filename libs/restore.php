<?php
define ('MIN_EMAIL', 4);
define ('MAX_EMAIL', 74);
  
  include SITE_ROOT.'libs/security.php';

function restore($email) {
  include SITE_ROOT.'libs/mail.php';

  $i18n = new i18n;
  
  $email = htmlspecialchars($email);
  $email_length = mb_strlen($email);

  
  $mail = new Mail;
  if($email_length < MIN_EMAIL) {
    return array('is_error'=>true, 'error'=>array('error_code'=>27, 'error_message'=>$i18n->get('short_email'), 'error_field'=>'email'));
  } else if($email_length > MAX_EMAIL) {
    return array('is_error'=>true, 'error'=>array('error_code'=>28, 'error_message'=>$i18n->get('long_email'), 'error_field'=>'email'));
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return array('is_error'=>true, 'error'=>array('error_code'=>29, 'error_message'=>$i18n->get('incorrect_email'), 'error_field'=>'email'));
  }

  $database = connectDatabase();

  $is_email_exist = $database->prepare("SELECT `id` FROM `users` WHERE `email` = :email");
  $is_email_exist->execute(array(':email' => $email));
  $row2 = $is_email_exist->fetch(PDO::FETCH_ASSOC);

  if(empty($row2['id'])) {
    return array('is_error'=>true, 'error'=>array('error_code'=>29, 'error_message'=>$i18n->get('not_auth'), 'error_field'=>'email'));

  }


  $is_email_exist = $database->prepare("SELECT `id`, `timestamp_created` FROM `restore` WHERE `email` = :email");
  $is_email_exist->execute(array(':email' => $email));
  $row1 = $is_email_exist->fetch(PDO::FETCH_ASSOC);


  if(!empty($row1['id'])) {

    $hash = hash('sha512', time().rand()); 
    $is_email_exist = $database->prepare("UPDATE `restore` SET `hash`=:hash WHERE `email` = :email");

    $is_email_exist->execute(array(':hash' =>  $hash,
                                   ':email' => $email));

    $mail = new Mail("mail.digitalwind9818.000webhostapp.com/"); 
    $mail->setFromName("Аля Гурме"); 
    if ($mail->send($email, "Восстановление пароля", 'Здравствуйте, для восстановления пароля перейдите по ссылке:
      <br /><b>письма <b><a herf="http://digitalwind9818.000webhostapp.com/restore.php?act=email_check&hash='.$hash.'"></a></b>')) {

    return array('is_error'=>false, 'messages' => array('title' =>'Успешно выполнено', 'description'=>'Пожалуйста, проверьте Ваш email'));

  $_SESSION['restore_email'] = $email;

    }  else {
       echo "Письмо не отправлено";
    }


  $_SESSION['restore_email'] = $email;
    return array('is_error'=>false, 'messages' => array('title' =>'Успешно выполнено', 'description'=>'Пожалуйста, проверьте Ваш email'));
  } else {


    $hash =  hash('sha512', time().rand()); 
  $is_email_exist = $database->prepare("INSERT INTO `restore`(`id`, `email`, `hash`, `timestamp_created`, `owner_id`) VALUES (
                                                             '',
                                                             :email,
                                                             :hash,
                                                             :timestamp_created,
                                                             :owner_id)");

  $is_email_exist->execute(array(':email' => $email,
                                 ':hash' => $hash,
                                 ':timestamp_created' => 'test',
                                 ':owner_id' => 'test'));


  $mail = new Mail("no-reply@mysite.ru"); 
        $mail->setFromName("Иван Иванов"); 
       if ($mail->send("abc@mail.ru", "Тестирование", 'Тестирование<br /><b>письма<b> <a herf="http://digitalwind9818.000webhostapp.com/restore.php?act=email_check&hash='.$hash
        .'"></a>')) {

  $_SESSION['restore_email'] = $email;
    return array('is_error'=>false, 'messages' => array('title' =>'Успешно выполнено', 'description'=>'Пожалуйста, проверьте Ваш email'));

  }



}
}

  define ('MIN_PASSWORD', 4);
  define ('MAX_PASSWORD', 54);


function savePassword($password) {

  $password = htmlspecialchars($password);

  $password_length = mb_strlen($password);
  $database = connectDatabase();



$i18n = new i18n;


  if($password_length < MIN_PASSWORD) {
    return array('is_error'=>true, 'error'=>array('error_code'=>30, 'error_message'=>$i18n->get('short_password'), 'error_field'=>'password'));
  } else if($password_length > MAX_PASSWORD) {
    return array('is_error'=>true, 'error'=>array('error_code'=>31, 'error_message'=>$i18n->get('long_password'), 'error_field'=>'password'));
  }
  $password_hashing = passwordHashing($password);
  $hashed_password = $password_hashing['hashed_password'];  
  $salt = $password_hashing['salt'];
  $timestamp_registered = time();

  $hash = hash('sha256', time().rand(0, 1000000));




  $restore_email = !empty($_SESSION['restore_email']) ? $_SESSION['restore_email'] : '';
 /// var_dump($restore_email);                                               
 // var_dump($_SESSION);  

  $is_email_exist = $database->prepare("UPDATE `users` SET `hashed_password`=:hashed_password,`salt`=:salt WHERE `email` = :email");
  $is_email_exist->execute(array(':email' => $restore_email,
                                 ':hashed_password' => $hashed_password,
                                 ':salt' => $salt));
  header('Location: /restore.php');
  return array('is_error' => false, 'message' => $i18n->get('change_password_success'));

  


}


?>