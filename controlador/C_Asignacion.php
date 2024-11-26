<?php
require_once '../modelos/Asignacion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_docente = $_POST['docente'];
    $id_curso = $_POST['curso'];
    $dia = $_POST['dia'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $grupo = $_POST['grupo'];
    $cantidad_alumnos = $_POST['cantidad_alumnos'];
    $escuelaId = isset($_POST['escuela']) ? $_POST['escuela'] : null;

    $asignacion = new Asignacion();
    $resultado = $asignacion->asignarAula($id_docente, $id_curso, $dia, $hora_inicio, $hora_fin, $grupo, $cantidad_alumnos, $escuelaId);

    if ($resultado) {
        // Redirigir con un mensaje indicando el aula asignada
        header("Location: ../Vista/V_V_Asignacion/asignaciones.php?success=Aula asignada con éxito: $resultado");
    } else {
        // Obtener mensaje de error específico
        $errorMessage = "No hay aulas disponibles para las condiciones seleccionadas.";
        header("Location: ../Vista/V_V_Asignacion/asignaciones.php?error=$errorMessage");
    }
}
?>
