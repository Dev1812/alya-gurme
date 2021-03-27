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
  include SITE_ROOT.'templates/gray_head.php';
  include SITE_ROOT.'templates/sidebar.php';
?>

<div class="content" style="padding-bottom:17px">

<div class="wrap1" style="padding:0;">
    <?php
  include SITE_ROOT.'libs/user.php';
 // include SITE_ROOT.'libs/database.php';
  include SITE_ROOT.'libs/food.php';
  
  $food = getFood($_GET['food_id']);
?>
<?php

  if(empty($food)) {
    echo '<div class="" style="text-align:center;padding:74px 0 67px;">
            <div>Не найдено ни отдной записи</div>
            <div style="margin-top:7px"><a href="/menu.php?act=create_food">Создать запись</a></div>
          </div>';
  } else{

?>

  
  <div style="background-color: #FFF;padding:14px 34px;border:1px solid #DDDFE1;margin-top:24px;">
<?php
  
  $first_name = !empty($food['owner_info']['first_name']) ? $food['owner_info']['first_name'] : '';
    

  $last_name = !empty($food['owner_info']['last_name']) ? $food['owner_info']['last_name'] : '';
    

    $photo = !empty($food['photo_path']) ? $food['photo_path'] : '/image/download.png';
    $user_initials = $first_name.' '.$last_name;
?>

<div class="food" style="overflow: hidden;">
    <div class="food-wrap" style="margin:17px 0 17px">
      <div class="food-title" style="text-align: left;font-size:17px;text-transform:uppercase;margin-bottom: 19px;font-weight: bold;"><?php echo $food['title'];?>

  </div>

  <?php
 $info = getUserInfo($food['owner_id']);

  ?>
    <div style="margin-bottom:14px">Автор: <a href="/profile.php?category_id=<?php echo $food['owner_id'] ?>" style="border-bottom:1px dashed blue;"><?php echo $info['first_name'].' '.$info['last_name'];?></a></div>
      <div style="height:200px;"><img class="food-photo__img" src="<?php echo $photo;?>" width="300px" style="float:left;margin: 0 26px 16px 0;border-radius:7px"></div>
      <div class="food-description" style="
    line-height: 24px;"><?php echo $food['description'];?></div>
      <div class="food-owner">
        <span class="food-owner__text"><?php echo $user_initials;?></span>
      </div>
    </div>

<div>
  <div class="clear"></div>
<div style="font-size: 17px;margin-bottom: 14px;">Поделиться:</div>
    <script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-curtain data-services="vkontakte,facebook,odnoklassniki,telegram"></div>



</div>
</div>


<div class="clear"></div>

</div>

  <div style="background-color: #FFF;padding:14px 34px 37px;border:1px solid #DDDFE1;margin-top:34px;margin-bottom: 37px;">

<div style="font-size:21px;margin-bottom:27px;margin-top:14px;text-align: left;">Комментарии</div>
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