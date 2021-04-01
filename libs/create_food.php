<?php
function createFood() {
  $create_food_title_length = mb_strlen($_POST['create_food_title']);
  $create_food_description_length = mb_strlen($_POST['create_food_description']);

  $i18n = new i18n;

  if($create_food_title_length < 3) {
    return array('is_error'=>true, 'error'=>array('error_code'=>21, 'error_message'=>$i18n->get('short_title')));
  } else if($create_food_title_length > 251) {
    return array('is_error'=>true, 'error'=>array('error_code'=>22, 'error_message'=>$i18n->get('long_title')));
  } 

  if($create_food_description_length < 7) {
    return array('is_error'=>true, 'error'=>array('error_code'=>21, 'error_message'=>$i18n->get('short_description')));
  } else if($create_food_description_length > 90000) {
    return array('is_error'=>true, 'error'=>array('error_code'=>22, 'error_message'=>$i18n->get('long_description')));
  }

  $link = connectDatabase();

  $sql = "INSERT INTO `food`(`id`,
                             `photo_path`,
                             `owner_id`,
                             `timestamp_created`,
                             `title`,
                             `description`,
                             `is_deleted`,
                             `category`) VALUES (
                             '',
                             :photo_path,
                             :owner_id,
                             :timestamp_created,
                             :title,
                             :description,
                             'false',
                             :category)";


  $is_email_exist = $link->prepare($sql); 
  $is_email_exist->execute(array(':photo_path' => $_POST['create_food_photo3'],
                                 ':owner_id' => $_SESSION['user_id'],
                                 ':timestamp_created'=> time(),
                                 ':title' => $_POST['create_food_title'],
                                 ':description' => $_POST['create_food_description'],
                                 ':category' => $_POST['create_food_category']));
  return array('is_error' => false, 'message' => $i18n->get('food_success_created'));
}