<?php
function getFood($food_id) {


  $link = connectDatabase();


$arr = array();
  $is_email_exist = $link->prepare("SELECT `id`, `photo_path`, `owner_id`, `timestamp_created`, `title`, `description` FROM `food` WHERE id = :food_id");
  $is_email_exist->execute(array(':food_id' => $food_id));

   return  $is_email_exist->fetch(PDO::FETCH_ASSOC);


}
?>