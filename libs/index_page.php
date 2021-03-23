<?php
function getAllFood() {
  $link = connectDatabase();

  $category = isset($_GET['category_id']) && !empty($_GET['category_id']) ? $_GET['category_id'] : '';

  $arr = array();

  $sql = "SELECT `id`, `photo_path`, `owner_id`, `timestamp_created`, `title`, `description` FROM `food` WHERE `is_deleted` != 'true' ";


  if($category != '') {
    $sql .= "AND `category` = :category ORDER BY `id` DESC";
    $is_email_exist = $link->prepare($sql);
    $is_email_exist->execute(array(':category' => $category));
  } else {
    $sql .= " ORDER BY `id` DESC";
    $is_email_exist = $link->prepare($sql);
    $is_email_exist->execute(array());
  }

  while($row1 = $is_email_exist->fetch(PDO::FETCH_ASSOC)) {;
    $row1['owner_info'] = getUserInfo($row1['owner_id']);
    $arr[] = $row1;
  }
  
  return $arr;

}
?>