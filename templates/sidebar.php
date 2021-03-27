
<div id="sidebar-global__layer" style="display: none;" onclick="Head.hide();"></div>



<div id="sidebar" style="margin-left: -250px;">

  <div style="
    padding: 11px 15px 15px 31px;border-bottom: 1px solid #DDD;">
      <img src="image/icon/favicon.ico" style="position: relative;right:11px;
    top: 3px;">Аля Гурме</div>

  <div class="sidebar-user__bar">

    <div class="sidebar-content">
      <div class="sidebar-content">
        <?php
 // var_dump($_SESSION);
if(!empty($_SESSION['user_id'])) {
  $initials = $_SESSION['first_name'].' '.$_SESSION['last_name'];

  $photo = !empty($_SESSION['photo_path']) ? $_SESSION['photo_path'] : '/image/Pmz7l.png';

  $is_admin = ($_SESSION['user_type']=='admin')?"(Admin)": "";

  echo '
    <div class="sidebar-user__bar_wrap">
            <img style="width:70px;height:70px;" src="'.$photo.'">
    </div>
        <a class="sidebar-content__line_wrap" href="/profile.php?category_id='.$_SESSION['user_id'].'"><div class="sidebar-content__line sidebar-content__line_user_initials">'.$initials.'<span style="font-weight:normal;margin-left:7px;border-bottom:1px dashed #000;">'.$is_admin.'</span></div></a>';
} else {
  echo '<div style="margin: 14px 0 7px 0;padding-bottom:14px;border-bottom:1px solid #ddd">
         <a class="sidebar-content__line_wrap" href="/login.php" style="border-bottom:1px dashed #DDD"><div class="sidebar-content__line">Войти</div></a>
        <a class="sidebar-content__line_wrap" href="/reg.php" style="border-bottom:1px dashed #DDD"><div class="sidebar-content__line">Регистрация</div></a>
        <a class="sidebar-content__line_wrap" href="/admin.php" style="border-bottom:1px dashed #DDD"><div class="sidebar-content__line">Админ-панель</div></a>
</div>';
}
        ?>
        <a class="sidebar-content__line_wrap" href="/index.php"><div class="sidebar-content__line">Все категории <span style="font-weight: bold;"><?php echo $arr[0]['COUNT(`id`)'];?></span> </div></a>
        <a class="sidebar-content__line_wrap" href="/index.php?category_id=1"><div class="sidebar-content__line">Десерты <span style="font-weight: bold;"><?php echo $arr[1]['COUNT(`id`)'];?></span></div></a>
        <a class="sidebar-content__line_wrap" href="/index.php?category_id=2"><div class="sidebar-content__line">Основые блюда <span style="font-weight: bold;"><?php echo $arr[2]['COUNT(`id`)'];?></span></div></a>
        <a class="sidebar-content__line_wrap" href="/index.php?category_id=3"><div class="sidebar-content__line">Салаты <span style="font-weight: bold;"><?php echo $arr[3]['COUNT(`id`)'];?></span></div></a>
        <a class="sidebar-content__line_wrap" href="/index.php?category_id=4"><div class="sidebar-content__line">Коктейли <span style="font-weight: bold;"><?php echo $arr[4]['COUNT(`id`)'];?></span></div></a>
        <a class="sidebar-content__line_wrap" href="/index.php?category_id=5"><div class="sidebar-content__line">Супы <span style="font-weight: bold;"><?php echo $arr[5]['COUNT(`id`)'];?></span></div></a>
        <a class="sidebar-content__line_wrap" href="/index.php?category_id=6"><div class="sidebar-content__line">Сэндвичи <span style="font-weight: bold;"><?php echo $arr[6]['COUNT(`id`)'];?></span></div></a>

        <a class="sidebar-content__line_wrap" href="/index.php?category_id=7"><div class="sidebar-content__line">Пицца <span style="font-weight: bold;"><?php echo $arr[7]['COUNT(`id`)'];?></span></div></a>



        <a class="sidebar-content__line_wrap" href="/setting.php"><div class="sidebar-content__line">Настройки</div></a>








      </div>
    </div>
  </div>

</div>