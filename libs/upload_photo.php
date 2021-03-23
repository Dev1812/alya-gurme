<?php

$uploaddir = 'public/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

//echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
   // echo "Файл корректен и был успешно загружен.\n";
    echo json_encode(array('path' => $uploadfile));
} else {
   // echo "Возможная атака с помощью файловой загрузки!\n";
}

//echo 'Некоторая отладочная информация:';
//print_r($_FILES);

//print "</pre>";


?>