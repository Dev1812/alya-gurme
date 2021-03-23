<?php
  ob_start();
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  define('TITLE', 'Аля гурме');
  define('SITE_NAME', 'Аля гурме');
  include SITE_ROOT.'templates/top_params.php';
  include SITE_ROOT.'libs/database.php'
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>

<?php
  include SITE_ROOT.'templates/header.php';
?>

<body>


<?php


  include SITE_ROOT.'templates/head.php';
?>

<div class="content">

<div class="wrap1">

<div>
  




<?php

function getAllFood() {
  include SITE_ROOT.'libs/user.php';





  $link = connectDatabase();

$category = !empty($_GET['category_id']) ? $_GET['category_id'] : '';

$arr = array();

//var_dump($category);


$sql = "SELECT `id`, `photo_path`, `owner_id`, `timestamp_created`, `title`, `description` FROM `food` WHERE `owner_id` = :owner_id AND `is_deleted`=false ORDER BY `id` DESC";


  $is_email_exist = $link->prepare($sql);
  $is_email_exist->execute(array(':owner_id' => $_GET['category_id']));




//var_dump($is_email_exist);
      while($row1 = $is_email_exist->fetch(PDO::FETCH_ASSOC)) {
      /*  if(User::isAdmin()) {
          $row[] = '<div>Удалить статью</div>'; 
        }*/
/*

        $row1['is_following'] = $this->checkFollowing($row1['to_id']);
        $row1['user_initials'] = $this->user->getInitials($row1['to_id']);*/

//var_dump($row1['to_id']);
$row1['owner_info'] = getUserInfo($row1['owner_id']);
        $arr[] = $row1;
      }


  $is_email_exist2 = $link->prepare("SELECT COUNT(`id`) FROM `food` WHERE `owner_id` = :food_id AND `is_deleted` = false");
  $is_email_exist2->execute(array(':food_id' => $category));

  
  return array('test'=>$arr, 'count'=>$is_email_exist2->fetch(PDO::FETCH_ASSOC));




}

?>










<?php
$food = getAllFood();
//var_dump($food)

///image/download.png
$photo = !empty($_SESSION['photo_path']) ? $_SESSION['photo_path'] : 'image/Pmz7l.png';

//var_dump($food);

$user_info = getUserInfo($_GET['category_id']);

$user_initials = $user_info['first_name'].' '.$user_info['last_name'];
?>
  
  <div style="float: left;"><img src="<?php echo $photo;//var_dump($_SESSION);/* $_SESSION[''];*/?>" style="width:140px;"></div>

  <div style="margin-left:170px;margin-top:7px">
    <span style="font-weight: bold;"><?php echo $user_initials;?></span>
<?php
function declOfNum($num, $titles) {
    $cases = array(2, 0, 1, 1, 1, 2);

    return $num . " " . $titles[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]];
}
 //<?php echo $food['count']['COUNT(`id`)'];
?>
  <div style="margin-top:14px;"><?php echo declOfNum($food['count']['COUNT(`id`)'], array('запись', 'записи', 'записей'));?></div>
  </div>



</div>


<div class="clear"></div>




<div style="border-bottom:1px solid #DDD;margin-bottom:7px;padding-bottom:7px;">
    
<style type="text/css">
  

.food{float:left;width:270px;height:474px;overflow:hidden;cursor:pointer;transition:all 0.3s ease;border-radius:7px;text-align: left;}
.food:hover {box-shadow: 0 0 51px #b7b1b1;background-color: #FFF;}
.food-photo__img{width:100%;border-radius:7px;height: 189px}
.food-title{font-size:24px;padding:7px 0 7px;color: #607d8b;text-transform:uppercase;font-size:18px;font-weight:bold;text-align: center;}
.food-wrap{padding:24px 14px;line-height:24px;text-align: justify;}
.food-description{
  
    max-height: 162px;
    overflow: hidden;
}

</style>










<?php
  foreach($food['test'] as $v) {
    $photo = !empty($v['photo_path']) ? $v['photo_path'] : '/image/download.png';
    $user_initials = $v['owner_info']['first_name'].' '.$v['owner_info']['last_name'];
?>

<div class="food" id="food_<?php echo $v['id'];?>" style="position: relative;">


<?php
$user_type =  !empty($_SESSION['user_type']) ?  $_SESSION['user_type'] : '';
$user_id =  !empty($_SESSION['user_id']) ?  $_SESSION['user_id'] : '';



if($v['owner_id'] == $user_id || $user_type == 'admin') {
  echo '
  <div style="position:absolute;top:0;right:0;padding: 9px 11px;background: #000;cursor:pointer;margin: 24px 12px 0 0;;" onclick="deletemon('.$v['id'].');event.preventDefault();"><img src="/image/icon/close.png"></div>';
}

?>

  <a href="/food.php?food_id=<?php echo $v['id'];?>" target="_blank">
    <div class="food-wrap">
      <div><img class="food-photo__img" src="<?php echo $photo;?>"></div>
      <div class="food-title"><?php echo $v['title'];?></div>
      <div class="food-description"><?php echo 
mb_substr(strip_tags($v['description']), 0, 200, 'UTF-8');;?></div>
      <div class="food-owner">
        <span class="food-owner__text"><?php echo $user_initials;?></span>
      </div>
    </div>
  </a>
</div>

<?php
  }

/*
if(!empty($_GET['photo_id'])) {
  var_dump(deleteFood($_GET['food_id']));
}*/
?>


</div>



  </div>
<div class="clear"></div>



<?php
  include SITE_ROOT.'templates/footer.php';
?>

</div>


<script type="text/javascript">
  
function no() {
document.getElementById('pop_box').style.display='none';
document.getElementById('pop_box-background_layer').style.display='none';
}

function deletemon(dump) {
  

var isAdmin = confirm("Удалить?");


if(isAdmin) {





document.getElementById('food_'+dump).style.display='none';
  console.log('testt');
  var ajax = new XMLHttpRequest();

    
  ajax.open("GET", "testt.php?act=delete_photo&photo_id="+dump, true);
  ajax.send();

ajax.addEventListener("readystatechange", function() {

  ///
  //  var f = JSON.parse(ajax.responseText);

    if(ajax.readyState === 4 && ajax.status === 200) {
    console.log(ajax.response);     
      console.log('yeap');
    //ab
    }
/*

      document.getElementById('ab').innerHTML='<div style="position:relative;width:349px;margin-bottom:24PX;"><div style="position:absolute;top:0;right:0;padding: 9px 11px;background: #000;cursor:pointer"><img src="/image/icon/close.png"></div><img src="'+test.path+'" style="width:100%"></div>';

*/

});

} else {
  no();
}

}
</script>

</body>
</html>