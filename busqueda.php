
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
       
    </main>

    <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a>.</p>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    var_dump($_SERVER["REQUEST_METHOD"]);
    $busqueda = $_GET["busqueda"];
    $api_key = "4893e4a751f59e2248b2776c1ac7eb78";
    // buscar.php - procesar la búsqueda

    // Verificar si se envió un término de búsqueda
    

    // Obtener el término de búsqueda del formulario
    $busqueda = $_GET['busqueda'];
    

    // Realizar la consulta a la API de Dbmovies
        $base_url = "https://api.themoviedb.org/3/search/movie?api_key={$api_key}&query={$busqueda}&page=";

        $page = 1;
        $results = array();

        do {
            $url = $base_url . $page;
            $json = file_get_contents($url);
            $data = json_decode($json);
            $results = array_merge($results, $data->results);
            $page++;
        } while ($data->total_pages >= $page);

   
   

    if (isset($results)) {
    echo "<section class='peliculas'>";
    foreach ($results as $pelicula) {
        $titulo = isset($pelicula->original_title) ? $pelicula->original_title : "Título desconocido";
        $sinopsis = isset($pelicula->overview) ? $pelicula->overview : "Sinopsis desconocida";
        $imagen = "https://image.tmdb.org/t/p/w500/" . $pelicula->poster_path;
        echo "<div class='pelicula'>";
        echo "<img src='$imagen' alt='$titulo'>";
        echo "<h2>$titulo</h2>";
        echo "<p>$sinopsis</p>";
        echo "</div>";
    }
    echo "</section>";
} else {
    echo "<p>No se encontraron resultados para \"$busqueda\".</p>";
}
}
?>
</body>
</html>





