<?php
    require('connect.php');
 
    $sql = "SELECT * FROM users WHERE email = :email";
 
    $statement = $db->prepare($sql);
 
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');
    $email = strtolower($email);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
 
    $statement->execute();
 
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $statement->closeCursor();
 
    session_start();
 
    // $email_auth = true;
    // $password_auth = false;
    // if (!$user) $email_auth = false;
    // else $password_auth = password_verify($password, $user['password']);
 
    // if (!$emaild_auth) {
    //     $_SESSION['errors'][] = "Your email are incorrect.";
    //     $_SESSION['register_values'] = $_POST;
        
     
    //     header('Location: ./login.php');
    //     exit();
    // }
 
    // if (!$password_auth) {
    //     $_SESSION['errors'][] = "Your password are incorrect.";
    //     $_SESSION['register_values'] = $_POST;
     
    //     header('Location: ./login.php');
    //     exit();
    // }


    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $auth = false;
    if (!$user) $auth = false;
    else $auth = password_verify($password, $user['password']); // this always returns false
    //else $auth = password_verify($password, $hashed); // to be able to access login.php (because this always returns true)

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
