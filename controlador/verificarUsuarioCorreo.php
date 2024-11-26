<?php
require_once '../modelos/Usuario.php';

header('Content-Type: application/json');

$response = ['existeCorreo' => false, 'existeUsuario' => false];
$usuario = new Usuario();

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $response['existeCorreo'] = $usuario->existeEmail($email);
}

if (isset($_POST['nombreUsuario'])) {
    $nombreUsuario = $_POST['nombreUsuario'];
    $response['existeUsuario'] = $usuario->existeNombreUsuario($nombreUsuario);
}

echo json_encode($response);
?>
