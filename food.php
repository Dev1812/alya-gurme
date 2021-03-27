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
<link rel="stylesheet" type="text/css" href="css/food.css?<?php echo time();?>">
<?php
  include SITE_ROOT.'templates/head.php';
  include SITE_ROOT.'templates/gray_head.php';
  include SITE_ROOT.'templates/sidebar.php';
?>

<div class="content">
<div class="wrap1">
<?php
  include SITE_ROOT.'libs/user.php';
  include SITE_ROOT.'libs/food.php';
  $food = getFood($_GET['food_id']);
?>
<?php

  if(empty($food)) {
    echo '<div class="not_found" style="">
            <div>Не найдено ни отдной записи</div>
            <div class="not_found__link_wrap"><a href="/menu.php?act=create_food">Создать запись</a></div>
          </div>';
  } else{

?>

  
  <div class="food-container">
<?php
  $first_name = !empty($food['owner_info']['first_name']) ? $food['owner_info']['first_name'] : '';
  $last_name = !empty($food['owner_info']['last_name']) ? $food['owner_info']['last_name'] : '';
  $photo = !empty($food['photo_path']) ? $food['photo_path'] : '/image/download.png';
  $user_initials = $first_name.' '.$last_name;
?>

<div class="food">
    <div class="food-wrap">
      <div class="food-title"><?php echo $food['title'];?>

  </div>

<?php
  $info = getUserInfo($food['owner_id']);
  ?>
    <div class="food-owner__wrap">
      Автор: <a href="/profile.php?category_id=<?php echo $food['owner_id'] ?>" class="food-owner__initials" style="">
        <?php echo $info['first_name'].' '.$info['last_name'];?>
        </a></div>
      <div class="food-owner__photo_wrap"><img class="food-photo__img" src="<?php echo $photo;?>"></div>
      <div class="food-description"><?php echo $food['description'];?></div>
      <div class="food-owner">
        <span class="food-owner__text"><?php echo $user_initials;?></span>
      </div>
    </div>

<div class="share-container">
  <div class="clear"></div>
<div class="share-container">Поделиться:</div>
    <script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-curtain data-services="vkontakte,facebook,odnoklassniki,telegram"></div>



</div>
</div>


<div class="clear"></div>

</div>

  <div class="comments-container">

<div class="comments-container__title">Комментарии</div>
<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?168"></script>

<script type="text/javascript">
  VK.init({apiId: 7768834, onlyWidgets: true});
</script>

<!-- Put this div tag to the place, where the Comments block will be -->
<div id="vk_comments"></div>
<script type="text/javascript">
VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"});
</script>

    </div>




<?php

}

?>
  </div>

</div>

<?php
  include SITE_ROOT.'templates/footer.php';
?>

</body>
</html>