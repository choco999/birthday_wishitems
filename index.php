<?php require('header.php');
    $id = null;
    $title = null;
    $author = null;
    $age = null;
    $gender = null;
    $birthday_item = null;

    if(!empty($_GET['id'])){

        $id = filter_input(INPUT_GET, 'id'); 

        require('connect.php');

        $sql = "SELECT * from course_project Where id = :id;";

        $statement = $db->prepare($sql);

        $statement->bindParam(':id', $id);

        $statement->execute();

        $records = $statement->fetchAll();

        foreach($records as $record) :
            //$id = $record['id'];
            $title = $record['title']; 
            $author = $record['author']; 
            $age = $record['age']; 
            $gender = $record['gender']; 
            $birthday_item = $record['birthday_item'];
        endforeach; 

        $statement->closeCursor(); 
    }
?>
    <main>
        <form action="process.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id?>">

            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?php echo $title?>">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" class="form-control" value="<?php echo $author?>">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" class="form-control" value="<?php echo $age?>">

            <label for="gender">Gender</label>
            <div>
                <input type="radio" id="male" name="gender" value="male" <?php echo ($gender == 'male') ?  "checked" : "" ;  ?>>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female" <?php echo ($gender == 'female') ?  "checked" : "" ;  ?>>
                <label for="female">Female</label>
                <input type="radio" id="other" name="gender" value="other" <?php echo ($gender == 'other') ?  "checked" : "" ;  ?>>
                <label for="other">Other</label>
            </div>

            <label for="bday-item">What do you want for your birthday?</label>
            <textarea name="bday-item" id="bday-item" cols="30" rows="10" class="form-control"><?php echo $birthday_item?></textarea>
            <input type="submit" value="submit" name="submit">
        </form>
    </main>
    <?php require('footer.php');?>