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
$correo = $_SESSION['usuario'];
$sql = "SELECT materias FROM usuarios WHERE correo = '$correo'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$materias = substr($row['materias'], 0, -1);

$array = explode("|", $materias);
$cantidadElementos = count($array);
$opciones = "";
for ($i = 0; $i < $cantidadElementos; $i++) {
  $opcion = '<option value="' . $array[$i] . '" class="lang_select" >' . $array[$i] . '</option>';
  $opciones = $opciones . $opcion;
}

$sql = "SELECT nombre_completo FROM usuarios WHERE correo = '$correo'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$nombre_completo = $row['nombre_completo'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C.W.S</title>
     <link rel="stylesheet" href="assets/css/recording.css">
    <link rel="icon"  href="https://img.freepik.com/psd-premium/maqueta-logotipo-neon-ince_170579-1170.jpg?w=740" type="image/png">
  
</head>
<body>
<a class="profile" href="informacion_usuario.php"><?php echo $nombre_completo; ?></a>

  <h1 id="x">Custom Writing Services</h1>
   <br><br>
  
<select id="lang" name="lang" class="lang">
<option value="seleccionar" class="lang_select_escronder">Select language</option>
  <option value="en-US" class="lang_select">English</option>
  <option value="fr-FR" class="lang_select">French</option>
  <option value="pt-BR" class="lang_select">Portuguese</option>
</select>
<input type="text" placeholder="Name the class" class="input" id="nombre">

<select id="materia" name="materia" class="lang" onchange="agregar_opcion(this)">
<option value="seleccionar" class="lang_select_escronder">Select subject</option>
  <?php echo $opciones; ?>
  <option value="agregar" class="lang_select" >Add option <b>+</b></option>

</select>
<button class="custom-btn btn-16" id="btnStartRecord" onclick="comenzar()">Start Recording</button>




<br><br>
    <section class="section">
    <label for="lang">What was said:</label>
    <label for="lang">Summary:</label>
  </section>
  <section class="section2">
    <textarea id="texto" rows="10" cols="60" name="texto" class="textarea"></textarea>
    <textarea id="resumen" rows="10" cols="60" name="texto" class="textarea"></textarea>
    </section>

      <input type="hidden" id="lang">


    <form action="php/add_recording.php" method="POST" id="recording_form">
    <input type="hidden" id="nombre2" name="nombre">
    <input type="hidden" id="materia2" name="materia">
    <input type="hidden" id="texto2" name="texto">
    <input type="hidden" id="resumen2" name="resumen">
    <input type="hidden" id="new" name="new" value="False">
    <input type="hidden" id="new_materia" name="new_materia" value="False">
    </form>

    <script src="assets/js/recording.js"></script>
</body>
</html>
