<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404</title>
    <link rel="stylesheet" href="styles.css"> <!-- Incluye tus estilos -->
    <style>
        body {
            display: flex;
            justify-content: center; /* Centra horizontalmente */
            align-items: center; /* Centra verticalmente */
            height: 100vh; /* Altura completa de la ventana */
            margin: 0;
            font-family: Arial, sans-serif; /* Fuente de tu elección */
            background-color: #f2f2f2; /* Color de fondo */
        }
        .error-container {
            text-align: center; /* Centra el texto dentro del contenedor */
            background-color: white; /* Fondo blanco para el contenedor */
            padding: 20px;
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra para el contenedor */
        }
        h1 {
            font-size: 60px; /* Tamaño del encabezado */
            margin: 0;
            color: #ff0000; /* Color rojo para el mensaje de error */
        }
        p {
            font-size: 24px; /* Tamaño del párrafo */
            color: #333; /* Color del texto */
        }
        a {
            display: inline-block;
            margin-top: 20px; /* Espacio entre el mensaje y el enlace */
            font-size: 20px; /* Tamaño del enlace */
            color: #007bff; /* Color del enlace */
            text-decoration: none; /* Quitar subrayado */
        }
        a:hover {
            text-decoration: underline; /* Subrayar al pasar el ratón */
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>404</h1>
        <p>Ops!, tenemos un problema.</p>
        <a href="http://localhost/SISTEMA%20RESERVA%20AULAS_/Vista/V_V_Login/login.php">Regresar al inicio de sesión</a>
    </div>
</body>
</html>
