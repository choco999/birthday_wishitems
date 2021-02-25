<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you for creating your birthday item</title>
</head>
<body>
    <header>
        <h1>Birthday Wish Item Forum</h1>
    </header>

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

    <footer>
        <p>COMP1006 - Chisato Sakata</p>
    </footer>
</body>
</html>