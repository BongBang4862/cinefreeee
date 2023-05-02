<?php


class Administrador {
    private $conn;

    public function __construct() {
        $database = new Conexion();
        $this->conn = $database->getConnection();
    }

    public function existeEmail($email) {
        $stmt = $this->conn->prepare("SELECT id FROM administradores WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    public function registrar($nombre, $apellido, $email, $contrasena) {
        // Verificar si el email ya existe
        if ($this->existeEmail($email)) {
            return false;
        }
        // Si no existe, realizar el registro
        $stmt = $this->conn->prepare("INSERT INTO administradores (nombre, apellido, email, contrasena) VALUES (?, ?, ?, ?)");
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $stmt->bind_param("ssss", $nombre, $apellido, $email, $hash);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function obtenerAdministrador($email,$contrasena) {
        $stmt = $this->conn->prepare("SELECT * FROM administradores WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        var_dump($email);
        
        $stmt->close();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            var_dump($row);
            // Comparamos el hash de la contraseña recibida con el hash guardado en la base de datos
            if (password_verify($contrasena, $row['contrasena'])) {
                return $row;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }


    // otros métodos de la clase
}
