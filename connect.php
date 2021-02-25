<?php

try {
    $dsn = 'mysql:host=localhost;dbname=comp1006';
    $username = 'root';
    $password = '';

    $db = new PDO($dsn, $username, $password);
    echo 'Connected';
}
catch(PDOException $e) {
    $error_message = $e->getMessage();
    echo 'Error!' . $error_message;
}

?>