<?php
if (isset($_POST['name'], $_POST['number_validate'], $_POST['password'])) {
  $username = $_POST['name'];
  $number_validate = $_POST['number_validate'];
  $password = $_POST['password'];
  require_once 'connection.php';
  $stmt = $bd->prepare('UPDATE users SET password=:password WHERE name=:name AND number_validate=:number_validate');
  $stmt->execute([':name' => $username, ':number_validate' => $number_validate, ':password' => $password]);
  $stmt = null;
  $bd = null;
  header('Location: login.php');
}
