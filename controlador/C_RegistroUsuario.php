<?php
require_once '../modelos/Usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombreUsuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $usuario = new Usuario();
    if ($usuario->registrarUsuario($nombre, $email, $password)) {
        header("Location: http://localhost:8012/SISTEMA%20RESERVA%20AULAS_/Vista/V_V_Login/login.php"); // Redirigir al login después del registro
    } else {
        echo "Error al registrar el usuario.";
    }
}
?>
