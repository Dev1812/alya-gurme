<?php
  define('MIN_FIRSTNAME', 3);
  define('MAX_FIRSTNAME', 74);

  define ('MIN_LASTNAME', 3);
  define ('MAX_LASTNAME', 74);

  define ('MIN_EMAIL', 4);
  define ('MAX_EMAIL', 74);

  define ('MIN_PASSWORD', 4);
  define ('MAX_PASSWORD', 54);




  /**
   * Генерация хеша 
   *
   */
  function generateHash() {
    return hash_hmac('ripemd160', uniqid(), sha1(time()));
  }    


  /**
   * Генерация соли 
   *
   */
  function generateSalt($max_length = 7) {
    $max_length = intval($max_length);
    $hash = generateHash();
    return substr($hash, 0, $max_length); 
  }   


  /**
   * Хеширование пароля
   * @return <array> Хешированный пароль и соль
   *
   */
  function passwordHashing($password) {
    $salt = '$5$'.generateSalt(11).'$'; // SHA-256
    $hashed_password = crypt($password, $salt);
    return array('hashed_password' => $hashed_password, 'salt' => $salt);
  }




function reg($firstname, $lastname, $email, $password) {

  $firstname_length = htmlspecialchars($firstname);
  $lastname = htmlspecialchars($lastname);
  $email = htmlspecialchars($email);
  $password = htmlspecialchars($password);


  $firstname_length = mb_strlen($firstname);
  $lastname_length = mb_strlen($lastname);
  $email_length = mb_strlen($email);
  $password_length = mb_strlen($password);

  $i18n = new i18n;

  if($firstname_length < MIN_FIRSTNAME) {
    return array('is_error'=>true, 'error'=>array('error_code'=>21, 'error_message'=>$i18n->get('short_firstname'), 'error_field'=>'firstname'));
  } else if($firstname_length > MAX_FIRSTNAME) {
    return array('is_error'=>true, 'error'=>array('error_code'=>22, 'error_message'=>$i18n->get('long_firstname'), 'error_field'=>'firstname'));
  } else if(!preg_match('/^[а-яА-Яёa-zA-Z]*$/u', $firstname)) {
    return array('is_error'=>true, 'error'=>array('error_code'=>23, 'error_message'=>$i18n->get('incorrect_firstname'), 'error_field'=>'firstname'));
  }

  if($lastname_length < MIN_LASTNAME) {
    return array('is_error'=>true, 'error'=>array('error_code'=>21, 'error_message'=>$i18n->get('short_lastname'), 'error_field'=>'firstname'));
  } else if($lastname_length > MAX_LASTNAME) {
    return array('is_error'=>true, 'error'=>array('error_code'=>22, 'error_message'=>$i18n->get('long_lasttname'), 'error_field'=>'firstname'));
  } else if(!preg_match('/^[а-яА-Яёa-zA-Z]*$/u', $lastname)) {
    return array('is_error'=>true, 'error'=>array('error_code'=>23, 'error_message'=>$i18n->get('incorrect_flastname'), 'error_field'=>'firstname'));
  }

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

  $is_email_exist = $database->prepare("SELECT `id` FROM `users` WHERE `email` = :email");
  $is_email_exist->execute(array(':email' => $email));
  $row1 = $is_email_exist->fetch(PDO::FETCH_ASSOC);

  if(!empty($row1['id'])) {
    return array('is_error'=>true,'error'=>array('error_code'=>32, 'error_message'=>$i18n->get('email_exist'), 'error_field'=>'email'));
  } 

  $password_hashing = passwordHashing($password);
  $hashed_password = $password_hashing['hashed_password'];  
  $salt = $password_hashing['salt'];
  $timestamp_registered = time();

  $hash = hash('sha256', time().rand(0, 1000000));


  $reg_user = $database->prepare("INSERT INTO `users`(`id`,
  	                                                       `first_name`,
  	                                                       `last_name`,
  	                                                       `email`,
  	                                                       `hashed_password`,
  	                                                       `salt`,
  	                                                       `photo_path`,
  	                                                       `type`) VALUES (
  	                                                       '',
  	                                                       :first_name,
  	                                                       :last_name,
  	                                                       :email,
  	                                                       :hashed_password,
  	                                                       :salt,
  	                                                       '',
  	                                                       'user')");
  $reg_user->execute(array(':first_name' => $firstname,
                           ':last_name' => $lastname,
                           ':email' => $email,
                           ':hashed_password' => $hashed_password,
                           ':salt' => $salt));
  
  $last_insert_id = $database->lastInsertId();


     $_SESSION['user_id'] = $last_insert_id;
     $_SESSION['first_name'] = $firstname;
     $_SESSION['last_name'] = $lastname;
     $_SESSION['photo_path'] = '';
     $_SESSION['user_type'] = 'user';

  header('Location: /menu.php');
}


?>