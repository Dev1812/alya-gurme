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
<style type="text/css">
  

.food{float:left;width:270px;height:353px;overflow:hidden;cursor:pointer;transition:all 0.3s ease;border-radius:7px;text-align: center;}
.food:hover {box-shadow: 0 0 51px #b7b1b1;background-color: #FFF;}
.food-photo__img{width:100%;border-radius:7px;height: 189px}
.food-title{font-size:24px;padding:7px 0 7px;color: #607d8b;text-transform:uppercase;font-size:18px;font-weight:bold;}
.food-wrap{padding:24px 14px;line-height:24px;}
.food-description{
  
    max-height: 42px;
    overflow: hidden;
}

</style>


<body>


<?php


  include SITE_ROOT.'template/head.php';
?>

<div class="content">

<div class="wrap1">
	
  <script type="text/javascript">
    
function deleteposrt() {
console.log('test');

}
  </script>

<?php
  include SITE_ROOT.'lib/user.php';
  include SITE_ROOT.'lib/index_page.php';
  
  $food = getAllFood();
  if(empty($food)) {
    echo '<div style="text-align:center;padding:47px 0;color:#808080">Не найдено ни отдной записи</div>';
  }
?>
<?php
  foreach($food as $v) {
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

<div class="clear"></div>

</div>
</div>

<?php
  include SITE_ROOT.'template/footer.php';
?>

<div class="pop_box-background_layer" id="pop_box-background_layer" style="position:fixed;top:0;left:0;right:0;bottom:0;background-color:#808080;opacity:0.50;/* display:none; */display: none;"></div>










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

    
  ajax.open("GET", "/testt.php?act=delete_photo&photo_id="+dump, true);
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

<!-----
<div id="pop_box" style="position:fixed;top:0;left:0;right:0;bottom:0;/* display:none; */display: none;">
    
  <div class="pop_box-wrap" id="pop_box-wrap" style="width:340px;margin:74px auto;background-color:#FFF;box-shadow:0 0 32px #888">
    
    <div class="pop_box-head" style="padding:14px 17px 0;font-weight:bold;">
    <div class="pop_box-head__close_wrap" style="float: right;cursor: pointer;" onclick="PopUpBox.hide();"><img src="/image/icon/close (2).png" style="width:17px;"></div>
    <div class="pop_box-head__title" id="pop_box_tile">Удаление фото </div> 


   </div>

    <div class="pop_box-body" style="padding:14px 17px;" id="pop_up_box">
     <div style="margin-bottom:17px">Вы уверены, что хотите удалить фото?</div> 
<button style="
    width: auto;
    padding: 7px 14px;
    border: 0;
    background-color: #FFF;
    text-transform: uppercase;
    font-weight: bold;color:green" onClick="deletemon();">Да</button>
<button class="buttoыn" style="width:auto;padding:7px 14px;
    width: auto;
    padding: 7px 14px;
    border: 0;
    background-color: #FFF;
    text-transform: uppercase;
    font-weight: bold;color:green" onClick="no();">Нет</button>
    </div>

  </div>
-->

  </div>

</body>
</html>