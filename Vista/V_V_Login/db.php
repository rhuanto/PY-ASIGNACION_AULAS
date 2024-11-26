<?php
$servername = "localhost"; // o la IP del servidor donde esté alojada la BD
$username = "root"; // tu usuario de MySQL
$password = ""; // tu contraseña de MySQL
$dbname = "trabajo"; // el nombre de la base de datos
$port = 3307;             // Puerto personalizado de MySQL

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>
