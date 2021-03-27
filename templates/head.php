<div class="head">
 
  <div style="width:840pxs;margin:0 auto;">
    
<script type="text/javascript" src="js/head.js"></script>

  <div class="head-left">
    <span href="/" class="head-link">
<img src="/image/icon/menu.png" onClick="Head.show();" style="position: relative;
    top: -3px;right:7px;cursor: pointer;">
    </span>
    <a href="/" class="head-link">

      <img src="image/icon/favicon.ico" style="position: relative;right:7px;
    top: 0px;">
      <span style="position: relative;top:-5px">АЛЯ ГУРМЕ</span>
    </a>
  </div>

  <div class="head-left head-search__wrap" style="width:190px;margin-left:14px;">
    <FORM action="search2.php">
      
    <input type="text" name="" onClick="document.getElementById('lol').style.display='block';document.getElementById('lol2xp').style.display='block';" class="text_field search_field" style="position: relative;z-index:9999;" id="dffg" placeholder="Поиск" onkeyup="topMenuSearch(this.value);">

    </FORM>
  </div>

<div id="lol" style="display:none;position: absolute;top:54px;z-index:9999;margin-left:157px;background-color:#FFF;width:210px;border:1px solid #DDD;padding:7px 0;"></div>

<style type="text/css">
.okantovka{padding:5px 17px;}
.okantovka:hover{background-color: #fbfbfb}
</style>
<div style="position:fixed;top:0;left:0;right:0;bottom:0;display: none;" id="lol2xp" onClick="document.getElementById('lol').style.display='none';this.style.display='none';"></div>

<style type="text/css">
.nav-logo__wrap{text-align: center;width:143px;margin:auto;}
</style>
  <div class="nav-logo__wrap">
    <a href="//www.digitalwind.ru" target="_blank">
    <img id="bxid_862078" src="/image/лого2021.png" title="www.digitalwind.ru" border="0" align="left" alt="www.digitalwind.ru" width="143" height="51" />
</a>


  </div>
  <div class="head-right">

  <?php

if(!empty($_SESSION['user_id'])) {
  echo '
  <a href="menu.php?act=create_food" class="head-link">Создать запись</a>';
}
  ?>
    <a href="/admin.php" class="head-link">Админ-панель</a>

  <?php

if(!empty($_SESSION['user_id'])) {
  echo '
    <a href="/settings.php" class="head-link">Настройки</a>
    <a href="/logout.php" class="head-link">Выход</a>';

}  else {
  echo '
    <a href="/reg.php" class="head-link">Регистрация</a>
    <a href="/login.php" class="head-link">Войти</a>';
}

  ?>
  </div>


  </div>
</div>



<?php
if(!empty($_SESSION['user_id'])) {
  echo '
<a href="/menu.php?act=create_food">
  
<div id="test" style="background-color: #00bcd4;width: 53px; text-align:center;border-radius:74px;height: 53px;position: fixed;bottom:0;right:0;margin-bottom:47px;margin-right:47px;cursor:pointer;">
<div style="margin-top:7px;color:#FFF;font-size:24px;">
+  
</div>
</div>

</a>
';
}

?>
