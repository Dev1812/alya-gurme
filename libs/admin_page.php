<?php
define('MIN_EMAIL', 4);
define('MAX_EMAIL', 74);

define('MIN_PASSWORD', 4);
define('MAX_PASSWORD', 74);

function checkPassword($hashed_password, $password, $salt) {
    return (crypt($password, $salt) == $hashed_password) ? true : false;
}


function auth($email, $password) {
  $email = htmlspecialchars($email);
  $email_length = mb_strlen($email);

  $password = htmlspecialchars($password);
  $password_length = mb_strlen($password);

  $i18n = new i18n;
  
  if($email_length < MIN_EMAIL) {
    return array('is_error'=>true, 'error'=>array('error_code'=>27, 'error_message'=>$i18n->get('short_email'), 'error_field'=>'email'));
  } else if($email_length > MAX_EMAIL) {
    return array('is_error'=>true, 'error'=>array('error_code'=>28, 'error_message'=>$i18n->get('long_email'), 'error_field'=>'email'));
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return array('is_error'=>true, 'error'=>array('error_code'=>29, 'error_message'=>$i18n->get('incorrect_email'), 'error_field'=>'email'));
  }

  if($password_length < MIN_PASSWORD) {
    return array('is_error'=>true, 'error'=>array('error_code'=>30, 'error_message'=>$i18n->get('short_password'), 'error_field'=>'password'));
  } else if($password_length > MAX_PASSWORD) {

    return array('is_error'=>true, 'error'=>array('error_code'=>31, 'error_message'=>$i18n->get('long_password'), 'error_field'=>'password'));
  }






  $link = connectDatabase();

  
  $login = $link->prepare("SELECT `id`, `first_name`, `last_name`, `email`, `hashed_password`, `salt`, `photo_path`, `type` FROM `users` WHERE `email` = :email");
  $login->execute(array(':email' => $email));
  $row1 = $login->fetch(PDO::FETCH_ASSOC);
  if(checkPassword($row1['hashed_password'], $password, $row1['salt'])) {
    if($row1['type'] != 'admin') {
          return array('is_error'=>true, 'error'=>array('error_code'=>31, 'error_message'=>'incorrect_login_or_password','error_field'=>'email'));
    }
     $_SESSION['user_id'] = isset($row1['id']) && !empty($row1['id']) ? $row1['id'] : '';
     $_SESSION['first_name'] = isset($row1['first_name']) && !empty($row1['first_name']) ? $row1['first_name'] : '';
     $_SESSION['last_name'] = isset($row1['last_name']) && !empty($row1['last_name']) ? $row1['last_name'] : '';
     $_SESSION['photo_path'] = isset($row1['photo_path']) && !empty($row1['photo_path']) ? $row1['photo_path'] : '';
     $_SESSION['user_type'] = isset($row1['type']) && !empty($row1['type']) ? $row1['type'] : '';
     var_dump($_SESSION);
//     header('Location: /admin.php?act=show_menu');

  } else {
    return array('is_error'=>true, 'error'=>array('error_code'=>31, 'error_message'=>$i18n->get('incorrect_login_or_password'),'error_field'=>'email'));
  }

}

function createFood($title,$description,$c) {

  $link = connectDatabase();

  $sql = "INSERT INTO `food`(`id`,
                             `photo_path`,
                             `owner_id`,
                             `timestamp_created`,
                             `title`,
                             `description`) VALUES (
                             '',
                             :photo_path,
                             :owner_id,
                             :timestamp_created,
                             :title,
                             :description)";


  $is_email_exist = $link->prepare($sql);
  $is_email_exist->execute(array(':photo_path' => 'photo_path',
                                 ':owner_id' => '67',
                                 ':timestamp_created'=> '8',
                                 ':title' => $title,
                                 ':description' => $description));

 
return array('lol'=>$link->lastInsertId());
}

 

?>