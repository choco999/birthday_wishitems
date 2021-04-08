<?php

    // the recaptcha config
    include_once("config.php");

    session_start();
    // error handling function
    function error_handler ($errors) {
        if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['register_values'] = $_POST;
                
        header("Location: register.php");
        exit();
        }
    }

    $errors = [];

    // Validate the recaptcha
    if (!empty($_POST['recaptcha_response'])) {
        $secret = SECRETKEY;
        $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$_POST['recaptcha_response']}");
    
        $response_data = json_decode($verify_response);
        if (!$response_data->success) {
        $errors[] = "Google reCaptcha failed: " . ($response_data->{'error-codes'})[0];
        error_handler($errors);
        }
    }

    // Collect our fields
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $email_confirmation = filter_input(INPUT_POST, 'email_confirmation');
    $password = filter_input(INPUT_POST, 'password');
    $password_confirmation = filter_input(INPUT_POST, 'password_confirmation');

    // validate if fields are empty
    $required_fields = [
        'first_name',
        'last_name',
        'email',
        'email_confirmation',
        'password',
        'password_confirmation'
    ];

    // if it's empty, assign it to $errors array
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
          $human_field = str_replace("_", " ", $field);
          $errors[] = "{$human_field} is required.";
        }
    }

    // email validations
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "The email isn't in a valid format.";
    }

    if ($_POST['email'] !== $_POST['email_confirmation']) {
        $errors[] = "The email doesn't match the email confirmation field";
    }

    // password validation
    if ($_POST['password'] !== $_POST['password_confirmation']) {
        $errors[] = "The password doesn't match the password confirmation field";
    }

    // Check if there are  errors
    error_handler($errors);


    // normalize first name and last name
    foreach(['first_name', 'last_name'] as $field){
        $_POST[$field] = strtolower($_POST[$field]);
        $_POST[$field] = ucwords($_POST[$field]);
    }

    // normalize email
    $email = strtolower($email);

    // normalize password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // sanitization
    require('connect.php');

    $sql = "INSERT INTO users (
        first_name,
        last_name,
        email,
        password
      ) VALUES (
        :first_name,
        :last_name,
        :email,
        :password
    )";

    $statement = $db->prepare($sql);

    $statement->bindParam(':first_name', $first_name, PDO::PARAM_STR); 
    $statement->bindParam(':last_name', $last_name, PDO::PARAM_STR); 
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
 
    try {
        $statement->execute();

        $_SESSION['successes'][] = "You have been registered successfully.";
        header("Location: login.php");
        exit;
    } catch (Exception $error) {
        $errors[] = $error->getMessage();
        error_handler($errors);
    }
?>