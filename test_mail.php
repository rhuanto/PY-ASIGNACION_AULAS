<?php
$to = 'oliver.mq001@gmail.com'; // Cambia esto por tu correo
$subject = 'Prueba de correo';
$message = 'Este es un correo de prueba desde PHP.';
$headers = 'From: oliver.mq001@gmail.com' . "\r\n" .
           'Reply-To: oliver.mq001@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'Correo enviado con éxito';
} else {
    echo 'Error al enviar el correo';
}
?>
