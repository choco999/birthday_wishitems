<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birthday Wish Item Forum</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>

<?php 
    //session_start();

    echo "<div class='container'>";

    $submit = filter_input(INPUT_GET, 'submit');
    $search_term = filter_input(INPUT_GET, 'search');
    $name = filter_input(INPUT_GET, 'name');

    require('connect.php');

    //$_SESSION['name'] = $name;

    $sql = "SELECT title, birthday_item from course_project 
            WHERE title LIKE :search_term OR birthday_item LIKE :search_term;";
    
    $statement = $db->prepare($sql);

    $statement->bindValue(':search_term', '%' .$search_term . '%');

    $statement->execute();

    echo "<table><tbody>";

    if(!empty($search_term)){
        if($statement->rowCount() >= 1){
            echo "<h1> We found " . $statement->rowCount() . " items related to '" . $search_term. "'</h1>";
            while($results = $statement->fetch()){
                // echo "<tr><td>Title: " .$results['title'] . "</td><td> Birthday Item: " 
                //                 .$results['birthday_item'] . "</td></tr>";
                echo "<li>" . $results['birthday_item'] . "</li>";
            }
        }
        else {
            echo "<h1>No items found related to ". $search_term. "</h1>";
        }
    }
    else {
        echo"<h1>" . $name . " You didn't enter any search terms.</h1>";
    }

    echo "</tbody></table>";

    
    echo "<a href='view.php'>Back to Search</a>";
    echo "</div>";

    $statement->closeCursor();
?>
