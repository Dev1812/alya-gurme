<?php



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
?>