<?php
	
	include_once 'core/init.php'; // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if(!$mi_sesion->getValor('id_user')==TRUE){ // Controlamos que la sesión sea distinta a la del usuario
	
	if(!$mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea distinta a la del administrador del restaurante

?>

<!DOCTYPE>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
	<meta name='description' content='Plataforma de reserva de mesas para restaurantes'>
	<meta name='keywords' content='plataforma, reserva, mesas, restaurante'>
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
	<link rel='stylesheet' type='text/css' href='site_media/css/style.css'/>
	<link rel='shortcut icon' href='site_media/img/favicon.ico'/>
	<script type='text/javascript' src='site_media/js/jquery-1.11.0.min.js'></script>
	<script type='text/javascript' src='site_media/js/scrollTop.js'></script>
	<script type='text/javascript' src='site_media/js/btn_movil.js'></script>
	<title>Home - Reserve your place</title>
</head>
<body>
<!--
/*******************************************************************************************************************/
/	'$tag'  	  = Objeto instanciado de la clase tags para crear elementos html como divs, label, echo, img, etc. /
/	'$menu' 	  = Objeto instanciado de la clase HtmlEnlace para crear menus 										/
/	'$restaurant' = Objeto instanciado de la clase restaurant para realizar las diferentes consultas 				/
/   '$mi_sesion'  = Objeto instanciado de la clase sesion para crear, verificar y borrar sesiones                   /
/********************************************************************************************************************
-->
	<?php
		// Cabecera
		$tag->openTag('div','header','',''); 	

			$tag->openTag('div','','logo',''); // Logo de la cabecera
				$tag->openTag('a','','',array('href'=>'index.php'));
					$tag->openTag('img','','',array('src'=>'site_media/img/icon-reserveyourplace.png','width'=>'70','height'=>'50'));
					$tag->closeTag('img');
				$tag->closeTag('a');
			$tag->closeTag('div');

			$tag->openTag('div','','title',''); // Titulo de la cabecera
				$tag->openTag('h2','','','');
					$tag->openTag('a','','',array('href'=>'index.php'));
						$tag->output('Reserve your place');
					$tag->closeTag('a');
				$tag->closeTag('h2');
			$tag->closeTag('div');

		$tag->closeTag('div');

		// Sistema de navegación
		$tag->openTag('div','','menutop','');

			$tag->openTag('a','nav-mobile','nav-mobile',array('href'=>'#'));
			$tag->closeTag('a');

			$menu->cargarEnlace('index.php','Home','','selected');
			$menu->cargarEnlace('speciality.php','Especialidad','','');
			$menu->cargarEnlace('search.php','Buscador','','');
			$menu->cargarEnlace('contact.php','Contacto','','');
			$menu->mostrarHorizontal();	

			$tag->openTag('ul','','','');
			include_once 'includes/menu_top.php'; // Incluimos diferentes enlaces dependiendo si el usuario ha iniciado sesión en el cliente, portal de usuario o portal de administración
			$tag->closeTag('ul');

		$tag->closeTag('div');

		// Cuerpo de la página
		$tag->openTag('div','contenedor','',''); 

		$restaurant->getRestaurants(); // Obtenemos la información de todos los restaurantes

		if(isset($restaurant->consulta)!=null){  // Si la consulta es diferente de nulo mostramos los resultados

			foreach ($restaurant->consulta as $key => $values) { // Recorremos los diferentes resultados y los mostramos con '$values'

				$tag->openTag('div','','producto','');

				$cif = base64_encode($values['cif_restaurant']); // Encriptamos el CIF del restaurante

					$tag->openTag('a','','',array('href'=>'details.php?cif='.$cif)); // Enviamos el parametro '$cif' por get previamente encriptado

						if($restaurant->getFeaturedImage($values['cif_restaurant'])){

							$tag->openTag('img','','',array('src'=>'admin/admin_images/'.$restaurant->getFeaturedImage($values['cif_restaurant']))); // Obtenemos la imagen principal del restaurante
							$tag->closeTag('img');

						}else{

							$tag->openTag('img','','',array('src'=>'admin/admin_images/images/not_found.png'));
							$tag->closeTag('img');

						}

					$tag->closeTag('a');

					$tag->openTag('div','','informacion','');				

						$tag->openTag('div','','campo','');

							$tag->output($values['name']); // Obtenemos el nombre del restaurante

						$tag->closeTag('div');

						
						$tag->openTag('div','','campo2','');

							if($values['capacity']){

								$tag->output($values['capacity'].' plazas'); // Obtenemos las plazas que tiene el restaurante

							}
					
						$tag->closeTag('div');
					
						$tag->openTag('div','','campo3','');
							
							if($restaurant->getRestaurantSpecialityRoundByCif($values['cif_restaurant'])){
							
								$tag->output('Especialidad: '.$restaurant->getRestaurantSpecialityRoundByCif($values['cif_restaurant']));  // Obtenemos una especialidad del restaurante aleatoriamente				
					
							}

						$tag->closeTag('div');

					
						$tag->openTag('div','','campo','');

							if($restaurant->getRestaurantsNote($values['cif_restaurant'])){

								$tag->output('Nota: '.$restaurant->getRestaurantsNote($values['cif_restaurant']).'/10'); // Obtenemos la nota media del restaurante sobre 10

							}
				
						$tag->closeTag('div');
							
						$tag->openTag('div','','campo2','');

							if($restaurant->getRestaurantsMenuCheap($values['cif_restaurant'])){

								$tag->output('A partir de '.$restaurant->getRestaurantsMenuCheap($values['cif_restaurant']).'€'); // Obtenemos el precio del menú más barato del restaurante
						
							}
				
						$tag->closeTag('div');
							
						$tag->openTag('div','','campo3','');

							if(($values['location']) &&($values['city'])!=null){

								$tag->output($values['location'].', '.$values['city']); // Concatenamos la dirección y la ciudad

							}
						$tag->closeTag('div');
						
					$tag->closeTag('div');

					
				 	$tag->openTag('div','','campo4_center','');

						$input->addInput('button','linea','Leer más',array('id'=>'linea','placeholder'=>'','class'=>'btn3','size'=>16,'onclick'=>"javascript:location.href='details.php?cif=".$cif."';")); // Para ver una información más detallada

					$tag->closeTag('div');

				$tag->closeTag('div');
			}

		}else{ // Si la consulta es nula lo hacemos saber

				$tag->output('No se encuentran restaurantes.');						

		}
		
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
    }else{ // Si el administrador ha iniciado sesión le redireccionamos al portal de administración del restaurante
        header('location: admin/home.php');
    }
    }else{ // Si el usuario ha iniciado sesión le redireccionamos al portal de usuarios
        header('location: user/profile.php');
    }
?>