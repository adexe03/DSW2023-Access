<?php
if (isset($_POST['name'])) {
  $error_msg = "";
  if (empty($_POST['name'])) {
    $error_msg .= "<li>El nombre no puede estar vacío.</li>";
  } else {
    $name = $_POST['name'];
  }
  if (empty($error_msg)) {
    require_once 'connection.php';
    $stmt = $bd->prepare('SELECT * FROM users WHERE name=:name');
    $stmt->execute([':name' => $name]);
    if ($user = $stmt->fetch(PDO::FETCH_OBJ)) {
      $email = $user->mail;
      $stmt = null;
      $stmt = $bd->prepare('UPDATE users set number_validate=:number_validate WHERE name=:name');
      $number_validate = rand(100000, 10000000);
      $stmt->execute([
        ':number_validate' => $number_validate,
        ':name' => $name
      ]);
      require_once 'email.php';
      $message = "<h1>Recordar Contraseña</h1><h2>Hola $name</h2><p><a href=\"http://localhost/DSW2023-access/reset-password.php?username=$name&number_validate=$number_validate\">pincha aquí para restablecer tu contraseña</a>";
      sendMail($email, "Reestablecer contraseña", $message);
      header('Location: login.php');
    } else {
      $stmt = null;
    }
    $bd = null;
  }
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
  <h1>Olvidaste tu contraseña</h1>
  <?php
  if (isset($error_msg)) {
    echo "<div>$error_msg</div>";
  }
  ?>
  <form action="forgot.php" method="POST">
    <p>
      Indicame tu nombre de usuario:
      <input type="text" name="name" id="">
    </p>
    <p>
      <input type="submit" value="enviar correo">
    </p>
  </form>
</body>

</html>