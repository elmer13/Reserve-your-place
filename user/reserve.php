<?php

	include_once '../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 

	if($mi_sesion->getValor('id_user')==TRUE){ // Controlamos que la sesión sea la del usuario

?>

<!DOCTYPE>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
	<meta name='description' content='Plataforma de reserva de mesas para restaurantes'>
	<meta name='keywords' content='plataforma, reserva, mesas, restaurante'>
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
	<link rel='stylesheet' type='text/css' href='../site_media/css/style.css'/>
	<link rel='shortcut icon' href='../site_media/img/favicon.ico'/>
	<script type='text/javascript' src='../site_media/js/jquery-1.11.0.min.js'></script>
	<script type='text/javascript' src='../site_media/js/scrollTop.js'></script>
	<script type='text/javascript' src='../site_media/js/btn_movil.js'></script>
	<title>Mis Reservas - Portal del Usuario</title>
</head>
<body>
<!--
/*******************************************************************************************************************/
/	'$tag'  	  = Objeto instanciado de la clase tags para crear elementos html como divs, label, echo, img, etc. /
/	'$menu' 	  = Objeto instanciado de la clase HtmlEnlace para crear menus 										/
/	'$user'       = Objeto instanciado de la clase user para realizar las diferentes consultas 				        /
/   '$mi_sesion'  = Objeto instanciado de la clase sesion para crear, verificar y borrar sesiones                   /
/********************************************************************************************************************
-->
	<?php
		// Cabecera
		$tag->openTag('div','header','',''); 

			$tag->openTag('div','','logo',''); // Logo de la cabecera
				$tag->openTag('a','','',array('href'=>'profile.php'));
					$tag->openTag('img','','',array('src'=>'../site_media/img/icon-reserveyourplace.png','width'=>'70','height'=>'50'));
					$tag->closeTag('img');
				$tag->closeTag('a');
			$tag->closeTag('div');

			$tag->openTag('div','','title',''); // Titulo de la cabecera
				$tag->openTag('h2','','','');
					$tag->openTag('a','','',array('href'=>'profile.php'));
						$tag->output('Portal del Usuario');
					$tag->closeTag('a');
				$tag->closeTag('h2');
			$tag->closeTag('div');

		$tag->closeTag('div');


		// Sistema de navegación
		$tag->openTag('div','','menutop','');

			$tag->openTag('a','nav-mobile','nav-mobile',array('href'=>'#'));
			$tag->closeTag('a');

			$menu->cargarEnlace('profile.php','Información','','');
			$menu->cargarEnlace('reserve.php','Mis reservas','','selected');
			$menu->cargarEnlace('comments.php','Mis Comentarios','','');
			$menu->mostrarHorizontal();	

			$tag->openTag('ul','','','');
			include_once '../includes/menu_top.php'; // Incluimos diferentes enlaces dependiendo si el usuario ha iniciado sesión en el cliente, portal de usuario o portal de administración
			$tag->closeTag('ul');

		$tag->closeTag('div');

		// Cuerpo de la página
		$tag->openTag('div','contenedor','',''); 

			$tag->openTag('div','contenedor-table','','');

					$tag->openTag('h2','','','');
						$tag->output('Mis Reservas');
					$tag->closeTag('h2');

					// Creamos una tabla para mostrar los detalles de la reserva que ha realizado el usuario
					$tag->openTag('table','','board-table',array('border'=>'2')); // Abrimos la tabla

						// Definimos la cabecera de la tabla
						$tag->openTag('tr','','board-table-tr','');
							$tag->openTag('td','','','');
								$tag->output('Restaurante');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->output('Día');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->output('Hora');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->output('Número de Personas');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->output('Descripción');
							$tag->closeTag('td');
						$tag->closeTag('tr');

						$user->getReservationByUser($user_id); // Obtenemos los datos de la reserva que ha realizado el usuario teniendo en cuenta su ID

						if(isset($user->consulta)!=null){ // Siempre y cuando la consulta sea diferente de nulo hacemos lo siguiente

							foreach ($user->consulta as $key => $values) { // Recorremos el array y lo almacenamos en '$values'
								
								// Mostramos los datos de la reserva
								$tag->openTag('tr','','','');
									$tag->openTag('td','','','');
										$tag->output($values['name']);
									$tag->closeTag('td');
									$tag->openTag('td','','','');
										$tag->output($values['date']);
									$tag->closeTag('td');
									$tag->openTag('td','','','');
										$tag->output($values['time']);
									$tag->closeTag('td');
									$tag->openTag('td','','','');
										$tag->output($values['number_people']);
									$tag->closeTag('td');
									$tag->openTag('td','','','');
										$tag->output($values['description']);
									$tag->closeTag('td');
								$tag->closeTag('tr');

							}

						}

					$tag->closeTag('table'); // Cerramos la tabla

			$tag->closeTag('div');

		$tag->closeTag('div');	
		
		// Pie de página
		$tag->openTag('div','footer','','');
			$tag->openTag('a','','','');
				$tag->output('&copy;  2014 - 2015 Reserveyourplace.com - Todos los derechos reservados');
			$tag->closeTag('a');
		$tag->closeTag('div');
	?>
</body>
</html>

<?php
	}else{ // Si el usuario no ha iniciado sesión le redireccionamos a la Página Principal
		header('location: ../index.php');
	}
?>