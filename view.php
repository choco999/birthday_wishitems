<?php require('header.php'); ?>

    <?php
      
    require('connect.php');

    $sql = "SELECT * FROM course_project";

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

<?php require('footer.php'); ?>