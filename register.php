<?php
    session_start();
    $register_values = $_SESSION['register_values'] ?? null;

    unset($_SESSION['register_values']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
    <?php include_once('notification.php') ?>
    <div class="container">
        <header>
            <h1>Registration</h1>
        </header>

        <main>
            <form action="insert.php" method="post" novalidate>
                <label for="first_name">First Name:</label>
                <input class="form-control" type="text" name="first_name" value="<?= $register_values['first_name'] ?? null ?>" required placeholder="Chisato">

                <label for="last_name">Last Name:</label>
                <input class="form-control" type="text" name="last_name" value="<?= $register_values['last_name'] ?? null ?>" required placeholder="Sakata">

                <label for="email">Email:</label>
                <input class="form-control" type="email" name="email" placeholder="cs@test.com" value="<?= $register_values['email'] ?? null ?>" required>

                <label for="email_confirmation">Email Confirmation:</label>
                <input class="form-control" type="email" name="email_confirmation" placeholder="cs@test.com" value="<?= $register_values['email_confirmation'] ?? null ?>" required>

                <label for="password">Password:</label>
                <input class="form-control" type="password" name="password" required>

                <label for="password_confirmation">Password Confirmation:</label>
                <input class="form-control" type="password" name="password_confirmation" required>

                <!-- Add the recaptcha field -->
                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

                <button class="btn btn-primary" type="submit">Register</button>
                <a class="btn btn-outline-primary" href="login.php">Login</a>
            </form>
        </main>




<?php require('footer.php');?>

