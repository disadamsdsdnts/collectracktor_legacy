<?php
	define('SERVER_PATH', ('//' . $_SERVER['HTTP_HOST'] . '/'));
	
    include_once './admin/functions.php';

    session_start();

	if(!file_exists('./config/config.php')){
		header('Location: ./install/index.php');
	} else {
		include_once './config/config.php';
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Colec-track-tor</title>
</head>
<body>
	<?php 
        include_once './navigator.php';
	?>

	<br><hr><br>

	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h1>🚜 Colec-track-tor 📇</h1>
			</div>
		</div>

		<br>

		<div class="row">
			<div class="col-12 text-center">
				<p class="text-justify">
					<strong>Colec-track-tor</strong> surge de la necesidad de los grandes recolectores de artículos de ocio, entretenimiento o simples manías de cada uno. Cada coleccionista que es perfeccionista sabe que una gran colección es muy dificil de llevar cuando hay más de 100 artículos. Las dudas empiezan a surgir de si se han adquirido o si estará repetido, si se perdió o sigue escondido detrás de los demás coleccionables.
				</p>

				<hr>

				<p class="text-justify">
					<strong>Colec-track-tor</strong> es un juego de las palabras inglesas <span class="font-italic">collection, track </span> y <span class="font-italic">tractor</span>:<br>
					<dl class="row">
						<dt class="col-sm-3">
							<strong>Collection</strong> (<span class="font-italic"> colección </span>)
						</dt>
						<dd class="col-sm-9 text-justify">
							Todo el mundo tiene un secreto y es en forma de colección. Algún cajón lleno, una estantería repleta o una caja a reventar.
						</dd>

						<dt class="col-sm-3">
							<strong>Track</strong> (<span class="font-italic"> seguir </span>)
						</dt>
						<dd class="col-sm-9 text-justify">
							Del verbo en inglés, seguir o buscar algo con detenimiento, como completar nuestras colecciones tan especiales.
						</dd>

						<dt class="col-sm-3">
							<strong>Tractor</strong> (<span class="font-italic"> tractor </span>)
						</dt>
						<dd class="col-sm-9 text-justify">
							Porque necesitaremos algo robusto para llevarnos todo a la basura algún dia. 
						</dd>
					</dl>
				</p>

				<hr>

				<p class="text-justify">
					Disfruten de nuestra recolección de datos automática de música y películas. Cree sus propias colecciones personalizadas a su gusto. Disfrute como nunca y desde cualquier sitio su colección ordenada y preparada para la consulta que más necesite en ese momento de duda y perdición. No se vaya lejos, quedan novedades por llegar: colecciones públicas y privadas, búsqueda de datos y recolección de información. Y siempre puede contactarnos para seguir mejorando y aportar sus ideas. Esperemos que le sea de agrado. <strong>¡A coleccionar!</strong>
				</p>

				<p class="text-right">
					<span class="font-italic">- El equipo de Colec-track-tor</span> 🚜
				</p>
			</div>
		</div>
	</div>
</body>
</html>
