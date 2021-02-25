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
      
    require('connect.php');

    $sql = "SELECT * FROM course_projects";

    $statement = $db->prepare($sql);

    $statement->execute();
    
    $records = $statement->fetchAll();

    echo "<table><tbody>";

    foreach($records as $record){
        echo"<tr><td>"  .$record['first_name']. "</td><td>" 
                        .$record['last_name'] . "</td><td>"
                        .$record['age'] . "</td><td>" 
                        .$record['gender'] . "</td><td>" 
                        .$record['birthday_item'] . "</td></tr>";
    }

    echo "</tbody></table>";

    $statement->closeCursor();

    ?>

    <footer>
        <p>COMP1006 - Chisato Sakata</p>
    </footer>
</body>
</html>