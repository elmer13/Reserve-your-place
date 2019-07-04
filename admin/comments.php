<?php
	
	include_once '../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante

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
	<title>Comentarios - Portal de Administración</title>
</head>
<body>
<!--
/*************************************************************************************************************************/
/	'$tag'  	        = Objeto instanciado de la clase tags para crear elementos html como divs, label, echo, img, etc. /
/   '$mi_sesion'        = Objeto instanciado de la clase sesion para crear, verificar y borrar sesiones                   /
/	'$restaurant'       = Objeto instanciado de la clase restaurant para realizar las diferentes consultas 				  /
/*************************************************************************************************************************/
-->
	<?php
		// Cabecera
		$tag->openTag('div','header','',''); 

			$tag->openTag('div','','logo',''); // Logo de la cabecera
				$tag->openTag('a','','',array('href'=>'home.php'));
					$tag->openTag('img','','',array('src'=>'../site_media/img/icon-reserveyourplace.png','width'=>'70','height'=>'50'));
					$tag->closeTag('img');
				$tag->closeTag('a');
			$tag->closeTag('div');

			$tag->openTag('div','','title',''); // Titulo de la cabecera
				$tag->openTag('h2','','','');
					$tag->openTag('a','','',array('href'=>'home.php'));
						$tag->output('Portal de Administración');
					$tag->closeTag('a');
				$tag->closeTag('h2');
			$tag->closeTag('div');

		$tag->closeTag('div');

		// Sistema de navegación
		$tag->openTag('div','','menutop','');

			$tag->openTag('a','nav-mobile','nav-mobile',array('href'=>'#'));
			$tag->closeTag('a');
		
			$menu->cargarEnlace('home.php','Home','','',array('onclick'=>''));
			$menu->cargarEnlace('add_restaurant.php','Informacion','','');
			$menu->cargarEnlace('table_restaurant.php','Mesas','','');
			$menu->cargarEnlace('menu_gourmet.php','Menus y Platos','','');
			$menu->cargarEnlace('reserve.php','Reservas','','');
			$menu->cargarEnlace('comments.php','Comentarios','','selected');
			$menu->mostrarHorizontal();	
			
			$tag->openTag('ul','','','');
			include_once '../includes/menu_top.php';  // Incluimos diferentes enlaces dependiendo si ha iniciado sesión en el Cliente, Portal de Usuario o Portal de Administración
			$tag->closeTag('ul');
			
		$tag->closeTag('div');
	
		// Cuerpo de la página
		$tag->openTag('div','contenedor','margen',''); 

			$tag->openTag('div','contenedor-table','','');

				$form->startForm('','POST','', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario

					$tag->openTag('h2','','','');
					$tag->output('Mis Comentarios');
					$tag->closeTag('h2');

					$input->addInput('submit','update','Actualizar',array('id'=>'submit','class'=>'btn4')); // Boton para actualizar 
					$tag->closeTag('div');

					// Creamos una tabla para mostrar los detalles de los comentarios de cada usuario
					$tag->openTag('table','','board-table',array('border'=>'2'));

						// Definimos la cabecera de la tabla
						$tag->openTag('tr','','board-table-tr','');

							$tag->openTag('td','','','');
								$tag->output('Usuario');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->output('Día');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->output('Hora');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->output('Descripción');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->output('Nota');
							$tag->closeTag('td');

						$tag->closeTag('tr');

						$restaurant->getCommentsByCif($restaurant_id); // Obtenemos los datos de los comentarios que ha realizado el usuario teniendo en cuenta la ID del restaurante

						if(isset($restaurant->consulta)!=null){ // Siempre y cuando la consulta sea diferente de nulo hacemos lo siguiente

							foreach ($restaurant->consulta as $key => $values) {  // Recorremos el array y lo almacenamos en '$values'

								// Mostramos los comentarios del usuario en el restaurante determinado
								$tag->openTag('tr','','','');

									$tag->openTag('td','','','');
										$tag->output($values['username']);
									$tag->closeTag('td');
									$tag->openTag('td','','','');
										$tag->output($values['date']);
									$tag->closeTag('td');
									$tag->openTag('td','','','');
										$tag->output($values['time']);
									$tag->closeTag('td');
									$tag->openTag('td','','','');
										$tag->output($values['description']);
									$tag->closeTag('td');
									$tag->openTag('td','','','');
										$tag->output($values['note']);
									$tag->closeTag('td');

								$tag->closeTag('tr');

							}

						}

					$tag->closeTag('table'); // Cerramos la tabla

				$form->endForm(); // Cerramos el formulario

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
	}else{ // Si el administrador del restaurante no ha iniciado sesión le redireccionamos a la Página Principal
		header('location: ../index.php');
	}
?>