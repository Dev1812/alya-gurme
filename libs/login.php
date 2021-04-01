<?php

  define ('MIN_EMAIL', 4);
  define ('MAX_EMAIL', 74);

  define ('MIN_PASSWORD', 4);
  define ('MAX_PASSWORD', 54);



  /**
   * @desc <string> hashed_password - Зашифрованный пароль
   * @desc <string> password        - Пароль, отправленный пользователем
   * @desc <string> salt            - Соль, например из базы данных
   *
   * @return <boolean> true           Если пароль + соль ==  хешированный пароль
   * @return <boolean> false          Если пароль + соль !=  хешированный пароль
   *
   */
  function checkPassword($hashed_password, $password, $salt) {
    return (crypt($password, $salt) == $hashed_password) ? true : false;
  }


function login($email, $password) {

  $email = htmlspecialchars($email);
  $password = htmlspecialchars($password);


  $email_length = mb_strlen($email);
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
  $database = connectDatabase();

  $is_email_exist = $database->prepare("SELECT `id`, `first_name`, `last_name`, `hashed_password`, `salt`, `photo_path`, `type` FROM `users` WHERE `email` = :email");


  $is_email_exist->execute(array(':email' => $email));
  $row1 = $is_email_exist->fetch(PDO::FETCH_ASSOC);


  if(checkPassword($row1['hashed_password'], $password, $row1['salt'])) {
    if($row1['type'] == 'admin') {

     $_SESSION['user_id'] = $row1['id'];
     $_SESSION['first_name'] = $row1['first_name'];
     $_SESSION['last_name'] = $row1['last_name'];
     $_SESSION['photo_path'] = !empty($row1['photo_path']) ? $row1['photo_path'] : '/image/Pmz7l.png';//Pmz7l
     $_SESSION['user_type'] = 'admin';
       header('Location: /admin.php?act=show_menu');
    } else {

       $_SESSION['user_id'] = $row1['id'];
       $_SESSION['first_name'] = $row1['first_name'];
       $_SESSION['last_name'] = $row1['last_name'];
       $_SESSION['photo_path'] = !empty($row1['photo_path']) ? $row1['photo_path'] : '/image/Pmz7l.png';//Pmz7l
       $_SESSION['user_type'] = 'user';
      header('Location: /menu.php');
    }
  } else {
    return array('is_error'=>true, 'error'=>array('error_code'=>31, 'error_message'=>$i18n->get('incorrect_login_or_password')));
  }
}


?>