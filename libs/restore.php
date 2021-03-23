<?php
define ('MIN_EMAIL', 4);
define ('MAX_EMAIL', 74);
  
  include SITE_ROOT.'libs/security.php';

function restore($email) {
  include SITE_ROOT.'libs/mail.php';
  include SITE_ROOT.'libs/i18n.php';

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

  if(empty($row2['id'])) 
  {
    var_dump('user_not_created');
    return false;
  }




  $is_email_exist = $database->prepare("SELECT `id`, `timestamp_created` FROM `restore` WHERE `email` = :email");
  $is_email_exist->execute(array(':email' => $email));
  $row1 = $is_email_exist->fetch(PDO::FETCH_ASSOC);



  if(!empty($row1['id'])) {
  //var_dump('ya');

    $hash = hash('sha512', time().rand()); 
  $is_email_exist = $database->prepare("UPDATE `restore` SET `hash`=:hash WHERE `email` = :email");

  $is_email_exist->execute(array(':hash' =>  $hash,
                                 ':email' => $email));


  $mail = new Mail("no-reply@mysite.ru"); 
        $mail->setFromName("Иван Иванов"); 
       if ($mail->send("abc@mail.ru", "Тестирование", 'Тестирование<br /><b>письма<b> <a herf="http://local.qwerty.io/restore.php?act=email_check&hash='.$hash
        .'"></a>')) {

        echo "Письмо отправлено";
  $_SESSION['restore_email'] = $email;

    }  else {
       echo "Письмо не отправлено";
    }


  $_SESSION['restore_email'] = $email;
    return array('is_error'=>false, 'messages' => array('title' =>'Успешно выполнено', 'description'=>'Пожалуйста, проверьте Ваш email'));
  } else {

  var_dump('ya: 2');

    $hash = 'gsdg21';
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

    return array('is_error'=>false, 'messages' => array('title' =>'Успешно выполнено', 'description'=>'Пожалуйста, проверьте Ваш email'));

  }



}

function savePassword($password) {


  //include SITE_ROOT.'lib/database.php';

  $database = connectDatabase();

  $password_hashing = passwordHashing($password);
  $hashed_password = $password_hashing['hashed_password'];  
  $salt = $password_hashing['salt'];
  $timestamp_registered = time();

  $hash = hash('sha256', time().rand(0, 1000000));






  $password_hashing = passwordHashing($password);
  $hashed_password = $password_hashing['hashed_password'];  
  $salt = $password_hashing['salt'];
  $timestamp_registered = time();

  $hash = hash('sha256', time().rand(0, 1000000));





  $restore_email = !empty($_SESSION['restore_email']) ? $_SESSION['restore_email'] : '';
  var_dump($restore_email);                                               
  var_dump($_SESSION);  

  $is_email_exist = $database->prepare("UPDATE `users` SET `hashed_password`=:hashed_password,`salt`=:salt WHERE `email` = :email");
  $is_email_exist->execute(array(':email' => $restore_email,
                                 ':hashed_password' => $hashed_password,
                                 ':salt' => $salt));

  


}


?>