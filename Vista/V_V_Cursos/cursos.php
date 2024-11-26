<?php
include '../../controlador/auth.php'; // Incluye auth.php
verificarAutenticacion(); // Llama a la función para verificar la autenticación
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Curso</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../V_V_Principal/index.html">Nombre de la Tesis</a>
        <btn class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </btn>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../V_V_Docentes/docente.php">Datos del Docente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../V_V_Cursos/cursos.php">Datos del Curso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../V_V_Firmas/firmas.html">Firmas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../logout.php">Cerrar Sesión</a> <!-- Enlace para cerrar sesión -->
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Asignación
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../V_V_Asignacion/asignaciones.php">Asignación de Aulas</a>
                        <a class="dropdown-item" href="../V_V_Editar/editar.php">Actualizar y Editar</a>
                        <a class="dropdown-item" href="../V_V_Excel/excel.php">Vista Asignación</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <h1>Registrar Curso</h1>
    <div class="course-container">
        <form action="../../controlador/C_Curso.php" method="post">
            <label for="nombre">Nombre del Curso:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="ciclo">Ciclo:</label>
            <input type="number" id="ciclo" name="ciclo" min="1" max= "10" required>
            
            <label for="escuela">Escuela:</label>
            <select id="escuela" name="escuela" required>
                <?php
                require_once '../../modelos/Curso.php';
                $curso = new Curso();
                $escuelas = $curso->obtenerEscuelas();
                while ($row = $escuelas->fetch_assoc()): ?>
                    <option value="<?php echo $row['Id_Escuela']; ?>"><?php echo $row['Nombre']; ?></option>
                <?php endwhile; ?>
            </select>
            
            <button type="submit">Registrar</button>
        </form>
        
        <form action="../../controlador/C_Curso.php" method="post" enctype="multipart/form-data">
    <label for="archivo">Subir archivo Excel:</label>
    <input type="file" id="archivo" name="archivo" accept=".xlsx" required>
    
    <label for="escuela">Escuela:</label>
    <select id="escuela" name="escuela" required>
        <?php
        require_once '../../modelos/Curso.php';
        $curso = new Curso();
        $escuelas = $curso->obtenerEscuelas();
        while ($row = $escuelas->fetch_assoc()): ?>
            <option value="<?php echo $row['Id_Escuela']; ?>"><?php echo $row['Nombre']; ?></option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Registrar Cursos</button>
</form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
