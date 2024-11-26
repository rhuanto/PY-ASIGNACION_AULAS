<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="RegistrarU.css">
</head>
<body>
    <div class="registro-form">
        <h2>Registro de Usuario</h2>
        <form action="../../controlador/C_RegistroUsuario.php" method="POST">
            <label for="nombreUsuario">Usuario:</label>
            <input type="text" id="nombreUsuario" name="nombreUsuario" required>
            <span class="nombreUsuario-error-msg"></span> <!-- Mensaje de error -->

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <span class="email-error-msg"></span> <!-- Mensaje de error -->

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" id="registerButton" disabled>Registrar</button>

            <button id="btnCancel" onclick="location.href='login.php'">Cancelar</button>
            
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            const registerButton = $("#registerButton");
            let emailValido = false;
            let usuarioValido = false;

            function actualizarEstadoBoton() {
                if (emailValido && usuarioValido) {
                    registerButton.prop("disabled", false).css("background-color", "#5cb85c");
                } else {
                    registerButton.prop("disabled", true).css("background-color", "#d6d8db");
                }
            }

            function verificarDisponibilidad(campo, valor, mensaje) {
                $.ajax({
                    url: "../../controlador/verificarUsuarioCorreo.php",
                    method: "POST",
                    data: { [campo]: valor },
                    dataType: "json",
                    success: function(response) {
                        const inputField = $(`#${campo}`);
                        $(`.${campo}-error-msg`).text('');

                        if ((campo === 'email' && response.existeCorreo) || (campo === 'nombreUsuario' && response.existeUsuario)) {
                            $(`.${campo}-error-msg`).text(mensaje);
                            inputField.css("background-color", "#f8d7da");
                            if (campo === 'email') emailValido = false;
                            if (campo === 'nombreUsuario') usuarioValido = false;
                        } else {
                            inputField.css("background-color", "#d4edda");
                            if (campo === 'email') emailValido = true;
                            if (campo === 'nombreUsuario') usuarioValido = true;
                        }
                        actualizarEstadoBoton();
                    },
                    error: function() {
                        console.error("Error en la solicitud AJAX.");
                    }
                });
            }

            $("#email").on("input", function() {
                const email = $(this).val();
                if (email === "") {
                    $(".email-error-msg").text('');
                    $(this).css("background-color", "");
                    emailValido = false;
                    actualizarEstadoBoton();
                    return;
                }
                verificarDisponibilidad('email', email, "El correo ya está registrado");
            });

            $("#nombreUsuario").on("input", function() {
                const nombreUsuario = $(this).val();
                if (nombreUsuario === "") {
                    $(".nombreUsuario-error-msg").text('');
                    $(this).css("background-color", "");
                    usuarioValido = false;
                    actualizarEstadoBoton();
                    return;
                }
                verificarDisponibilidad('nombreUsuario', nombreUsuario, "El nombre de usuario ya está registrado");
            });
        });
    </script>
</body>
</html>
