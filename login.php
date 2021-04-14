<?php

  // Before we render the form let's check for form values
  session_start();
  $register_values = $_SESSION['register_values'] ?? null;

  // Clear the form values
  unset($_SESSION['register_values']);

  //var_dump($register_values);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
    <?php include_once('notification.php') ?>
    <div class="container">
        <header>
            <h1>Login</h1>
        </header>

        <main>
            <form action="./authentication.php" method="post">
                
                <label for="email">Email:</label>
                <input class="form-control" type="email" name="email" placeholder="cs@test.com" value="<?= $register_values['email'] ?? null ?>" required>

                <label for="password">Password:</label>
                <input class="form-control" type="password" name="password" required>
                <!-- <input class="form-control" type="password" name="password" value="<?= $register_values['password'] ?? null ?>" required> -->

                <!-- Add the recaptcha field -->
                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

                <button class="btn btn-primary" type="submit">Login</button>
                <a class="btn btn-outline-primary" href="register.php">Register</a>
            </form>
        </main>

<?php require('footer.php');?>