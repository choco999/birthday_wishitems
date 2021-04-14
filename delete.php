<?php
    ob_start(); // output buffering

    $id = filter_input(INPUT_GET,'id');

    try {
        require('connect.php');
    
        $conn = dbo();

        $sql = "DELETE from course_project WHERE id = :id;";
    
        $statement = $conn->prepare($sql);
    
        $statement->bindParam(':id', $id);
    
        $statement->execute();
    
        $statement->closeCursor();

        header('location:view.php');
        
    }
    catch(PDOException $e){
        header('location:error.php');
    }

    ob_flush();
?>