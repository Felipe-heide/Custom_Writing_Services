<?php

session_start();

include "php/conexion.php";

if(!isset($_SESSION['usuario'])){
    echo '<script>
    alert("Please, you must log in.");
    window.location = "index.php"
          </script>
    ';
    session_destroy();
    die();
}

$correoUsuario = $_SESSION["usuario"];
$consulta = "SELECT nombre_completo FROM usuarios WHERE correo = '$correoUsuario'";
$nombre_completo = mysqli_query($conn, $consulta);
$row = mysqli_fetch_assoc($nombre_completo);
$nombreCompleto = $row["nombre_completo"];

$consulta2 = "SELECT usuario FROM usuarios WHERE correo = '$correoUsuario'";
$usuario = mysqli_query($conn, $consulta2);
$row = mysqli_fetch_assoc($usuario);
$usuario = $row["usuario"];

$consulta3 = "SELECT contrasena FROM usuarios WHERE correo = '$correoUsuario'";
$contrasena = mysqli_query($conn, $consulta3);
$row = mysqli_fetch_assoc($contrasena);
$contrasena = $row["contrasena"];

$sql = "SELECT materias FROM usuarios WHERE correo = '$correoUsuario'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$materias = substr($row['materias'], 0, -1);
$array = explode("|", $materias);
$cantidadElementos = count($array);

$consulta4 = "SELECT grabaciones FROM usuarios WHERE correo = '$correoUsuario'";
$grabaciones = mysqli_query($conn, $consulta4);
$row = mysqli_fetch_assoc($grabaciones);
$grabaciones = $row["grabaciones"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nombreCompleto; ?></title>
    <link rel="stylesheet" href="assets/css/informacion_usuario.css">
</head>
<body>
<a href="bienvenida.php"><span>&larr;</span></a>

<div class="user-profile">
    <section>
  <img class="profile-picture" src="https://previews.123rf.com/images/burntime555/burntime5551508/burntime555150800045/43090402-letra-f-icono-de-la-web-plana-o-signo-aislado-en-el-fondo-gris-ilustraci%C3%B3n-de-vector-de-estilo-de.jpg" alt="Foto de perfil">
  <h1 class="username"><?php echo $nombreCompleto; ?></h1>
  <p class="email"><b>Correo:</b> <?php echo $correoUsuario; ?></p>
  <p class="email"><b>Usuario:</b> <?php echo $usuario; ?></p>

  <p class="recordings"><b>Grabaciones:</b> <?php echo $grabaciones;?></p>
  <p class="subjects"><b>Materias:</b> <?php echo $cantidadElementos;?></p>
  <a href="php/cerrar_sesion.php"><button class="logout-button">Cerrar sesión</button></a>
  </section>
</div>

<script src="assets/js/usuario.js"></script>
</body>
</html>

