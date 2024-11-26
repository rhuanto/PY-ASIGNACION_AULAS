<?php
// Incluir la conexión a la base de datos
require 'db.php'; // Ajustada la ruta a la conexión

// Iniciar sesión para almacenar datos del usuario
session_start();

// Verificar que los datos hayan sido enviados desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Preparar la consulta para buscar el usuario en la base de datos
    $stmt = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si el usuario existe
    if ($stmt->num_rows > 0) {
        // Asociar los resultados
        $stmt->bind_result($id, $nombre, $hashed_password);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            // Iniciar sesión y almacenar datos en variables de sesión
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $nombre;

            // Redireccionar al usuario a la página principal (ajusta la ruta según sea necesario)
            header("Location: home.php"); // Ajustada la ruta a home.php
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: login.php?error=Contraseña incorrecta"); // Ajustada la ruta
            exit();
        }
    } else {
        // Usuario no encontrado
        header("Location: login.php?error=Correo no registrado"); // Ajustada la ruta
        exit();
    }
    
    // Cerrar la consulta
    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
