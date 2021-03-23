<div class="head">
 
  <div style="width:840pxs;margin:0 auto;">
    


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

<script type="text/javascript">
  var ajax = {
  init: function() {
    var xhr;
    try {
      xhr = new ActiveXObject('Msxml2.XMLHTTP');
    } catch(e) {
      try {
        xhr = new ActiveXObject('Microsoft.XMLHTTP');
      } catch(e) {
        xhr = false;
      }
    }
    if(!xhr && typeof XMLHttpRequest!='undefined') {
      xhr = new XMLHttpRequest();
    }
    return xhr;  
  },
  request: function(param) {
    var r = ajax.init(), method = param.method || 'POST';
    r.open(method, param.url, true);
    r.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    r.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    r.send(param.data);
    if(param.showProgress) {
      param.showProgress();
    }
    r.onreadystatechange = function() {
      if(r.readyState == 4) {
        if(r.status >= 200 && r.status < 300) {
          var response = parseJSON(r.responseText);
          if(response.js) {
            ajax.pasteJs(response.js);
          }
          if(param.success) {
            param.success(response);
          }
        }      
        if(param.hideProgress) {
          param.hideProgress();
        }
      }
    };  
    return r;
  },
  post: function(param) {
    return ajax.request({
      url: param.url,
      data: param.data,
      method: 'POST',
      showProgress: param.showProgress,
      hideProgress: param.hideProgress,
      success: param.success,
      error: param.error,
    });
  },
  get: function(param) {
    return ajax.request({
      url: param.url,
      method: 'GET',
      showProgress: param.showProgress,
      hideProgress: param.hideProgress,
      success: param.success,
      error: param.error,
    });
  },
  pasteJs: function(js) {
    if(!js) return false;
    var code = document.createElement('script');
    code.type = 'text/javascript';
    code.innerHTML = js;
    document.head.appendChild(code);
  }
}


function parseJSON(obj){
  if(window.JSON && JSON.parse) {
    return JSON.parse(obj);
  }
  return eval('('+obj+')');
}
function topMenuSearch(value) {
if(value.length < 1) { 
return false;
}
      var responsr='';  
responsr += '<a href="/search2.php?q='+document.getElementById('dffg').value+'" target="_blank"><div class="okantovka" style="background-color:#FBFBFB">Показать все результаты</div></a>';
  console.log(value);
  ajax.get({
    url: '/search.php?q='+value,
    data: '',
    success: function(data) {
      for(var i in data) {
responsr += '<a href="/food.php?food_id='+data[i].id+'" target="_blank"><div class="okantovka">'+data[i].title+'</div></a>';
      }

      document.getElementById('lol').innerHTML=responsr;
      console.log(data);
    }
  });
}
</script>
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








<style type="text/css">
  
