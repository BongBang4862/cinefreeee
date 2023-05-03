<!DOCTYPE html>
<html>
<head>
    <title>Login - CineFreeee</title>
    <link rel="stylesheet" type="text/css" href="css/busqueda.css">
</head>
<body>
<div class="container">
    <a href="logout.php"></a>
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
        $busqueda = $_GET['busqueda'];
        if (isset($busqueda)) {
            // Realizar la consulta a la API de Dbmovies
            $api_key = "4893e4a751f59e2248b2776c1ac7eb78";
            $base_url = "https://api.themoviedb.org/3/search/movie?api_key={$api_key}&query={$busqueda}&page=";
            $page = 1;
            $results = array();

            do {
                $url = $base_url . $page;
                $json = file_get_contents($url);
                $data = json_decode($json);
                $results = array_merge($results, $data->results);
                $page++;
            } while ( $page <= 2);

            if (isset($results) && !empty($results)) {
                echo "<table class='peliculas'>";
                foreach ($results as $pelicula) {
                    $titulo = isset($pelicula->original_title) ? $pelicula->original_title : "Título desconocido";
                    $sinopsis = isset($pelicula->overview) ? $pelicula->overview : "Sinopsis desconocida";
                    $imagen = "https://image.tmdb.org/t/p/w500/" . $pelicula->poster_path;
                    echo "<tr>";
                    echo "<td><img src='$imagen' width=100 height=100   alt='$titulo'></td>";
                    echo "<td><h2>$titulo</h2></td>";
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
