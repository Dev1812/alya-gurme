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
 // include 'lib/database.php';






  $email = htmlspecialchars($email);
  $password = htmlspecialchars($password);


  $email_length = mb_strlen($email);
  $password_length = mb_strlen($password);

  

  if($email_length < MIN_EMAIL) {
    return array('is_error'=>true, 'error'=>array('error_code'=>27, 'error_message'=>'short_email', 'error_field'=>'email'));
  } else if($email_length > MAX_EMAIL) {
    return array('is_error'=>true, 'error'=>array('error_code'=>28, 'error_message'=>'long_email', 'error_field'=>'email'));
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return array('is_error'=>true, 'error'=>array('error_code'=>29, 'error_message'=>'incorrect_email', 'error_field'=>'email'));
  }

  if($password_length < MIN_PASSWORD) {
    return array('is_error'=>true, 'error'=>array('error_code'=>30, 'error_message'=>'short_password', 'error_field'=>'password'));
  } else if($password_length > MAX_PASSWORD) {
    return array('is_error'=>true, 'error'=>array('error_code'=>31, 'error_message'=>'long_password', 'error_field'=>'password'));
  }
  $database = connectDatabase();

  $is_email_exist = $database->prepare("SELECT `id`, `first_name`, `last_name`, `hashed_password`, `salt`, `is_admin` FROM `users` WHERE `email` = :email");

//var_dump($row1);

//var_dump($row1);



  $is_email_exist->execute(array(':email' => $email));
  $row1 = $is_email_exist->fetch(PDO::FETCH_ASSOC);

  if(checkPassword($row1['hashed_password'], $password, $row1['salt'])) {
    if($row1['is_admin'] == true) {

      return array('is_error'=>true, 'error'=>array('error_code'=>31, 'error_message'=>'s', 'error_field'=>'password'));
    }

     $_SESSION['user_id'] = $row1['id'];
     $_SESSION['first_name'] = $row1['first_name'];
     $_SESSION['last_name'] = $row1['last_name'];
     $_SESSION['photo_path'] = '';
     $_SESSION['user_type'] = 'user';

  header('Location: /menu.php');
} else {
      return array('is_error'=>true, 'error'=>array('error_code'=>31, 'error_message'=>'s', 'error_field'=>'password'));

}
}


?>