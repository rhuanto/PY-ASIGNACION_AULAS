<?php
require_once '../modelos/Asignacion.php';

if (isset($_GET['escuela'])) {
    $escuelaId = $_GET['escuela'];
    $asignacion = new Asignacion();

    $asignaciones = $asignacion->obtenerAsignacionesPorEscuela($escuelaId);
    $diasAsignaciones = [];

    $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

    while ($row = $asignaciones->fetch_assoc()) {
        $dia = $row['Dia'];
        if (!isset($diasAsignaciones[$dia])) {
            $diasAsignaciones[$dia] = [];
        }
        $diasAsignaciones[$dia][] = [
            'docente' => $row['Docente'],
            'curso' => $row['Curso'],
            'grupo' => $row['Grupo'],
            'aula' => $row['Aula'],
            'hora_inicio' => $row['Hora_Inicio'],
            'hora_fin' => $row['Hora_Fin'],
        ];
    }

    $diasAsignacionesOrdenadas = [];
    foreach ($diasSemana as $dia) {
        if (isset($diasAsignaciones[$dia])) {
            $diasAsignacionesOrdenadas[$dia] = $diasAsignaciones[$dia];
        }
    }

    header('Content-Type: application/json');
    echo json_encode($diasAsignacionesOrdenadas);
}
?>
