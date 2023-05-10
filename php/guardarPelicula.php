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

    // Creamos una instancia de la clase Pelicula
    $pelicula = new Pelicula();

    // Guardamos la película en la base de datos
    $guardado = $pelicula->agregarPelicula($titulo, $descripcion, $duracion, $director, $clasificacion, $estreno, $imagen, $trailer);

    if ($guardado) {
        echo 'La película ha sido guardada correctamente.';
    } else {
        echo 'Ha ocurrido un error al guardar la película.';
    }
}
?>
