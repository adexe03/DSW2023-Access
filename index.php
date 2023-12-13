<?php
  require_once 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    header {
      text-align: right;
    }
  </style>
</head>
<body>
  <header>
    Usuario: <?= $_SESSION['username'] ?>
    <a href="logout.php">Cerrar sesión</a>
  </header>
  <h1>Página principal</h1>
  <p>Solo para personas autorizadas</p>
</body>
</html>