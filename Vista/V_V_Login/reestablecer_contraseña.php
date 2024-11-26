<!-- reestablecer_contraseña.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <main>
        <div class="background">
            <div class="container">
                <div class="form-container">
                    <h1>Restablecer Contraseña</h1>
                    <form action="C_ReestablecerContraseña.php" method="POST"> <!-- Ruta ajustada -->
                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                        <div class="form-group">
                            <label for="password">Nueva Contraseña:</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <button type="submit">Restablecer Contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
