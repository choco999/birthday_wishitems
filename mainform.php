<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION['user'])){
        $_SESSION['errors'][] = "You need to log in";
        header('Location: ./login.php');
        exit;
    }

    $user = $_SESSION['user'];
    
    $form_values = $_SESSION['form_values'] ?? null;

    unset($_SESSION['form_values']);

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
    <?php include_once('notification.php') ?>
    <div class="container">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="mainform.php"> Add New Post <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view.php">View Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header>
        <div class="jumbotron">
            <h3>Hello <?= "{$user['first_name']} {$user['last_name']}" ?></h3>
        </div>
        
        <h1>Birthday Wish Item Forum</h1>
    </header>
    <main>
        
        <form action="process.php" method="post" novalidate>
            <input type="hidden" name="id" value="<?php echo $id?>">

            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= $form_values['title'] ?? null ?>" required>
            <label for="author">Author</label>
            <input type="text" name="author" id="author" class="form-control" value="<?= $form_values['author'] ?? null ?>" required>
            <label for="age">Age</label>
            <input type="number" name="age" id="age" class="form-control" value="<?= $form_values['age'] ?? null ?>" required max="120" min="0" step="1">

            <label for="gender">Gender</label>
            <div>
                <input type="radio" id="male" name="gender" value="male" checked <?php echo ($gender == 'male') ?  "checked" : "" ;  ?>>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female" <?php echo ($gender == 'female') ?  "checked" : "" ;  ?>>
                <label for="female">Female</label>
                <input type="radio" id="other" name="gender" value="other" <?php echo ($gender == 'other') ?  "checked" : "" ;  ?>>
                <label for="other">Other</label>
            </div>

            <label for="bday-item">What do you want for your birthday?</label>
            <textarea name="bday-item" id="bday-item" cols="30" rows="10" class="form-control" required><?= $form_values['bday-item'] ?? null ?></textarea>
            <input class="btn btn-primary" type="submit" value="submit" name="submit">
        <!-- Add the recaptcha field -->
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        </form>
    </main>
    <?php require('footer.php');?>