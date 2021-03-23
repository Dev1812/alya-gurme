<?php
  ob_start();
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  define('TITLE', 'Аля гурме');
  define('SITE_NAME', 'Аля гурме');
  include SITE_ROOT.'templates/top_params.php';
  include SITE_ROOT.'libs/database.php';
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<?php
  include SITE_ROOT.'templates/header.php';
?>
<body>
<link rel="stylesheet" type="text/css" href="/css/index.css?1">
<?php
  include SITE_ROOT.'templates/head.php';
?>

<div class="content">
<div class="wrap1">
	<style type="text/css">
   .food{position: relative;}
  </style>

<?php
  include SITE_ROOT.'libs/user.php';
  include SITE_ROOT.'libs/index_page.php';
  
  $food = getAllFood();
  if(empty($food)) {
    echo '<div class="not_found-block">Не найдено ни отдной записи<div class="not_found-block__create_food"><a href="/menu.php?act=create_food" class="not_found-block_text">Создать запись</a></div></div>';
  }
?>
<?php
  foreach($food as $v) {
    $photo = !empty($v['photo_path']) ? $v['photo_path'] : '/image/download.png';
    $user_initials = $v['owner_info']['first_name'].' '.$v['owner_info']['last_name'];
?>
<div class="food" id="food_<?php echo $v['id'];?>">
<?php
  $user_type =  !empty($_SESSION['user_type']) ?  $_SESSION['user_type'] : '';
  $user_id =  !empty($_SESSION['user_id']) ?  $_SESSION['user_id'] : '';



  if($v['owner_id'] == $user_id || $user_type == 'admin') {
  echo '
  <div class="delete_food" style="
    position: absolute;
    top: 0;
    right: 0;
    background-color: #000;
    margin: 25px 14px;
    width: 54px;
    height: 54px;" onclick="deleteFood('.$v['id'].');event.preventDefault();"><img style="
    margin-top: 13px;" src="/image/icon/close.png"></div>';
  }
?>

  <a href="/food.php?food_id=<?php echo $v['id'];?>" target="_blank">
    <div class="food-wrap">
	    <div><img class="food-photo__img" src="<?php echo $photo;?>"></div>
	    <div class="food-title"><?php echo $v['title'];?></div>
	    <div class="food-description"><?php echo mb_substr(strip_tags($v['description']), 0, 200, 'UTF-8');?></div>
	    <div class="food-owner">
        <span class="food-owner__text"><?php echo $user_initials;?></span>
      </div>
    </div>
  </a>
</div>

<?php
  }

?>

<div class="clear"></div>

</div>
</div>

<?php
  include SITE_ROOT.'templates/footer.php';
?>

<script type="text/javascript">

function deleteFood(photo_id) {

  var is_admin = confirm("Удалить?");
  if(is_admin) {
    document.getElementById('food_'+photo_id).style.display='none';
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "/testt.php?act=delete_photo&photo_id="+photo_id, true);
    ajax.send();
    ajax.addEventListener("readystatechange", function() {
      if(ajax.readyState === 4 && ajax.status === 200) {
 
      }
    });
  }
}
</script>

  </div>

</body>
</html>