<?php 
    class Pelicula {
        private $conn;

        public function __construct() {
            $database = new Conexion();
            $this->conn = $database->getConnection();
        }

        public function agregarPelicula($titulo, $descripcion, $duracion, $director, $clasificacion, $estreno, $imagen, $trailer, $id_api) {
            $stmt = $this->conn->prepare("INSERT INTO peliculas (titulo, descripcion,duracion, director, clasificacion,estreno,imagen,trailer,id_api) VALUES (?, ?, ?, ?,?, ?, ?,?,?)");
            $stmt->bind_param("ssisssssi", $titulo, $descripcion, $duracion, $director, $clasificacion, $estreno, $imagen, $trailer, $id_api);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }

        public function buscarPeliculaPorIdApi($id_api) {
            $stmt = $this->conn->prepare("SELECT * FROM peliculas WHERE id_api = ?");
            $stmt->bind_param("s", $id_api);
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