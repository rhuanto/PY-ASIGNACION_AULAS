<?php
// C_RecuperarContraseña.php
require 'db.php'; // Ajustada la ruta a la conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50)); // Genera un token seguro

    // Verificar si el correo existe en la base de datos
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Insertar token en la base de datos
        $stmt = $conn->prepare("UPDATE usuarios SET reset_token = ?, reset_expira = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?");
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        // Enviar email con el enlace de recuperación
        $enlace = "http://localhost:8012/SISTEMA%20RESERVA%20AULAS_/Vista/V_V_Login/reestablecer_contraseña.php?token=$token"; 
        $asunto = "Recuperación de Contraseña";
        $mensaje = "Haz clic en el siguiente enlace para restablecer tu contraseña: $enlace";
        $cabeceras = "From: no-reply@tu_dominio.com\r\n";

        if (mail($email, $asunto, $mensaje, $cabeceras)) {
            echo "Correo enviado con éxito"; 
            header("Location: recuperar_contraseña.php?mensaje=Revisa tu correo para recuperar la contraseña");
        } else {
            echo "Error al enviar el correo";
            header("Location: recuperar_contraseña.php?mensaje=Error al enviar el correo");
        }
    } else {
        echo "Error al enviar el correo no se encontro correo";
        header("Location: recuperar_contraseña.php?mensaje=Correo no encontrado");
    }
}
?>
