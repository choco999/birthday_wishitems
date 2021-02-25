<?php require('header.php');

?>
    <main>
        <form action="process.php" method="post">
            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname">
            <label for="age">Your Age</label>
            <input type="number" name="age" id="age">

            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label>
            <input type="radio" id="other" name="gender" value="other">
            <label for="other">Other</label>

            <label for="bday-item">Birthday Item</label>
            <input type="text" id="bday-item" name="bday-item">
            <input type="submit" value="submit" name="submit">
        </form>
    </main>
    <?php require('footer.php');
?>