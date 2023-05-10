<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Incluir la clase de conexión y la clase de usuario
  require_once "php/conexion.php";
  require_once "php/administrador.php";
  
  // Obtener los datos enviados por el formulario
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $email = $_POST["email"];
  $contrasena = $_POST["contrasena"];
  
  // Crear una instancia de la clase Usuario y establecer los valores de sus propiedades
  $admnistrador = new Administrador;
  
  // Verificar si el correo electrónico ya existe en la base de datos
  if ($admnistrador->existeEmail($email)) {
    // Si el correo electrónico ya existe, mostrar un mensaje de error
    echo "<p>El correo electrónico ingresado ya está registrado. Por favor, ingrese un correo electrónico diferente.</p>";
  } else {
    // Si el correo electrónico no existe, registrar al usuario en la base de datos
    if ($admnistrador->registrar($nombre, $apellido, $email, $contrasena)) {
      // Si el registro es exitoso, redirigir al usuario a la página de inicio de sesión
      header("Location: login.php");
      exit;
    } else {
      // Si el registro falla, mostrar un mensaje de error
      echo "<p>Ocurrió un error al registrar al usuario. Por favor, intente nuevamente.</p>";
    }
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
    <link rel="stylesheet" href="css/registro.css">
  </head>
  <body>
    <h1>Registro de usuario</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" required><br><br>
      
      <label for="apellido">Apellido:</label>
      <input type="text" id="apellido" name="apellido" required><br><br>
      
      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" required><br><br>
      
      <label for="contrasena">Contraseña:</label>
      <input type="password" id="contrasena" name="contrasena" required><br><br>
      
      <input type="submit" value="Registrar">
    </form>
    <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a>.</p>
  </body>
</html>
