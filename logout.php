<?php
ob_start();
define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
define('TITLE', 'Выход');
define('SITE_NAME', 'Аля гурме');
include SITE_ROOT.'templates/top_params.php';

unset($_SESSION);

session_unset();
session_write_close();

header('Location: /');
exit;
?>