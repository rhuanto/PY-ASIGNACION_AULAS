<?php
// C_ReestablecerContraseña.php
require 'db.php'; // Ajustada la ruta a la conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificar token y que no haya expirado
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE reset_token = ? AND reset_expira > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Actualizar contraseña
        $stmt = $conn->prepare("UPDATE usuarios SET password = ?, reset_token = NULL, reset_expira = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $password, $token);
        $stmt->execute();
        
        header("Location: login.php?mensaje=Contraseña restablecida correctamente"); // Ajustada la ruta
    } else {
        header("Location: reestablecer_contraseña.php?mensaje=Token inválido o expirado"); // Ajustada la ruta
    }
}
?>
