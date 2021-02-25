<?php require('header.php'); ?>

    <?php
        $first_name = filter_input(INPUT_POST, 'fname');
        $last_name = filter_input(INPUT_POST, 'lname');
        $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
        $gender = filter_input(INPUT_POST, 'gender');
        $birthday_item = filter_input(INPUT_POST, 'bday-item');


        $ok = true;

        if($age === false){
            echo "<p>Please enter a numeric value</p>";
            $ok = false;
        } 

        if($ok === true){
            try {
                require('connect.php');

                $sql = "INSERT into course_project(first_name, last_name, age, gender, birthday_item) 
                        VALUES (:firstname, :lastname, :age, :gender, :bdayitem)";

                $statement = $db->prepare($sql);
                
                $statement->bindParam(':firstname',$first_name);
                $statement->bindParam(':lastname',$last_name);
                $statement->bindParam(':age',$age);
                $statement->bindParam(':gender',$gender);
                $statement->bindParam(':bdayitem',$birthday_item);
        
                $statement->execute();
                
                echo "<a href='view.php'> View All Birthday Wish Items </a>"; 

                $statement->closeCursor();

            }
            catch(PDOException $e) {
                echo "<p>Error!</p>";
                $error_message = $e->getMessage();
                echo $error_message;
            }
        }
            
    ?>

<?php require('footer.php'); ?>