<?php
function getUserInfo($user_id, $fields='`first_name`, `last_name`, `email`') {
  $link = connectDatabase();
  $is_email_exist = $link->prepare("SELECT $fields FROM `users` WHERE `id` = :user_id");
  $is_email_exist->execute(array(':user_id' => $user_id));
  return $is_email_exist->fetch(PDO::FETCH_ASSOC);
}
function isUserAuth() {
  return (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) ? true : false;
}
?>