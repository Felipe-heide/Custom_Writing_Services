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
$correo = $_SESSION['usuario'];
$sql = "SELECT clases FROM usuarios WHERE correo = '$correo'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$clases = $row['clases'];
$sql = "SELECT nombre_completo FROM usuarios WHERE correo = '$correo'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$nombre_completo = $row['nombre_completo'];
$data = json_decode($clases, True);
$textos = array();
$resumenes = array();
$contenido_texto= "";
$contenido_resumen= "";

for ($i = 0; $i < count($data); $i++) {
  $materia = $data[$array[$i]];
  $veces = count($materia);
  for ($e = 0; $e < $veces; $e++) {
    $nombre = $materia[$e]['nombre'];
    $texto = $materia[$e]['texto'];
    $resumen = $materia[$e]['resumen'];
    $contenidoAcordeon = '<div class="acordeon"><div class="heading"  onclick="lolllllllll('.$e.')" ><div class="left-text">' . $nombre . ' #' . $e . '</div><span class="right-icon"  id="'.$e.'" >&#709;</span></div><div class="content" id="'.$e.'l"><p>' . $texto . '</p></div></div>    <input type="hidden" value="cerrado" id="'.$e.'v"> 
    ';

    $contenidoResumen = '<div class="acordeon"><div class="heading" onclick="lolllllllll('.$e.')"><div class="left-text">' . $nombre . ' #' . $e . '</div><span class="right-icon" id="'.$e.'">&#709;</span></div><div class="content" id="'.$e.'l"><p>' . $resumen . '</p></div></div>    <input type="hidden" value="cerrado" id="'.$e.'v">';

    $contenido_texto = $contenido_texto . $contenidoAcordeon;
    $contenido_resumen = $contenido_resumen . $contenidoResumen;
  };

  $textos[$array[$i]] = $contenido_texto;
  $resumenes[$array[$i]] = $contenido_resumen;
  $contenido_texto="";
  $contenido_resumen="";
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/study.css">
    <title>C.W.S</title>
    <link rel="icon"  href="https://img.freepik.com/psd-premium/maqueta-logotipo-neon-ince_170579-1170.jpg?w=740" type="image/png">
  
</head>
<body>
<a class="profile" href="informacion_usuario.php"><?php echo $nombre_completo; ?></a>

  <h1>Custom Writing Services</h1>
  <select id="materia" name="materia" class="lang" onchange="cambiar_todo()">
  <option value="seleccionar" class="lang_select_escronder">Select subject</option>
  <?php echo $opciones; ?>
  </select>
</select>

<section onclick="funcionesCombinadas()">
<button id="boton1" class="primero">Class</button>
<button id="boton2" class="segundo">Summary</button>
</section>
<input type="hidden" id="seleccion" value="boton1">
<br><br>
<section class="padre">
<section class="contenedor" id="contenedor">
  </section>
  </section>

 <script src="assets/js/study.js"></script>
 <script>
  function funcionesCombinadas() {
    cambiar();
    cambiar_todo();

}
function cambiar_todo(){
  input = document.getElementById("seleccion");

  if(input.value=="boton1"){
    console.log("textoooooo")
    var selectElement = document.getElementById("materia"); // Reemplaza "miSelect" con el ID de tu elemento <select>
    var valorSeleccionado = selectElement.value;
    <?php echo "var textos = " . json_encode($textos) . ";";?>
    var contenido = textos[valorSeleccionado];
    document.getElementById("contenedor").innerHTML = contenido;

    }else{
      console.log("resumennnnnnnn")

      var selectElement = document.getElementById("materia"); // Reemplaza "miSelect" con el ID de tu elemento <select>
    var valorSeleccionado = selectElement.value;
    <?php echo "var textos = " . json_encode($resumenes) . ";";?>
    var contenido = textos[valorSeleccionado];
    document.getElementById("contenedor").innerHTML = contenido;
    }
  
}





function lolllllllll(id){
  var nuevo =String(id)+"v";
  var estado =document.getElementById(nuevo).value;
  console.log(estado)
  if(estado=="cerrado"){
    icon = document.getElementById(id);
    otro = String(id) + "l";
    contenido = document.getElementById(otro);
    document.getElementById(nuevo).value = "abierto"

    icon.style.setProperty("transform", "rotate(180deg)")
    contenido.style.setProperty("display", "block")
}else{
  icon = document.getElementById(id);
  otro = String(id) + "l";
  contenido = document.getElementById(otro);

  icon.style.setProperty("transform", "rotate(360deg)")
  contenido.style.setProperty("display", "none");
  document.getElementById(nuevo).value = "cerrado"

}

}

    </script>

</body>
</html>
