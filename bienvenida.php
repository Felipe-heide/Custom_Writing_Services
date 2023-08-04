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




?>

<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C.W.S</title>
    <link rel="stylesheet" href="assets/css/bienvenida.css">
 
</head>
<body> 
    <a class="profile" href="informacion_usuario.php"><?php echo $nombreCompleto; ?></a>
    <!-- <a href="php/cerrar_sesion.php" class="logout-button">Cerrar sesión</a>-->

    <section>
        <h2>Custom Writing Services</h2>
    </section>
    <section class="type_of_help_section">
        <p>You want to...</p><br><br>
        <a href="new_recording.php"><button class="button">New Recording</button></a>
        <a href="study.php"><button class="button">Old Classes</button></a>
        

    </section>
    <!--<section class="nav">
        <a href="about_us.html" class="link">About Us</a>
        <a href="contact_us.html" class="link">Contact Us</a>
    </section>-->
</body>
</html>