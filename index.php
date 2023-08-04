<?php

session_start();


if(isset($_SESSION['usuario'])){
    header("location: bienvenida.php");
    die();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C.W.S</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

        <main>
            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                    <h3>Already have an account?</h3>
                    <p>Log in to enter the page</p>
                        <button id="btn__iniciar-sesion">Log in</button>
                    </div>
                    <div class="caja__trasera-register">
                    <h3>Don't have an account?</h3>
                    <p>Register to be able to log in</p>
                        <button id="btn__registrarse">Register</button>
                    </div>
                </div>

                <div class="contenedor__login-register">
                    <form action="php/login_usuario_be.php" method="POST" class="formulario__login">
                        <h2>Log in</h2>
                        <input type="email" placeholder="Email" name="correo" required>
                        <input type="password" placeholder="Password" name="contrasena" required>
                        <button>Login</button>
                    </form>

                    <form action="php/registro_usuario_be.php" method="POST" class="formulario__register">
                        <h2>Register</h2>
                        <input type="text" placeholder="Full name" name="nombre_completo" required>
                        <input type="email" placeholder="Email" name="correo" required>
                        <input type="text" placeholder="Username" name="usuario" required>
                        <input type="password" placeholder="Password" name="contrasena" required>
                        <button>Register</button>
                    </form>
                </div>
            </div>

        </main>

        <script src="assets/js/script.js"></script>
</body>
</html>