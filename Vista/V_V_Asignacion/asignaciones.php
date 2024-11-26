<?php
include '../../controlador/auth.php'; // Incluye auth.php
verificarAutenticacion(); // Verifica la autenticación
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación de Aulas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Archivo de estilos personalizado -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
                <a class="nav-link" href="../../logout.php">Cerrar Sesión</a>
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

<div class="container mt-4">
    <!-- Mensajes dinámicos -->
    <?php
    if (isset($_GET['success'])) {
        echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['success']) . "</div>";
    }
    if (isset($_GET['error'])) {
        echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['error']) . "</div>";
    }
    ?>

    <h1>Asignación de Aulas</h1>
    <div class="assignment-container">
        <form action="../../controlador/C_Asignacion.php" method="post">
            <label for="docente">Docente:</label>
            <select id="docente" name="docente" required>
                <?php
                require_once '../../modelos/Docente.php';
                $docenteModel = new Docente();
                $docentes = $docenteModel->obtenerDocentes();
                while ($row = $docentes->fetch_assoc()): ?>
                    <option value="<?php echo $row['Id_Docente']; ?>"><?php echo $row['Nombre']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="curso">Curso:</label>
            <select id="curso" name="curso" required>
                <?php
                require_once '../../modelos/Curso.php';
                $cursoModel = new Curso();
                $cursos = $cursoModel->obtenerCursos();
                while ($row = $cursos->fetch_assoc()): ?>
                    <option value="<?php echo $row['Id_Curso']; ?>"><?php echo $row['Nombre']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="grupo">Grupo:</label>
            <input type="text" id="grupo" name="grupo" required>

            <label for="dia">Día:</label>
            <select id="dia" name="dia" required>
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miércoles">Miércoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sábado">Sábado</option>
            </select>

            <label for="hora_inicio">Hora de Inicio:</label>
            <input type="time" id="hora_inicio" name="hora_inicio" required>

            <label for="hora_fin">Hora de Fin:</label>
            <input type="time" id="hora_fin" name="hora_fin" required>

            <label for="cantidad_alumnos">Cantidad de Alumnos:</label>
            <input type="number" id="cantidad_alumnos" name="cantidad_alumnos" min="0" required>

            <button type="submit" class="btn btn-primary mt-3">Asignar Aula</button>
        </form>
    </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#docente').select2();
        $('#curso').select2();
    });
</script>
</body>
</html>
