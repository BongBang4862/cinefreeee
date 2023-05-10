<?php 
    class Pelicula {
        private $conn;

        public function __construct() {
            $database = new Conexion();
            $this->conn = $database->getConnection();
        }

        public function agregarPelicula($titulo, $descripcion, $duracion, $director, $clasificacion, $estreno, $imagen, $trailer) {
            $stmt = $this->conn->prepare("INSERT INTO peliculas (titulo, descripcion,duracion, director, clasificacion,estreno,imagen,trailer) VALUES (?, ?, ?, ?,?, ?, ?)");
            $stmt->bind_param("ssisssss", $titulo, $descripcion, $duracion, $director, $clasificacion, $estreno, $imagen, $trailer);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }

        public function buscarPeliculaPorNombre($nombre) {
            $stmt = $this->conn->prepare("SELECT * FROM peliculas WHERE nombre = ?");
            $stmt->bind_param("s", $nombre);
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                return null;
            }
        }

        // otros métodos de la clase
    }

 ?>