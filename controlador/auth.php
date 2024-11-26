<?php
session_start(); // Inicia la sesión

// Función para verificar si el usuario está autenticado
function verificarAutenticacion() {
    if (!isset($_SESSION['usuario'])) {
        
        // Si no está logeado, redirige a la página de error 404
        header('HTTP/1.0 404 Not Found');
        include('C:/xampp/htdocs/SISTEMA RESERVA AULAS_/Vista/404.php'); // Ajusta la ruta según la ubicación de 404.php
        
        //header("Location: http://localhost/SISTEMA%20RESERVA%20AULAS_/Vista/V_V_Login/login.php"); // Redirige al usuario a la página de inicio de sesión
        exit(); // Asegúrate de salir para que no se ejecute el resto del script
    }
}
?>