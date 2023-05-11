<?php
    // Verificar que el formulario fue enviado con método POST
require_once "php/conexion.php";
require_once "php/administrador.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    try {
        // Crear objeto de la clase Administrador
        $admin = new Administrador();
        // Obtener administrador
        $administrador = $admin->obtenerAdministrador($email, $contrasena);

        if($administrador) {
            // Iniciar sesión y redireccionar al repositorio de películas
            $_SESSION['administrador'] = $administrador;
            header('Location: busqueda.php');
        } else {
            $error = "Email o contraseña incorrectos";
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>