.gray-head{margin-top:0;text-align: center;width: 100%;border-bottom:1px solid #DDD;height:51px;padding: 0 23px;position: fixed;left:0
right:0;z-index:9;background-color: #FFF;}
</style>

<div class="gray-head">


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>




<div style="float: right;">
  


<?php

//  include SITE_ROOT.'lib/database.php';
  $arr = array();


  $link = connectDatabase();


$arr = array();
  $is_email_exist0 = $link->prepare("SELECT COUNT(`id`) FROM `food` WHERE `is_deleted` != 'true'");
  $is_email_exist0->execute(array());

  $is_email_exist = $link->prepare("SELECT COUNT(`id`) FROM `food` WHERE `category` = 1  AND `is_deleted` != 'true'");
  $is_email_exist->execute(array());



  $is_email_exist3 = $link->prepare("SELECT COUNT(`id`) FROM `food` WHERE `category` = 2  AND `is_deleted` != 'true'");
  $is_email_exist3->execute(array());

  $is_email_exist4 = $link->prepare("SELECT COUNT(`id`) FROM `food` WHERE `category` = 3  AND `is_deleted` != 'true'");
  $is_email_exist4->execute(array());

  $is_email_exist5 = $link->prepare("SELECT COUNT(`id`) FROM `food` WHERE `category` = 4  AND `is_deleted` != 'true'");
  $is_email_exist5->execute(array());

  $is_email_exist6 = $link->prepare("SELECT COUNT(`id`) FROM `food` WHERE `category` = 5  AND `is_deleted` != 'true'");
  $is_email_exist6->execute(array());


  $is_email_exist7 = $link->prepare("SELECT COUNT(`id`) FROM `food` WHERE `category` = 6  AND `is_deleted` != 'true'");
  $is_email_exist7->execute(array());


  $is_email_exist8 = $link->prepare("SELECT COUNT(`id`) FROM `food` WHERE `category` = 7  AND `is_deleted` != 'true'");
  $is_email_exist8->execute(array());

 //  var_dump($is_email_exist->fetch(PDO::FETCH_ASSOC));

$arr[0] = $is_email_exist0->fetch(PDO::FETCH_ASSOC);

$arr[1] = $is_email_exist->fetch(PDO::FETCH_ASSOC);
$arr[2] = $is_email_exist3->fetch(PDO::FETCH_ASSOC);
$arr[3] = $is_email_exist4->fetch(PDO::FETCH_ASSOC);
$arr[4] = $is_email_exist5->fetch(PDO::FETCH_ASSOC);
$arr[5] = $is_email_exist6->fetch(PDO::FETCH_ASSOC);
$arr[6] = $is_email_exist7->fetch(PDO::FETCH_ASSOC);
$arr[7] = $is_email_exist8->fetch(PDO::FETCH_ASSOC);
//var_dump($arr);

?>
    <a href="/index.php" class="head-link"<?php echo !empty($_GET['category_id']) ? $_GET['category_id']:' style="border-bottom:1px solid blue"' ?>>
      <span style="position: relative;top:-2px">Все категории <span style="font-weight: bold;"><?php echo $arr[0]['COUNT(`id`)'];?></span></span>
    </a>



    <a href="/index.php?category_id=1" class="head-link"<?php echo !empty($_GET['category_id']) && $_GET['category_id'] == 1 ?' style="border-bottom:1px solid blue"':''; ?>>


      <span style="position: relative;top:-2px">Десерты <span style="font-weight: bold;"><?php echo $arr[1]['COUNT(`id`)'];?></span></span>
    </a>

    <a href="/index.php?category_id=2" class="head-link"<?php echo !empty($_GET['category_id']) && $_GET['category_id'] == 2 ?' style="border-bottom:1px solid blue"':''; ?>>
      <span style="position: relative;top:-2px">Основые блюда <span style="font-weight: bold;"><?php echo $arr[2]['COUNT(`id`)'];?></span>
    </a>

    <a href="/index.php?category_id=3" class="head-link"<?php echo !empty($_GET['category_id']) && $_GET['category_id'] == 3 ?' style="border-bottom:1px solid blue"':''; ?>>
      <span style="position: relative;top:-2px">Салаты <span style="font-weight: bold;"><?php echo $arr[3]['COUNT(`id`)'];?></span>
    </a>


    <a href="/index.php?category_id=4" class="head-link" class="head-link"<?php echo !empty($_GET['category_id']) && $_GET['category_id'] == 4 ?' style="border-bottom:1px solid blue"':''; ?>>
      <span style="position: relative;top:-2px">Коктейли <span style="font-weight: bold;"><?php echo $arr[4]['COUNT(`id`)'];?></span> </span>
    </a>
    <a href="/index.php?category_id=5" class="head-link" class="head-link"<?php echo !empty($_GET['category_id']) && $_GET['category_id'] == 5 ?' style="border-bottom:1px solid blue"':''; ?>>
      <span style="position: relative;top:-2px">Супы <span style="font-weight: bold;"><?php echo $arr[5]['COUNT(`id`)'];?></span></span>
    </a>

    <a href="/index.php?category_id=6" class="head-link" class="head-link"<?php echo !empty($_GET['category_id']) && $_GET['category_id'] == 6 ?' style="border-bottom:1px solid blue"':''; ?>>
      <span style="position: relative;top:-2px">Сэндвичи <span style="font-weight: bold;"><?php echo $arr[6]['COUNT(`id`)'];?></span></span>
    </a>
    <a href="/index.php?category_id=7" class="head-link" class="head-link"<?php echo !empty($_GET['category_id']) && $_GET['category_id'] ==7 ?' style="border-bottom:1px solid blue"':''; ?>>
      <span style="position: relative;top:-2px">Пицца <span style="font-weight: bold;"><?php echo $arr[7]['COUNT(`id`)'];?></span></span>
    </a>





</div>


</div>









<style type="text/css">



#sidebar-global__layer{position: fixed;top:0;left:250px;
    z-index: 99999;
right:0;bottom:0;background-color:#484545;opacity:.7;cursor:pointer;}
#sidebar{position:fixed;top:0;left:0;bottom:0;width:250px;background-color: #FFF;border-right:1px solid #DDD;transition:margin 0.3s ease;z-index: 999999}
.sidebar-top__search_wrap{height:45px;border-bottom:1px solid #DDD;}

.sidebar-search__field{width:100%;}

.sidebar-top__search_wrap{
    padding: 9px 15px 16px 15px;}


.sidebar-content__line_user_initials{font-weight:bold;}







  .sidebar-user__bar_wrap{
    padding: 15px 27px 11px;}
.sidebar-content__line{
    padding: 7px 27px;
    color: #000;
    transition:background-color 0.3s ease
}
.sidebar-content__line:hover{background-color:#FAFAFA;}

</style>

<script type="text/javascript">

var Head = {
  show: function() {
    $('#sidebar').css({'margin-left':'0px'});
    $('#sidebar-global__layer').show();
  },
  hide: function() {
    $('#sidebar').css({'margin-left':'-250px'});
    $('#sidebar-global__layer').hide();
  }
}

</script>
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