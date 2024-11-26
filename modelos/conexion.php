<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "trabajo";
    private $port = 3307; // Agregar el puerto

    private $connection;

    public function connect() {
        if ($this->connection == null) {
            $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->dbname, $this->port);

            if ($this->connection->connect_error) {
                die("Conexión fallida: " . $this->connection->connect_error);
            }
        }
        
        return $this->connection;
    }
}
?>
