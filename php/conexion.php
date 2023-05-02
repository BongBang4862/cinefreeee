<?php
// Clase de conexión a la base de datos
class Conexion {
  private $host;
  private $user;
  private $password;
  private $database;
  private $conn;

  public function __construct() {
    $this->host = "localhost";
    $this->user = "root";
    $this->password = "";
    $this->database = "cinefreeee";
    $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);

    if ($this->conn->connect_error) {
      die("Error de conexión: " . $this->conn->connect_error);
    }
  }

  public function getConnection() {
    return $this->conn;
  }
}


?>
