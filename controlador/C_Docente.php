<?php
require_once '../modelos/Docente.php';
require_once '../vendor/autoload.php'; // Asegúrate de tener PhpSpreadsheet instalado

use PhpOffice\PhpSpreadsheet\IOFactory;

// Verifica si se ha enviado el formulario de registro manual
if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
    $nombreDocente = $_POST['nombre'];

    // Crear una instancia de la clase Docente
    $docente = new Docente();

    // Registrar el docente manualmente solo si no está duplicado
    if (!$docente->existeDocente($nombreDocente)) {
        if ($docente->registrarDocente($nombreDocente)) {
            echo "Docente registrado correctamente.";

            // Redirigir después del registro manual
            header("Location: ../Vista/V_V_Docentes/docente.php");
            exit(); // Asegúrate de detener la ejecución aquí
        } else {
            echo "Error al registrar el docente.";
        }
    } else {
        echo "El docente ya existe.";
    }
}

// Verifica si se ha subido un archivo Excel antes de procesarlo
if (isset($_FILES['docente_excel']) && $_FILES['docente_excel']['error'] === 0) {
    $file = $_FILES['docente_excel']['tmp_name'];

    // Verifica el tipo de archivo
    $fileType = $_FILES['docente_excel']['type'];
    if ($fileType === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || 
        $fileType === 'application/vnd.ms-excel') { // Agrega compatibilidad para .xls si es necesario

        try {
            $spreadsheet = IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();

            // Obtiene el número total de filas
            $highestRow = $worksheet->getHighestRow();

            // Crea una instancia de la clase Docente
            $docente = new Docente();

            for ($row = 1; $row <= $highestRow; $row++) {
                // Obtiene el valor de la primera columna (asumimos que la columna A tiene los nombres de los docentes)
                $nombre = $worksheet->getCell('A' . $row)->getValue();

                if ($nombre) {
                    // Registrar el docente solo si no está duplicado
                    if (!$docente->existeDocente($nombre)) {
                        $docente->registrarDocente($nombre);
                    }
                }
            }

            // Redirige a la página después de completar el proceso de Excel
            header("Location: ../Vista/V_V_Docentes/docente.php");
            exit(); // Asegúrate de detener la ejecución aquí

        } catch (Exception $e) {
            echo "Error al procesar el archivo: " . $e->getMessage() . "<br>";
        }
    } else {
        echo "Error: El archivo debe ser un archivo Excel (.xlsx o .xls).<br>";
    }
} else {
    // Si no se subió un archivo Excel, no hagas nada
    echo "No se subió ningún archivo Excel.<br>";
}
