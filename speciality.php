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
	<title>Especialidad - Reserve your place</title>
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

			$menu->cargarEnlace('index.php','Home','','');
			$menu->cargarEnlace('speciality.php','Especialidad','','selected');
			$menu->cargarEnlace('search.php','Buscador','','');
			$menu->cargarEnlace('contact.php','Contacto','','');
			$menu->mostrarHorizontal();	

			$tag->openTag('ul','','','');
			include_once 'includes/menu_top.php'; // Incluimos diferentes enlaces dependiendo si el usuario ha iniciado sesión en el cliente, portal de usuario o portal de administración
			$tag->closeTag('ul');

		$tag->closeTag('div');

		// Cuerpo de la página
		$tag->openTag('div','contenedor','',''); 

		$restaurant->getSpecialityOfRestaurant(); // Obtenemos todas las especialidades que puede tener un restaurante

		if($restaurant->consulta!=null){ // Si la consulta es diferente de nulo 

			foreach($restaurant->consulta as $key=>$values){ // Recorremos la consulta con un foreach y mostramos los datos con '$values'

				$id_speciality = base64_encode($values['id_speciality']); // Encriptamos la ID de la especialidad 

				$tag->openTag('div','','speciality','');
					$tag->openTag('a','','',array('href'=>'search.php?id_speciality='.$id_speciality));	// Enviamos el parametro '$id_speciality' por get previamente encriptado
					$tag->openTag('img','','',array('src'=>'site_media/img/speciality/'.$values['src']));
					$tag->closeTag('img');
					$tag->openTag('h2','','','');
					$tag->openTag('span','','','');
					$tag->output($values['name']);
					$tag->closeTag('span');
					$tag->closeTag('h2');
					$tag->closeTag('a');
				$tag->closeTag('div');
			}

		}else{ // Si las especialidades aún no estan definidas lo hacemos saber

			$tag->output('No se encuentran especialidades.');						

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