<?php 
    ob_start();
    require('header.php'); 

    $title = filter_input(INPUT_POST, 'title');
    $author = filter_input(INPUT_POST, 'author');
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $gender = filter_input(INPUT_POST, 'gender');
    $birthday_item = filter_input(INPUT_POST, 'bday-item');

    $id = null;
    $id = filter_input(INPUT_POST,'id');

    $ok = true;

    if($age === false){
        echo "<p>Please enter a numeric value</p>";
        $ok = false;
    } 

    if($ok === true){
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
?>