<?php
require_once '../modelos/Docente.php';
require_once '../vendor/autoload.php'; // Usando PhpSpreadsheet con Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $docente = new Docente();

    // Procesar el archivo Excel
    if (isset($_POST['subir_excel'])) {
        $file = $_FILES['docente_excel']['tmp_name'];
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        
        // Encontrar la columna que contiene los nombres de los docentes
        $columnIndex = null;
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            // Asumiendo que los encabezados están en la primera fila
            if ($row->getRowIndex() == 1) {
                foreach ($cellIterator as $cell) {
                    if (trim($cell->getValue()) == 'Docente') {
                        $columnIndex = $cell->getColumn();
                        break;
                    }
                }
                continue; // Saltar la fila de encabezado
            }

            if ($columnIndex) {
                $nombre = $worksheet->getCell($columnIndex . $row->getRowIndex())->getValue();
                if ($nombre && !$docente->existeDocente($nombre)) {
                    $docente->registrarDocente($nombre);
                }
            }
        }

        header("Location: ../Vista/V_V_Docentes/docente.php");
    }

    // Procesar el formulario
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];

        if ($docente->registrarDocente($nombre)) {
            header("Location: ../Vista/V_V_Docentes/docente.php");
        } else {
            echo "Error al registrar el docente";
        }
    }
}
?>
