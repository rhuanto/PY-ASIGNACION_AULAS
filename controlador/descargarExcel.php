<?php
require_once '../modelos/Asignacion.php';
require_once '../vendor/autoload.php'; // Ajusta la ruta si es necesario

$escuelaId = isset($_GET['escuela']) ? $_GET['escuela'] : '';
$escuelaNombre = '';

// Determinar el nombre de la escuela basado en el valor recibido
if ($escuelaId == '1') {
    $escuelaNombre = 'EPIS';
} elseif ($escuelaId == '2') {
    $escuelaNombre = 'EPISW';
} else {
    $escuelaNombre = 'Todas las Escuelas'; // O algún valor por defecto
}

$asignacion = new Asignacion(); // Aquí no es necesario un namespace
$result = $asignacion->obtenerAsignacionesPorEscuela($escuelaId);

// Crear un nuevo Spreadsheet
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Asignaciones');

// Crear un array para almacenar las filas por día
$diasDeLaSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
$asignacionesPorDia = [];

// Inicializar el array
foreach ($diasDeLaSemana as $dia) {
    $asignacionesPorDia[$dia] = [];
}

// Clasificar las asignaciones por día
while ($asignacionData = $result->fetch_assoc()) {
    $dia = $asignacionData['Dia']; // Asegúrate de que la columna 'Dia' existe y tiene valores como 'Lunes', 'Martes', etc.
    if (isset($asignacionesPorDia[$dia])) {
        $asignacionesPorDia[$dia][] = $asignacionData;
    }
}

// Escribir las asignaciones por día en el Excel
$row = 1; // Inicia en la fila 1
foreach ($diasDeLaSemana as $dia) {
    if (!empty($asignacionesPorDia[$dia])) {
        // Agregar cabecera personalizada para cada día
        $sheet->setCellValue('A' . $row, 'UNIVERSIDAD NACIONAL MAYOR DE SAN MARCOS');
        $sheet->mergeCells("A$row:H$row");
        $sheet->getStyle("A$row:H$row")->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle("A$row:H$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $row++;

        $sheet->setCellValue('A' . $row, 'FACULTAD DE INGENIERÍA DE SISTEMAS E INFORMÁTICA - ASISTENCIA DE DOCENTES EN EL SEMESTRE 2024 - 1');
        $sheet->mergeCells("A$row:H$row");
        $sheet->getStyle("A$row:H$row")->getFont()->setBold(true)->setSize(10);
        $sheet->getStyle("A$row:H$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $row++;

        $sheet->setCellValue('A' . $row, $escuelaNombre); // Colocar el nombre de la escuela
        $sheet->mergeCells("A$row:H$row");
        $sheet->getStyle("A$row:H$row")->getFont()->setBold(true)->setSize(10);
        $sheet->getStyle("A$row:H$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $row++;

        $sheet->setCellValue('A' . $row, $dia . ' ….. DE………………...2023'); // Ajusta el formato de la fecha como desees
        $sheet->mergeCells("A$row:H$row");
        $sheet->getStyle("A$row:H$row")->getFont()->setBold(true)->setSize(10);
        $sheet->getStyle("A$row:H$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $row++;

        // Encabezados de las columnas después de la cabecera personalizada
        $headers = ['Nº', 'DOCENTE', 'CURSO', 'G', 'C', 'AULA', 'Horario Entrada', 'Hora i', 'FIRMA', 'Horario Salida', 'Hora s', 'FIRMA', 'Observación'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . $row, $header);
            $col++;
        }

        // Aplicar formato a los encabezados
        $sheet->getStyle("A$row:M$row")->getFont()->setBold(true);
        $sheet->getStyle("A$row:M$row")->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle("A$row:M$row")->getAlignment()->setWrapText(true); // Ajustar texto dentro de las celdas
        $sheet->getStyle("A$row:M$row")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $row++;

        // Escribir las asignaciones para ese día
        foreach ($asignacionesPorDia[$dia] as $index => $asignacionData) {
            $sheet->setCellValue('A' . $row, $index + 1); // Número correlativo
            $sheet->setCellValue('B' . $row, $asignacionData['Docente']);
            $sheet->setCellValue('C' . $row, $asignacionData['Curso']);
            $sheet->setCellValue('D' . $row, $asignacionData['Grupo']);
            $sheet->setCellValue('E' . $row, ''); // tipo
            $sheet->setCellValue('F' . $row, $asignacionData['Aula']);
            $sheet->setCellValue('G' . $row, $asignacionData['Hora_Inicio']);
            $sheet->setCellValue('H' . $row, ''); // Hora i
            $sheet->setCellValue('I' . $row, ''); // Firma 1
            $sheet->setCellValue('J' . $row, $asignacionData['Hora_Fin']);
            $sheet->setCellValue('K' . $row, ''); // Hora s
            $sheet->setCellValue('L' . $row, ''); // Firma 2
            $sheet->setCellValue('M' . $row, ''); // Observación
            
            // Ajustar tamaño de fuente para las columnas 'B' y 'C'
            $sheet->getStyle('B' . $row . ':C' . $row)->getFont()->setSize(8); // Por ejemplo, tamaño 8

            // Alinear el texto al centro para todas las columnas menos 'B' y 'C'
            $sheet->getStyle("A$row:A$row")->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle("D$row:M$row")->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            // Alinear el texto a la izquierda para las columnas 'B' y 'C'
            $sheet->getStyle("B$row:C$row")->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle("B$row:C$row")->getAlignment()->setWrapText(true);

            // Bordes para todas las columnas
            $sheet->getStyle("A$row:M$row")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $row++;
        }

        // Añadir una línea en blanco después de cada día para separación visual
        $row++;
    }
}

// Ajustar automáticamente el ancho de las columnas excepto 'B' y 'C'
foreach (range('A', 'M') as $col) {
    if ($col != 'B' && $col != 'C' && $col != 'D' && $col != 'E' && $col != 'F' && $col != 'G' && $col != 'H' && $col != 'I' && $col != 'J' && $col != 'K' && $col != 'L') {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }
}

// Ajustar el ancho de las columnas 'B' y 'C' manualmente
$sheet->getColumnDimension('B')->setWidth(20); // Ajusta el valor según lo necesites
$sheet->getColumnDimension('C')->setWidth(20);
$sheet->getColumnDimension('D')->setWidth(3.5);
$sheet->getColumnDimension('E')->setWidth(2.5);
$sheet->getColumnDimension('F')->setWidth(8);
$sheet->getColumnDimension('G')->setWidth(9);
$sheet->getColumnDimension('H')->setWidth(5.5);
$sheet->getColumnDimension('I')->setWidth(12);
$sheet->getColumnDimension('J')->setWidth(9);
$sheet->getColumnDimension('K')->setWidth(5.5);
$sheet->getColumnDimension('L')->setWidth(12);

// Guardar archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="asignaciones.xlsx"');
header('Cache-Control: max-age=0');

$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
