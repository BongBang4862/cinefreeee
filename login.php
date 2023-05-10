
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

<!DOCTYPE html>
<html>
<head>
  <title>Login - CineFreeee</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Login</h1>
    <?php
    // Mostrar mensaje de error si existe
    if (isset($error)) {
      echo "<p class='error'>" . $error . "</p>";
    }
    ?>
    <form method="post">
      <label for="email">Correo electrónico:</label>
      <input type="email" name="email" required>

      <label for="contrasena">Contraseña:</label>
      <input type="password" name="contrasena" required>

      <button type="submit">Iniciar sesión</button>
    </form>
    <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a>.</p>
  </div>
</body>
</html>

