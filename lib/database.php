<?php
function connectDatabase($host = 'localhost', $user = 'root', $password = '', $db_name = 'food') {
    return new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);
  }
?>