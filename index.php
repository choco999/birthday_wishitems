<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birthday Wish-list Forum</title>
</head>
<body>
    <header>
        <h1>Birthday Wish Item Forum</h1>
    </header>
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
    <footer>
        <p>COMP1006 - Chisato Sakata</p>
    </footer>
</body>
</html>