<?php 
    ob_start();
    require('header.php'); 

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

    // validation
    $errors = [];
    if(empty($title)){
        $errors[] = "Title is required";
    }

    if(empty($author)){
        $errors[] = "Author is required";
    }

    if(empty($birthday_item)){
        $errors[] = "Birthday item is required";
    }

    if(empty($age)){
        $errors[] = "Age is required";
    }

    if(!empty($age) && !filter_var($age, FILTER_VALIDATE_INT, [0, 120])){
        $errors = "Age must be 0 to 120";
    }


    if(count($errors) > 0){
        foreach($errors as $error){
            echo "<p>{$error}</p>";
        }
    } else {
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
            
            //echo "<a href='view.php'> View All Birthday Wish Items </a>"; 
    
            $statement->closeCursor();
    
            header('location:view.php');
    
        }
        catch(PDOException $e) {
            header('location:error.php');
        }
    }

    
    
    require('footer.php'); 
    ob_flush();

    //var_dump($title, $author, $age, $gender, $birthday_item);
    //var_dump($errors);
?>
