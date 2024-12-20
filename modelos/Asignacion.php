<?php
require_once 'conexion.php';

class Asignacion {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function asignarAula($id_docente, $id_curso, $dia, $hora_inicio, $hora_fin, $grupo, $cantidad_alumnos, $escuelaId = null) {
        $aula = $this->obtenerAulaDisponible($cantidad_alumnos, $dia, $hora_inicio, $hora_fin);
        
        if ($aula) {
            $id_aula = $aula['Id_Aula'];
            $nombre_aula = $aula['Nombre'];
            
            $query = "CALL SP_AsignarAula(?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("iiissssi", $id_docente, $id_curso, $id_aula, $dia, $hora_inicio, $hora_fin, $grupo, $cantidad_alumnos);

            if ($stmt->execute()) {
                // Registrar la acción en auditoría
                $this->registrarAccion("Aula asignada: $nombre_aula para el curso $id_curso.");
                return $nombre_aula; // Devolver el nombre del aula asignada
            } else {
                return false; // Error en la ejecución
            }
        } else {
            return false; // No hay aulas disponibles
        }
    }

    public function obtenerAulaDisponible($cantidad_alumnos, $dia, $hora_inicio, $hora_fin) {
        // Intentar encontrar un aula con capacidad exacta
        $query_exact = "SELECT a.Id_Aula, a.Nombre 
                        FROM aulas a
                        LEFT JOIN asignaciones asig ON a.Id_Aula = asig.Id_Aula AND asig.Dia = ? AND (
                            (asig.Hora_Inicio < ? AND asig.Hora_Fin > ?) OR
                            (asig.Hora_Inicio < ? AND asig.Hora_Fin > ?) OR
                            (asig.Hora_Inicio >= ? AND asig.Hora_Fin <= ?)
                        )
                        WHERE a.Capacidad = ? AND asig.Id_Aula IS NULL
                        LIMIT 1";
        $stmt_exact = $this->conn->prepare($query_exact);
        $stmt_exact->bind_param("sssssssi", $dia, $hora_fin, $hora_inicio, $hora_inicio, $hora_inicio, $hora_inicio, $hora_fin, $cantidad_alumnos);
        $stmt_exact->execute();
        $result_exact = $stmt_exact->get_result();
        $aula_exact = $result_exact->fetch_assoc();

        if ($aula_exact) {
            return $aula_exact;
        }

        // Intentar encontrar un aula con capacidad cercana dentro de un margen de 6 alumnos
        $query_close = "SELECT a.Id_Aula, a.Nombre 
                        FROM aulas a
                        LEFT JOIN asignaciones asig ON a.Id_Aula = asig.Id_Aula AND asig.Dia = ? AND (
                            (asig.Hora_Inicio < ? AND asig.Hora_Fin > ?) OR
                            (asig.Hora_Inicio < ? AND asig.Hora_Fin > ?) OR
                            (asig.Hora_Inicio >= ? AND asig.Hora_Fin <= ?)
                        )
                        WHERE a.Capacidad >= ? AND a.Capacidad <= ? AND asig.Id_Aula IS NULL
                        ORDER BY a.Capacidad ASC
                        LIMIT 1";
        $stmt_close = $this->conn->prepare($query_close);
        $min_capacity = $cantidad_alumnos;
        $max_capacity = $cantidad_alumnos + 6;
        $stmt_close->bind_param("ssssssiii", $dia, $hora_fin, $hora_inicio, $hora_inicio, $hora_inicio, $hora_inicio, $hora_fin, $min_capacity, $max_capacity);
        $stmt_close->execute();
        $result_close = $stmt_close->get_result();
        $aula_close = $result_close->fetch_assoc();

        if ($aula_close) {
            return $aula_close;
        }

        // Si no hay aulas disponibles dentro del margen de 6 alumnos, asignar cualquier aula disponible con suficiente capacidad
        $query_any = "SELECT a.Id_Aula, a.Nombre 
                      FROM aulas a
                      LEFT JOIN asignaciones asig ON a.Id_Aula = asig.Id_Aula AND asig.Dia = ? AND (
                          (asig.Hora_Inicio < ? AND asig.Hora_Fin > ?) OR
                          (asig.Hora_Inicio < ? AND asig.Hora_Fin > ?) OR
                          (asig.Hora_Inicio >= ? AND asig.Hora_Fin <= ?)
                      )
                      WHERE a.Capacidad >= ? AND asig.Id_Aula IS NULL
                      ORDER BY a.Capacidad ASC
                      LIMIT 1";
        $stmt_any = $this->conn->prepare($query_any);
        $stmt_any->bind_param("sssssssi", $dia, $hora_fin, $hora_inicio, $hora_inicio, $hora_inicio, $hora_inicio, $hora_fin, $cantidad_alumnos);
        $stmt_any->execute();
        $result_any = $stmt_any->get_result();
        $aula_any = $result_any->fetch_assoc();

        return $aula_any ? $aula_any : null;
    }

    public function obtenerAsignacionesPorEscuela($escuelaId) {
        if ($escuelaId == '') {
            $query = "SELECT asignaciones.*, docentes.Nombre AS Docente, cursos.Nombre AS Curso, aulas.Nombre AS Aula, cursos.Ciclo, asignaciones.Cantidad_Alumnos 
                      FROM asignaciones 
                      JOIN docentes ON asignaciones.Id_Docente = docentes.Id_Docente 
                      JOIN cursos ON asignaciones.Id_Curso = cursos.Id_Curso 
                      JOIN aulas ON asignaciones.Id_Aula = aulas.Id_Aula";
        } else {
            $query = "SELECT asignaciones.*, docentes.Nombre AS Docente, cursos.Nombre AS Curso, aulas.Nombre AS Aula, cursos.Ciclo, asignaciones.Cantidad_Alumnos 
                      FROM asignaciones 
                      JOIN docentes ON asignaciones.Id_Docente = docentes.Id_Docente 
                      JOIN cursos ON asignaciones.Id_Curso = cursos.Id_Curso 
                      JOIN aulas ON asignaciones.Id_Aula = aulas.Id_Aula
                      WHERE cursos.Id_Escuela = ? OR (cursos.Ciclo = 1 AND cursos.Id_Escuela IN (1, 2))";
        }

        $stmt = $this->conn->prepare($query);
        if ($escuelaId != '') {
            $stmt->bind_param("i", $escuelaId);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function registrarAccion($mensaje) {
        $query = "INSERT INTO auditoria (accion, fecha) VALUES (?, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $mensaje);
        $stmt->execute();
    }
}
?>
