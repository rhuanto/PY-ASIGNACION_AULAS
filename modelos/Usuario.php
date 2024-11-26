<?php
require_once 'conexion.php';

class Usuario {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function autenticarUsuario($email, $password) {
        $query = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $usuario = $result->fetch_assoc();
            // Verificar la contraseña (asumiendo que está almacenada de manera segura con hash)
            return password_verify($password, $usuario['password']);
        }
        return false;
    }

    public function registrarUsuario($nombre, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $nombre, $email, $hashed_password);

        return $stmt->execute();
    }

    // Método para verificar si un correo ya existe en la base de datos
    public function existeEmail($email) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        //Verificar si se encontro algún resultado
        return $count > 0;
    }

    // Método para verificar si un usuario ya existe en la base de datos
    public function existeNombreUsuario($nombreUsuario) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM usuarios WHERE nombre = ?");
        $stmt->bind_param("s", $nombreUsuario);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        //Verificar si se encontro algún resultado
        return $count > 0;
    }
    
}
?>
