<?php
function connectDatabase($host = 'localhost', $user = 'root', $password = '', $db_name = 'food') {
    return new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);
  }


/*


function connectDatabase($host = 'localhost', $user = 'id16437493_roots', $password = 'u]c76I8Wz5a\F+M&', $db_name = 'id16437493_alya') {
    return new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);
  }
*/
?>