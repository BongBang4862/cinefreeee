<!DOCTYPE html>
<html>
<head>
    <title>Login - CineFreeee</title>
    <link rel="stylesheet" type="text/css" href="css/busqueda.css">
</head>s
<body>
<div class="container">
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
    <main>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Obtener el término de búsqueda del formulario
    
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
    </main>
    <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a>.</p>
</div>
</body>
</html>
