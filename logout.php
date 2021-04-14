<?php
  session_start();

  if (!isset($_SESSION['user'])) {
    $_SESSION['errors'][] = "You must log in";
    header('Location: ./login.php');
    exit;
  }

  unset($_SESSION['user']);
  
  $_SESSION['successes'][] = "You are successfully logged out!";
  header("Location: ./login.php");
  exit();