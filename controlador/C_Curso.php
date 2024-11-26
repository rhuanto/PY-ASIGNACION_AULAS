<?php
require_once '../modelos/Curso.php';
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curso = new Curso();

    // Verificar si se subió un archivo o si los datos son manuales
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
        // Procesar archivo Excel
        $nombreArchivo = $_FILES['archivo']['tmp_name'];

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($nombreArchivo);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow(); // Número de filas con datos

        $cursoActual = '';
        $cicloActual = '';

        for ($row = 1; $row <= $highestRow; $row++) {
            $cellValue = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

            if (stripos($cellValue, 'CICLO') !== false) {
                // Detectar el ciclo
                $cicloActual = trim($cellValue);
            } elseif (stripos($cellValue, '(2023)') !== false || stripos($cellValue, '(2018)') !== false) {
                // Detectar el curso
                $cursoActual = trim($worksheet->getCellByColumnAndRow(1, $row)->getValue());
            }

            // Si tenemos tanto el nombre del curso como el ciclo, lo registramos
            if (!empty($cursoActual) && !empty($cicloActual)) {
                $id_escuela = $_POST['escuela']; // Escuela seleccionada manualmente
                $curso->registrarCurso($cursoActual, $cicloActual, $id_escuela);

                // Limpiar las variables después de registrar
                $cursoActual = '';
            }
        }
        header("Location: ../Vista/V_V_Cursos/cursos.php");
    } else {
        // Registro manual
        $nombre = $_POST['nombre'];
        $ciclo = $_POST['ciclo'];
        $id_escuela = $_POST['escuela'];

        if ($curso->registrarCurso($nombre, $ciclo, $id_escuela)) {
            header("Location: ../Vista/V_V_Cursos/cursos.php");
        } else {
            echo "Error al registrar el curso";
        }
    }
}
?>
