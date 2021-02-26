<?php
    ob_start(); // output buffering

    $id = filter_input(INPUT_GET,'id');

    try {
        require('connect.php');
    
        $sql = "DELETE from course_project WHERE id = :id;";
    
        $statement = $db->prepare($sql);
    
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