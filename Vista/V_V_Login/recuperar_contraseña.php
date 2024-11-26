<!-- recuperar_contraseña.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <main>
        <div class="background">
            <div class="container">
                <div class="form-container">
                    <h1>Recuperar Contraseña</h1>
                    <form action="C_RecuperarContraseña.php" method="POST"> <!-- Ruta ajustada -->
                        <div class="form-group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>
                        </div>
                        <button type="submit">Enviar enlace de recuperación</button>
                    </form>
                    
                    <?php if (isset($_GET['mensaje'])): ?>
                        <p class="mensaje"><?php echo htmlspecialchars($_GET['mensaje']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
