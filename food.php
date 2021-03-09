<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
  session_set_cookie_params(199999);
  ini_set('session.gc_maxlifetime', 199999);
  ini_set('session.cookie_lifetime', 199999);
  session_name('sid');
  session_start();
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  define('TITLE', 'Аля гурме');
  define('SITE_NAME', 'Аля гурме');
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>

<?php
  include SITE_ROOT.'template/header.php';
?>

<body>


<?php


  include SITE_ROOT.'template/head.php';
?>

<div class="content" style="padding-bottom:17px">

<div class="wrap1" style="padding:0;">
	
  <div style="background-color: #FFF;padding:14px 34px;border:1px solid #DDDFE1;margin-top:24px;">
    <?php
  include SITE_ROOT.'lib/user.php';
 // include SITE_ROOT.'lib/database.php';
  include SITE_ROOT.'lib/food.php';
  
  $food = getFood($_GET['food_id']);
?>
<?php

  $first_name = !empty($food['owner_info']['first_name']) ? $food['owner_info']['first_name'] : '';
    

  $last_name = !empty($food['owner_info']['last_name']) ? $food['owner_info']['last_name'] : '';
    

    $photo = !empty($food['photo_path']) ? $food['photo_path'] : '/image/s1200-6.jpg';
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
	    <div><img class="food-photo__img" src="<?php echo $photo;?>" width="300px" style="float:left;margin: 0 26px 16px 0;border-radius:7px"></div>
	    <div class="food-description" style="
    line-height: 24px;"><?php echo $food['description'];?></div>
	    <div class="food-owner">
        <span class="food-owner__text"><?php echo $user_initials;?></span>
      </div>
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



  </div>

</div>

<?php
  include SITE_ROOT.'template/footer.php';
?>

</body>
</html>