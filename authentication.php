<?php
    require('connect.php');
 
    $sql = "SELECT * FROM users WHERE email = :email";
    $conn = dbo();
    $statement = $conn->prepare($sql);
 
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');
    $email = strtolower($email);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
 
    $statement->execute();
 
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $statement->closeCursor();
 
    session_start();

    $auth = false;
    if (!$user) $auth = false;
    else $auth = password_verify($password, $user['password']); 

    if (!$auth) {
        $_SESSION['errors'][] = "Your email/password are incorrect.";
        $_SESSION['register_values'] = $_POST;
    
        header('Location: ./login.php');
        exit();
    }
    
    $_SESSION['user'] = $user;
    $_SESSION['successes'][] = "You have successfully logged in.";
    header('Location: mainform.php');
    exit();
