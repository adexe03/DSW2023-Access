<?php
if (isset($_POST['name'], $_POST['password'], $_POST['email'])) {
  $error_msg = "";
  if (empty($_POST['name'])) {
    $error_msg .= "<li>El nombre no puede estar vacío.</li>";
  } else {
    $name = $_POST['name'];
  }
  if (empty($_POST['password'])) {
    $error_msg .= "<li>La contraseña no puede estar vacía.</li>";
  } else {
    $password = $_POST['password'];
  }
  if (empty($_POST['email'])) {
    $error_msg .= "<li>El correo no puede estar vacío.</li>";
  } else {
    $email = $_POST['email'];
  }
  if (empty($error_msg)) {
    require_once 'connection.php';
    $stmt = $bd->prepare('INSERT INTO users (name, password, mail, validate, number_validate) VALUES (:name, :password, :mail, 0, :number_validate)');
    $number_validate = rand(100000, 10000000);
    $stmt->execute([
      ':name' => $name,
      ':password' => $password,
      ':mail' => $email,
      ':number_validate' => $number_validate
    ]);
    require_once 'email.php';
    $message = "<h1>Registro de usuarios</h1><h2>Hola $name</h2><p><a href=\"http://localhost/DSW2023-access/validate.php?username=$name&number_validate=$number_validate\">pincha aquí para validarte</a>";
    sendMail($email, "Validación de usuario", $message);
    header('Location: login.php');
    $stmt = null;
    $bd = null;
    exit;
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
  <h1>Crea una cuenta de usuario</h1>
  <?php
  if (isset($error_msg)) {
    echo "<div>$error_msg</div>";
  }
  ?>
  <form action="create-account.php" method="POST">
    <p>Nombre:
      <input type="text" name="name" id="">
    </p>
    <p>Contraseña:
      <input type="text" name="password" id="">
    </p>
    <p>Correo electrónico:
      <input type="email" name="email" id="">
    </p>
    <p>
      <input type="submit" value="Crear">
    </p>
  </form>
</body>

</html>