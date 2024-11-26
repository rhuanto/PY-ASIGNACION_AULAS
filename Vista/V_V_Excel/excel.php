<?php
include '../../controlador/auth.php'; // Incluye auth.php
verificarAutenticacion(); // Llama a la función para verificar la autenticación
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Asignación</title>
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
    <h1>Vista de Asignaciones</h1>
    <div class="table-container">
        <?php
        require_once '../../modelos/AsignacionExcel.php';
        $asignacionModel = new AsignacionVista();
        $asignaciones = $asignacionModel->obtenerAsignacionesPorAula();

        $horas = ["08:00-09:00", "09:00-10:00", "10:00-11:00", "11:00-12:00", "12:00-13:00", "13:00-14:00", "14:00-15:00", "15:00-16:00", "16:00-17:00", "17:00-18:00", "18:00-19:00", "19:00-20:00", "20:00-21:00", "21:00-22:00"];
        $dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
        $ocupadas = [];

        foreach ($asignaciones as $aula => $data) {
            echo "<h2>Aula: $aula</h2>";
            echo "<table class='asignaciones-table'>";
            echo "<thead><tr><th>Hora</th>";
            foreach ($dias as $dia) {
                echo "<th>$dia</th>";
            }
            echo "</tr></thead><tbody>";

            foreach ($horas as $hora) {
                list($hora_inicio, $hora_fin) = explode("-", $hora);
                echo "<tr><td>$hora_inicio-$hora_fin</td>";

                foreach ($dias as $dia) {
                    if (isset($ocupadas[$aula][$dia][$hora_inicio])) {
                        continue;
                    }
                    $celda_vacia = true;

                    if (isset($data[$dia])) {
                        foreach ($data[$dia] as $asignacion) {
                            if ($asignacion['hora_inicio'] == $hora_inicio) {
                                $hora_inicio_asignacion = strtotime($asignacion['hora_inicio']);
                                $hora_fin_asignacion = strtotime($asignacion['hora_fin']);
                                $duracion_horas = ($hora_fin_asignacion - $hora_inicio_asignacion) / 3600;
                                $rowspan = ceil($duracion_horas);
                                $color = ($asignacion['escuela'] == 'EPIS') ? 'background-color: #d9ead3;' : 'background-color: #c9daf8;';
                                echo "<td style='$color' rowspan='$rowspan'>{$asignacion['detalle']}</td>";

                                for ($i = 0; $i < $rowspan; $i++) {
                                    $hora_ocupada = date("H:i", strtotime("+$i hour", $hora_inicio_asignacion));
                                    $ocupadas[$aula][$dia][$hora_ocupada] = true;
                                }
                                
                                $celda_vacia = false;
                                break;
                            }
                        }
                    }

                    if ($celda_vacia) {
                        echo "<td></td>";
                    }
                }
                echo "</tr>";
            }

            echo "</tbody></table>";
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
