
<?php include ('php/login.php') ?>

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

