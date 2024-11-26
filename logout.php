<?php
session_start();
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión
// Redirige a la página de login
header('Location: Vista/V_V_Login/login.php'); // Redirige a la página de inicio de sesión
exit();
?>