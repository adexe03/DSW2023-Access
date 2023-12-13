<?php
if (isset($_GET['username'], $_GET['number_validate'])) {
  $username = $_GET['username'];
  $number_validate = $_GET['number_validate'];
  require_once 'connection.php';
  $stmt = $bd->prepare('UPDATE users SET validate=true WHERE name=:name AND number_validate=:number_validate');
  $stmt->execute([':name' => $username, ':number_validate' => $number_validate]);
  $stmt = null;
  $bd = null;
  header('Location: login.php');
}
