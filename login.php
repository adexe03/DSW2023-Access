<?php
if (isset($_POST['username'], $_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  require_once 'connection.php';
  $stmt = $bd->prepare('SELECT * FROM users WHERE name=:name AND password=:password AND validate');
  $stmt->execute([':name' => $username, ':password' => $password]);
  if ($user = $stmt->fetch(PDO::FETCH_OBJ)) {
    session_start();
    $_SESSION['username'] = $user->name;
    $_SESSION['mail'] = $user->mail;
    header('Location: index.php');
    $stmt = null;
    $bd = null;
    exit;
  } else {
    $error_msg = "Usuario o contraseña incorrectos";
  }
  $stmt = null;
  $bd = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  if (isset($error_msg)) {
    echo "<div>$error_msg</div>";
  }
  ?>
  <form action="login.php" method="POST">
    <input type="text" name="username" placeholder="user">
    <input type="password" name="password" placeholder="password">
    <input type="submit" value="entrar">
  </form>
  <p>
    <a href="create-account.php">Crear usuario</a>
    <a href="forgot.php">Olvidé la contraseña</a>
  </p>
</body>

</html>