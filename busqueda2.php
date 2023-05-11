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
			<?php 
				if ($_SERVER["REQUEST_METHOD"] == "GET") {
				// Obtener el término de búsqueda del formulario
				$busqueda = $_GET['busqueda'];
				
				
				if (isset($busqueda)) {
				    // Realizar la consulta a la API de Dbmovies
				    $api_key = "4893e4a751f59e2248b2776c1ac7eb78";
				    $base_url = "https://api.themoviedb.org/3/search/movie?api_key={$api_key}&query={$busqueda}&page=";

				    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
				        $page = (int)$_GET['page'];
				    } else {
				        $page = 1;
				    }
				    $paginated_results = array();
				    var_dump($page);
				    // Iterar sobre las páginas y obtener nuevos resultados de la API para cada página
				        $url = $base_url . $page;
				        $json = file_get_contents($url);
				        $data = json_decode($json);
				        // Verificar si ya existen películas en $paginated_results antes de agregar las nuevas películas
				        foreach ($data->results as $pelicula) {
				            
				                $paginated_results[] = $pelicula;
				            
				        }

				        $total_pages = $data->total_pages;
				        var_dump($total_pages);

				        // Si ya hemos recuperado todas las páginas de la API, detener el bucle while
				        for ($i = 1; $i <= $total_pages; $i++) {
				            if ($i == $page) {
				                echo "<strong>$i</strong> ";
				            } else {
				                echo "<a href=\"?busqueda=$busqueda&page=$i\">$i</a> ";
				            }
				        }     
				        if (!empty($paginated_results)) {
				            echo "<table class='peliculas'>";
				            foreach ($paginated_results as $pelicula) {
				                $titulo = isset($pelicula->original_title) ? $pelicula->original_title : "Título desconocido";
				                $sinopsis = isset($pelicula->overview) ? $pelicula->overview : "Sinopsis desconocida";
				                $imagen = "https://image.tmdb.org/t/p/w500/" . $pelicula->poster_path;
				                $calificacion = isset($pelicula->vote_average) ? $pelicula->vote_average : "N/A";
				                $id = $pelicula->id;

				                echo "<tr>";
				                echo "<td><img src='$imagen' width=100 height=100 alt='$titulo'></td>";
				                echo "<td><h2>$titulo</h2></td>";
				                echo "<td><p>$sinopsis</p></td>";
				                echo "<td><p>Calificación: $calificacion</p></td>";
				                echo "<td><button class='agregar' data-id='$id'>Agregar</button></td>";
				                echo "</tr>";
				            }
				            echo "</table>";
				            
				                

				            } else {
				                echo "<p>No se encontraron resultados para \"$busqueda\".</p>";
				            }
				        }
				    }

			?>
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
