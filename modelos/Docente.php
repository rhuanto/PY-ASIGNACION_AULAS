<?php
require_once 'conexion.php';

class Docente {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function registrarDocente($nombre) {
        try {
            $query = "CALL SP_RegistrarDocente(?)";
            $stmt = $this->conn->prepare($query);
            if ($stmt === false) {
                throw new Exception("Error al preparar la consulta: " . $this->conn->error);
            }

            $stmt->bind_param("s", $nombre);

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
            }
        } catch (Exception $e) {
            // Manejo de errores: puedes registrar el error en un archivo de log o mostrarlo
            echo "Error al registrar docente: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerDocentes() {
        try {
            $query = "SELECT * FROM docentes";
            $result = $this->conn->query($query);

            if ($result === false) {
                throw new Exception("Error al ejecutar la consulta: " . $this->conn->error);
            }

            return $result;
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al obtener docentes: " . $e->getMessage();
            return false;
        }
    }

    public function existeDocente($nombre) {
        try {
            $query = "SELECT id_Docente FROM docentes WHERE Nombre = ?";
            $stmt = $this->conn->prepare($query);
            if ($stmt === false) {
                throw new Exception("Error al preparar la consulta: " . $this->conn->error);
            }

            $stmt->bind_param("s", $nombre);
            $stmt->execute();
            $stmt->store_result();

            return $stmt->num_rows > 0;
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al verificar existencia del docente: " . $e->getMessage();
            return false;
        }
    }
}
?>
