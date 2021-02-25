<?php require('header.php');

?>
    <main>
        <form action="process.php" method="post">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" class="form-control">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" class="form-control">

            <label for="gender">Gender</label>
            <div>
                <input type="radio" id="male" name="gender" value="male">
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label>
                <input type="radio" id="other" name="gender" value="other">
                <label for="other">Other</label>
            </div>
            <label for="bday-item">What do you want for your birthday?</label>
            <textarea name="bday-item" id="bday-item" cols="30" rows="10" class="form-control"></textarea>
            <input type="submit" value="submit" name="submit">
        </form>
    </main>
    <?php require('footer.php');
?>