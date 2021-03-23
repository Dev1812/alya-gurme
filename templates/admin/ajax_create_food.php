<?php
echo json_encode(createFood($_GET['create_food_title'], $_GET['create_food_description'], $_GET['create_food_atach_files']));
?>