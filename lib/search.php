<?php

 function search($search_word) {
  $link = connectDatabase();


if($search_word == '' || $search_word == ' ') {
  return false;
}

$search_word = explode(' ', $search_word);
$sql = 'SELECT `id`, `photo_path`, `owner_id`, `timestamp_created`, `title`, `description` FROM `food` WHERE ';
for($i=0;$i<count($search_word); $i++) {
  if($i == 0) {

  $sql .= ' `title` LIKE "%'.$search_word[$i].'%"';
} else {

  $sql .= ' OR `title` LIKE "%'.$search_word[$i].'%"';
}

}

$sql .= "";

  $is_email_exist = $link->prepare($sql);


  
  $is_email_exist->execute(array());

  $arr = array();




  while($row1 = $is_email_exist->fetch(PDO::FETCH_ASSOC)) {
    $arr[] = $row1;
  }
  return $arr;
}
//var_dump(search('test'));
?>
