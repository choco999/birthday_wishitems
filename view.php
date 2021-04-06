<?php require('header.php'); ?>

    <?php
      
    require('connect.php');

    $sql = "SELECT * FROM course_project";

    $statement = $db->prepare($sql);

    $statement->execute();
    
    $records = $statement->fetchAll();

    echo "<table class='table'><tbody>";

    foreach($records as $record){
        echo"<tr><td>"  .$record['title']. "</td><td>" 
                        .$record['author'] . "</td><td>"
                        .$record['age'] . "</td><td>" 
                        .$record['gender'] . "</td><td>" 
                        .$record['birthday_item'] . "</td><td><a href='delete.php?id=" . $record['id'] ."'>Delete</a></td>
                        <td><a href='index.php?id=" . $record['id'] . "'>Edit</a></td></tr>";
    }

    echo "</tbody></table>";

    $statement->closeCursor();

    ?>

<h2>Search Birthday Wish Items Here</h2>
<form action="search_results.php" method="get">
    <div class="row">
        <div class="col">
            <input type ="text" name="name" placeholder="Your name" class="form-control">
        </div>
        <div class="col">
            <input type="text" name="search" placeholder="Search for a birthday item" class="form-control">
        </div>
        <input type="submit" name="submit" value="Search" class="btn btn-primary">
    </div>
</form>

<?php require('footer.php'); ?>