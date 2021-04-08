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
  
  <!-- function _message($messages, $alert) {
    if ($messages && count($messages) > 0) {
      echo "<div class='alert alert-{$alert}'>";
        foreach($messages as $message) {
          echo "{$message}<br>";
        }
      echo "</div>";
    }
  }



  foreach (['danger' => $errors, 'success' => $successes] as $alert => $messages) { 
    _message($messages, $alert);
  } -->
