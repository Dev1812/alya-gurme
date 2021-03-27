

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
