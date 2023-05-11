<?php
require_once 'conexion.php';
require_once 'pelicula.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperamos los datos enviados por el formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $duracion = $_POST['duracion'];
    $director = $_POST['director'];
    $clasificacion = $_POST['clasificacion'];
    $estreno = $_POST['estreno'];
    $imagen = $_POST['imagen'];
    $trailer = $_POST['trailer'];
    $id_api = $_POST['id_api'];
    echo $id_api;

    // Creamos una instancia de la clase Pelicula
    $pelicula = new Pelicula();
    $res =$pelicula->buscarPeliculaPorIdApi($id_api);
    if ($res) {
        // La película ya existe, guardar mensaje en variable de sesión
        session_start();
        $_SESSION['mensaje'] = 'La película ya existe en la base de datos.';
        header('Location: ../busqueda.php');
    } else {
        // La película no existe, agregarla a la base de datos
        $guardado = $pelicula->agregarPelicula($titulo, $descripcion, $duracion, $director, $clasificacion, $estreno, $imagen, $trailer, $id_api);
        if ($guardado) {
            session_start();
            $_SESSION['mensaje'] = 'La película ha sido guardada correctamente.';
            header('Location: ../busqueda.php');
        } else {
            echo 'Ha ocurrido un error al guardar la película.';
        }
    }
    

    
}
?>
