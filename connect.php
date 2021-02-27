<?php

try {
    $dsn = 'mysql:host=172.31.22.43;dbname=Chisato200380632';
    $username = 'Chisato200380632';
    $password = '5GwBXReEAG';

    $db = new PDO($dsn, $username, $password);
}
catch(PDOException $e) {
    $error_message = $e->getMessage();
    echo 'Error!' . $error_message;
}

?>