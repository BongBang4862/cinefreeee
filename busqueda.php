<!DOCTYPE html>
<html>
<head>
	<title>Ejemplo de grid en HTML</title>
	<style>
		body {
			margin: 0;
			padding: 0;
			display: grid;
			grid-template-rows: 300px minmax(0, 50vh) 100px;
			height: 100vh;
		}

		header {
			background-color: #333;
			color: #fff;
			padding: 10px;
		}

		.container {
			display: grid;
			grid-template-columns: 1fr 1fr;
			grid-template-rows: 1fr;
			grid-gap: 20px;
			padding: 20px;
		}

		.item {
			background-color: #ccc;
			padding: 20px;
			overflow: auto;

		}
		.item2 {
			background-color: #ccc;
			padding: 20px;
		}

		.footer {
			background-color: #333;
			color: #fff;
			padding: 10px;
			text-align: center;
		}
	</style>
</head>
<body>
	<header>
		<a href="logout.php">Deslogear</a>
	    <h1>Login</h1>
	    <?php
	    // Mostrar mensaje de error si existe
	    if (isset($error)) {
	        echo "<p class='error'>" . $error . "</p>";
	    }
	    ?>
	    <!-- formulario de búsqueda -->
	    <form method="GET">
	        <label for="busqueda">Buscar películas:</label>
	        <input type="text" id="busqueda" name="busqueda">
	        <button type="submit">Buscar</button>
	    </form>
	</header>

	<div class="container">
		<div class="item">
		<?php require_once ('php/busqueda.php') ?>
			
		</div>

		<div class="item2">
			<form action="php/guardarPelicula.php" method="POST">
		        <label>Título:</label>
		        <input type="text" name="titulo" required><br>

		        <label>Descripción:</label>
		        <textarea name="descripcion"></textarea><br>

		        <label>Duración:</label>
		        <input type="number" name="duracion" required><br>

		        <label>Director:</label>
		        <input type="text" name="director"><br>

		        <label>Clasificación:</label>
		        <select name="clasificacion" required>
		            <option value="G">G</option>
		            <option value="PG">PG</option>
		            <option value="PG-13">PG-13</option>
		            <option value="R">R</option>
		            <option value="NC-17">NC-17</option>
		        </select><br>

		        <label>Fecha de Estreno:</label>
		        <input type="date" name="estreno" required><br>

		        <label>URL de Imagen:</label>
		        <input type="text" name="imagen" required><br>

		        <label>URL de Trailer:</label>
		        <input type="text" name="trailer"><br>
		        <input type="text" hidden name="id_api"><br>

		        <label>Disponible:</label>
		        <input type="checkbox" name="disponible" checked><br>

		        <input type="submit" value="Guardar Película">
		    </form>
		</div>
	</div>

	<footer class="footer">
		<p>Pie de página</p>
	</footer>
	<script src="js/busqueda.js"></script>
	
</body>
</html>
