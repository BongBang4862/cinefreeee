<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script>
		fetch('https://www3.cinecalidad.ms/pelicula/super-mario-bros-la-pelicula/',{ mode: 'no-cors' })
		  .then(response => {
		    if (!response.ok) {
		      throw new Error('Error en la solicitud');
		    }
		    return response.text();
		  })
		  .then(data => {
		    // Aquí puedes trabajar con los datos obtenidos
		    console.log(data);
		  })
		  .catch(error => {
		    console.error('Ha ocurrido un error:', error);
		  });
	</script>
</head>
<body>
	
</body>
</html>