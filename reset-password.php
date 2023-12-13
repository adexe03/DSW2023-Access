<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Restablecer Contraseña</h1>
  <?php
  if (isset($_GET['username'], $_GET['number_validate'])) {
    $username = $_GET['username'];
    $number_validate = $_GET['number_validate'];
  ?>
    <form action="set-password.php" method="post">
      <p>
        Nueva Contraseña:
        <input type="text" name="password" id="">
      </p>
      <p>
        <input type="submit" value="Reestablecer">
      </p>
      <input type="hidden" name="name" value="<?= $username ?>">
      <input type="hidden" name="number_validate" value="<?= $number_validate ?>">
    </form>
  <?php
  } else {
    echo '<h2>Error no se tienen los datos del usuario</h2>';
  }
  ?>
</body>

</html>