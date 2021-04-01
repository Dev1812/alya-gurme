<?php
function connectDatabase($host = 'localhost', $user = 'm900311w_q', $password = 'PMVILP9COdE!', $db_name = 'm900311w_q') {
    return new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);
  }
?>