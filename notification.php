<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  
  // Store the errors and clear the session variable
  $errors = $_SESSION['errors'] ?? null;

  // Store the success messages and clear the session variable
  $successes = $_SESSION['successes'] ?? null;

  // Clear the session variables
  unset($_SESSION['errors']);
  unset($_SESSION['successes']);

?>

<?php if ($errors && count($errors) > 0): ?>
  <div class="alert alert-danger">
    <?php foreach ($errors as $error) echo "{$error}<br>"; ?>
  </div>
<?php endif ?>

<?php if ($successes && count($successes) > 0): ?>
  <div class="alert alert-success">
    <?php foreach ($successes as $success) echo "{$success}<br>"; ?>
  </div>
<?php endif ?>
