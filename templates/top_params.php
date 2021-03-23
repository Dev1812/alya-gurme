<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_set_cookie_params(199999);
ini_set('session.gc_maxlifetime', 199999);
ini_set('session.cookie_lifetime', 199999);
session_name('sid');
session_start();
?>