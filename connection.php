<?php
$connection = 'mysql:dbname=access;host=localhost';
$userDB = 'root';
$pwDB = '';
try {
  $bd = new PDO($connection, $userDB, $pwDB);
} catch (Exception $e) {
  exit('Error al conectar con la base de datos: ' . $e->getMessage());
}
