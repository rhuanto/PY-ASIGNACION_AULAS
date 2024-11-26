<?php
// Iniciar sesión
//session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirigir al login
    header('Location: Vista/V_V_Login/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Asignación de Aulas</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="Vista/V_V_Principal/index.php">Inicio</a></li>
            <li><a href="Vista/V_V_Login/logout.php">Cerrar Sesión</a></li> <!-- Opción para cerrar sesión -->
        </ul>
    </nav>
</body>
</html>

