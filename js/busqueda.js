// Obtener todos los botones de agregar
const agregarBotones = document.querySelectorAll('.agregar');

// Iterar sobre cada botón de agregar y agregar un controlador de eventos
agregarBotones.forEach(boton => {
  boton.addEventListener('click', () => {
    // Obtener el ID de la película del atributo "data-id" del botón
    const id = boton.getAttribute('data-id');

    // Enviar una solicitud AJAX al servidor para obtener los detalles de la película
    const api_key = "4893e4a751f59e2248b2776c1ac7eb78";
    fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=${api_key}`)
      .then(response => response.json())
      .then(pelicula => {
        // Actualizar los campos del formulario con los detalles de la película
        document.querySelector('[name="titulo"]').value = pelicula.title;
        document.querySelector('[name="descripcion"]').value = pelicula.overview;
        document.querySelector('[name="duracion"]').value = pelicula.runtime;
        document.querySelector('[name="director"]').value = pelicula.director;
        document.querySelector('[name="clasificacion"]').value = pelicula.vote_average;
        document.querySelector('[name="estreno"]').value = pelicula.release_date;
        document.querySelector('[name="imagen"]').value = pelicula.poster_path;
        document.querySelector('[name="trailer"]').value = pelicula.video;
        document.querySelector('[name="disponible"]').checked = pelicula.adult;
      })
      .catch(error => console.error(error));
  });
});
