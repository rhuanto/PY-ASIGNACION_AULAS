<?php
session_start();
require_once '../modelos/Usuario.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $usuario = new Usuario();
    if ($usuario->autenticarUsuario($email, $password)) {
        $_SESSION['usuario'] = $email; // Guarda el estado del usuario en la sesión
        header("Location: ../Vista/V_V_Principal/index.html"); // Cambia a index.php
    } else {
        header("Location: ../Vista/V_V_Login/login.php?error=Email o contraseña incorrectos");
    }
}
?>
