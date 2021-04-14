<?php 
    ob_start();

    // Include the recaptcha config
    include_once("config.php");
    require('header.php'); 

    // error handling function
    session_start();
    function error_handler ($errors) {
        if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_values'] = $_POST;
    
        header("Location: mainform.php");
        exit;
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

    // sanitization
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
    $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
    $gender = filter_input(INPUT_POST, 'gender');
    $birthday_item = filter_input(INPUT_POST, 'bday-item', FILTER_SANITIZE_STRING);

    $id = null;
    $id = filter_input(INPUT_POST,'id', FILTER_SANITIZE_NUMBER_INT);

    // Normalization
    $title = mb_convert_case($title, MB_CASE_TITLE);
    $author = mb_convert_case($author, MB_CASE_TITLE);
    $birthday_item = mb_convert_case($birthday_item, MB_CASE_TITLE);

    // validate the required fields aren't empty
    $required_fields = [
        'title',
        'author',
        'age',
        'birthday_item'
    ];

    foreach($required_fields as $field){
        if (empty($$field)) { // variable variable
            $human_field = str_replace("_", " ", $field);
            $errors[] = "{$human_field} is required.";
        }
    }

    // other validations
    if (!empty($_POST['age']) && !$age) {
        array_push($errors, "Age must be an integer");
    }

    error_handler($errors);


    try {
        require('connect.php');

        if(!empty($id)) {
            $sql = "UPDATE course_project SET title = :title, author= :author, age = :age, 
                                        gender = :gender, birthday_item = :birthday_item
                                        WHERE id = :id;";
        }
        else {
            $sql = "INSERT into course_project(title, author, age, gender, birthday_item) 
            VALUES (:title, :author, :age, :gender, :birthday_item)";
        }
        

        $statement = $db->prepare($sql);
        
        $statement->bindParam(':title',$title);
        $statement->bindParam(':author',$author);
        $statement->bindParam(':age',$age);
        $statement->bindParam(':gender',$gender);
        $statement->bindParam(':birthday_item',$birthday_item);
        
        if(!empty($id)){
            $statement->bindParam(':id',$id);
        }

        $statement->execute();
        
        $_SESSION['successes'][] = "You have been added your item successfully.";

        $statement->closeCursor();

        header('location:view.php');

    }
    catch(PDOException $e) {
        header('location:error.php');
    }

    // var_dump($title, $author, $age, $gender, $birthday_item);
    // var_dump($errors);
    
    require('footer.php'); 
    ob_flush();

    
?>
