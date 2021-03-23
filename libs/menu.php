<?php
function deleteFood($food_id) {
  $link = connectDatabase();
  $is_email_exist = $link->prepare("UPDATE `food` SET `is_deleted`=true WHERE `id` = :food_id");
  $is_email_exist->execute(array(':food_id' => $food_id));
  return $is_email_exist->fetch(PDO::FETCH_ASSOC);
}
?>