<?php

try {
    $dsn = 'mysql:host=172.31.22.43;dbname=Chisato200380632';
    $username = 'Chisato200380632';
    $password = '5GwBXReEAG';

    // $dsn = 'mysql:host=localhost;dbname=comp1006';
    // $username = 'root'; 
    // $password = '';

    $db = new PDO($dsn, $username, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e) {
    $error_message = $e->getMessage();
    echo 'Error!' . $error_message;
}

?>