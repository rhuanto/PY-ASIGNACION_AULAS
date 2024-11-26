<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Asignación de Aulas</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../../img/logo-fisi.png" alt="Logo de FISI" class="logo-FISI-IZQ">
        </div>
        <div class="logo">
            <img src="../../img/logo-unmsm.png" alt="Logo de UNMSM" class="logo-UNMSM-DER">
        </div>
    </header>
    
    <main>
        <div class="background">
            <div class="container">
                <div class="form-container">
                    <h1>Iniciar Sesión</h1>
                    <form action="../../controlador/C_Login.php" method="POST">
                        <div class="form-group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Recordar contraseña</label>
                        </div>

                        <button type="submit">Ingresar</button>
                    </form>
                    
                    <?php if (isset($_GET['error'])): ?>
                        <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
                    <?php endif; ?>
                    
                    <p>¿No tienes cuenta? <a href="RegistrarU.php">Crear una</a></p>
                    <hr>    
                    <p>¿Olvidaste tu contraseña? <a href="recuperar_contraseña.php">Recupérala aquí</a></p>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Empresa. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
