<?php
require_once '../modelos/editar_asignacion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $data['id'];
    $docente = $data['docente'];
    $curso = $data['curso'];
    $dia = $data['dia'];
    $hora_inicio = $data['hora_inicio'];
    $hora_fin = $data['hora_fin'];
    $grupo = $data['grupo'];
    $ciclo = $data['ciclo'];
    $cantidad_alumnos = $data['cantidad_alumnos'];

    $asignacion = new Asignacion();
    $result = $asignacion->actualizarAsignacion($id, $docente, $curso, $dia, $hora_inicio, $hora_fin, $grupo, $ciclo, $cantidad_alumnos);

    if (strpos($result, "actualizó") !== false || strpos($result, "reasignó") !== false) {
        echo json_encode(['success' => true, 'message' => $result]);
    } else {
        echo json_encode(['success' => false, 'message' => $result]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>
