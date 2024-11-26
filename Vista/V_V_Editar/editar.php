<?php
include '../../controlador/auth.php'; // Incluye auth.php
verificarAutenticacion(); // Llama a la función para verificar la autenticación
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Asignaciones</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
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
    <h1>Editar Asignaciones</h1>
    <div class="main-container">
        <label for="asignacion-select">Seleccionar Asignación:</label>
        <select id="asignacion-select" class="form-control">
            <option value="">Seleccione una asignación</option>
        </select>

        <form id="form-editar">
            <label for="docente">Docente:</label>
            <input type="text" id="docente" name="docente" readonly>

            <label for="curso">Curso:</label>
            <input type="text" id="curso" name="curso" readonly>

            <label for="dia">Día:</label>
            <select id="dia" name="dia" required>
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miércoles">Miércoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sábado">Sábado</option>
            </select>

            <label for="hora_inicio">Hora Inicio:</label>
            <input type="time" id="hora_inicio" name="hora_inicio" required>

            <label for="hora_fin">Hora Fin:</label>
            <input type="time" id="hora_fin" name="hora_fin" required>

            <label for="grupo">Grupo:</label>
            <input type="text" id="grupo" name="grupo" min="0" required>

            <label for="ciclo">Ciclo:</label>
            <input type="number" id="ciclo" name="ciclo" min="0" required>

            <label for="cantidad_alumnos">Cantidad de Alumnos:</label>
            <input type="number" id="cantidad_alumnos" name="cantidad_alumnos" min="0" required>

            <button type="button" id="guardar-btn">Guardar</button>
            <button type="button" id="eliminar-btn">Eliminar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <script src="editar_asignaciones.js"></script>
</body>
</html>
