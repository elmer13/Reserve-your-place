<?php
	
	include_once 'core/init.php'; // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if(!$mi_sesion->getValor('id_user')==TRUE){ // Controlamos que la sesión sea distinta a la del usuario
	
	if(!$mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea distinta a la del administrador del restaurante


	if (isset($_GET['cif']) === true) { // Si se ha recibido un valor por GET como parametro
		
		$cif_restaurant = base64_decode($_GET['cif']);  // Desencriptamos el parámetro recibido por get en este caso el CIF del restaurante

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
	<meta name='description' content='Plataforma de reserva de mesas para restaurantes'>
	<meta name='keywords' content='plataforma, reserva, mesas, restaurante'>
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
	<link rel='stylesheet' type='text/css' href='site_media/css/style.css'/>
	<link rel='shortcut icon' href='site_media/img/favicon.ico' />
	<script type='text/javascript' src='site_media/js/jquery-1.11.0.min.js'></script>
	<script type='text/javascript' src='site_media/js/jquery.bxslider.js'></script>
	<link rel='stylesheet' type='text/css' href='site_media/css/jquery.bxslider.css'/>
	<script type='text/javascript' src='site_media/js/slider.js'></script>
	<script type='text/javascript' src='site_media/js/scrollTop.js'></script>
	<script type='text/javascript' src='site_media/js/btn_movil.js'></script>
	<title>Detalles - Reserve your place</title>
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

		$tag->openTag('div','','left','');

			$restaurant->getImagesByCif($cif_restaurant); // Obtenemos las imagenes del slider que tiene asignadas el restaurante
							
		if(isset($restaurant->consulta)!=null){  // Si la consulta es diferente de nulo mostramos los resultados

				$tag->openTag('ul','','bxslider','');
					foreach ($restaurant->consulta as $key => $values) { // Recorremos los diferentes resultados y los mostramos con '$values'								
						$tag->openTag('li','','','');;
						$tag->openTag('img','','',array('src'=>'admin/admin_images/'.$values['src']));
						$tag->closeTag('img');
						$tag->closeTag('li');
					}
				$tag->closeTag('ul');
				
			}else{ // Si la consulta es nula asignamos la imagen por defecto 
				$tag->openTag('ul','','bxslider','');
					$tag->openTag('li','','','');
						$tag->openTag('img','','',array('src'=>'site_media/img/not_found.png','width'=>'1260','height'=>'290'));
						$tag->closeTag('img');
					$tag->closeTag('li');
				$tag->closeTag('ul');
			}
	
		$tag->openTag('div','','content','');

		$tag->openTag('h1','','','');
		$tag->output('En pocas palabras..');
		$tag->closeTag('h1');
			
		$restaurant->getRestaurantsByCif($cif_restaurant); // Obtenemos toda la información del restaurante mediante el CIF
		
		if(isset($restaurant->consulta)!=null){ // Si la consulta es diferente de nulo hacemos lo siguiente

			foreach ($restaurant->consulta as $key => $values) { // Recorremos mediante un foreach 

				if($values['description']!=null){ // Cogemos la descripción del restaurante 

					$tag->output($values['description']);	

				}else{ // Si el campo de descripción es nulo lo hacemos saber

					$tag->output('El propietario aún no ha añadido una descripción.');
				}
			}
		}
		
		$tag->closeTag('div');


		$tag->openTag('div','','content','');
	
		$tag->openTag('h1','','','');
			$tag->output('Nuestras especialidades');
		$tag->closeTag('h1');

		$restaurant->getRestaurantSpecialityByCif($cif_restaurant); // Obtenemos las especialidades del restaurante mediante el CIF
		
		if(isset($restaurant->consulta)!=null){ // Si la consulta es diferente de nulo hacemos lo siguiente

			foreach ($restaurant->consulta as $key => $values) { // Recorremos mediante un foreach y mostramos los datos con '$values'
		
				$tag->output('<li><img src="site_media/img/add.png">&nbsp;&nbsp;'.$values['name'].'</li>'); 
				
			}
	
		}else{ //  En caso de no tener especialidades asignadas lo hacemos saber

			$tag->output('El propietario aún no ha añadido la especialidad.');

		}
		
		$tag->closeTag('div');
		
		
		$tag->openTag('div','','content','');

		$tag->openTag('h1','','','');
			$tag->output('Horario de disponibilidad');
		$tag->closeTag('h1');
		
		$restaurant->getRestaurantSchedulesByCif($cif_restaurant); // Obtenemos los horarios de disponibilidad del restaurante
		
		if(isset($restaurant->consulta)!=null){ // Si los tiene asignado y por tanto la consulta es diferente de nulo hacemos lo siguiente

			foreach ($restaurant->consulta as $key => $values) { // Recorremos con un foreach y mostramos los datos correspondientes con '$values'

				$tag->output('<li><img src="site_media/img/add.png">&nbsp;&nbsp;'.$restaurant->getNameById($values['day_week_start']).' - '.$restaurant->getNameById($values['day_week_finish']).' de '.$values['time_start'].' a '.$values['time_finish'].'</li>');
			}

		}else{ // Si aún no ha definido la disponibilidad del restaurante lo hacemos saber

			$tag->output('El propietario aún no ha añadido horarios.');
		}
		
		$tag->closeTag('div');
		
		
		$tag->openTag('div','','content','');

		$tag->openTag('h1','','','');
		$tag->output('Menus');
		$tag->closeTag('h1');
		
		$restaurant->getMenuByCif($cif_restaurant); // Obtenemos los menú del restaurante por CIF

		if(isset($restaurant->consulta)!=null){ // Si la consulta es diferente de nulo hacemos lo siguiente

			foreach ($restaurant->consulta as $key => $values) { // Recorremos con un foreach y mostramos los datos con '$values'

				$tag->output('<li class="list"><img src="site_media/img/add.png">&nbsp;&nbsp;');
				$tag->output($values['name']);
				if($values['description']){
					$tag->output(' ( '.$values['description'].' ) - ');

				}else{
					$tag->output(' - ');
				}

				$tag->output($values['price'].'€ </li>');
				$tag->output('<br/>');
			}

		}else{ // Si aún no ha añadido algun menú lo hacemos saber

			$tag->output('El propietario aún no ha añadido menús.');			
		}

		$tag->closeTag('div');	


		$tag->openTag('div','','content','');

		$tag->openTag('h1','','','');
			$tag->output('Recomendaciones del chef');
		$tag->closeTag('h1');

		$restaurant->getGourmetRecomendationOkByCif($cif_restaurant);

		if(isset($restaurant->consulta)!=null){ // Si la consulta es diferente de nulo hacemos lo siguiente
		
			foreach ($restaurant->consulta as $key => $values) {  // Recorremos con un foreach y cogemos los datos con '$values'
			$tag->output('<li><img src="site_media/img/add.png">&nbsp;&nbsp;'.$values['name_gourmet'].'</li>');
			}
		}else{
			$tag->output('El propietario aún no ha realizado sus recomendaciones.');
		}
		$tag->closeTag('div');	
		
		
		$tag->openTag('div','','content','');
		
		$tag->openTag('h1','','','');
			$tag->output('Información');
		$tag->closeTag('h1');		
		$restaurant->getRestaurantsByCif($cif_restaurant); // Obtenemos la información general del restaurante mediante el CIF
		
		if(isset($restaurant->consulta)!=null){ // Si la consulta es diferente de nulo hacemos lo siguiente
		
			foreach ($restaurant->consulta as $key => $values) {  // Recorremos con un foreach y cogemos los datos con '$values'

				if($values['parking']==1){ // Si el valor es 1 indicamos que tiene parking

					$tag->output('<li><img src="site_media/img/add.png">&nbsp;&nbsp;Parking: Si</li>');	

				}else if($values['parking']==0){ // Si el valor es 0 no lo tiene

					$tag->output('<li><img src="site_media/img/add.png">&nbsp;&nbsp;Parking: No</li>');
				}
			}
		}
		
		$tag->output('<br/>');
		
		$restaurant->getRestaurantTransportByCif($cif_restaurant); // Obtenemos los transportes del restaurante mediante el CIF
		
		if(isset($restaurant->consulta)!=null){	// Si se han asignado los transportes públicos lo indicamos

			$tag->output('<li><img src="site_media/img/add.png">&nbsp;&nbsp;Transporte públic: Si</li>');
			
			foreach ($restaurant->consulta as $key => $values) { // Recorremos el foreach y lo mostramos con '$values'

				$tag->output('<li>&nbsp;&nbsp;&nbsp;&nbsp; - '.$values["name"].' - '.$values["linea"].' - '.$values["station"].'</li>');

			}
		}else{ // En caso de no haberse asignado también lo hacemos saber

			$tag->output('<li><img src="site_media/img/add.png">&nbsp;&nbsp;Transporte público: No</li>');
		}
		
		$tag->closeTag('div');
		
		
		$tag->openTag('div','','content','');

		$tag->openTag('h1','','','');
			$tag->output('Ubicación');
		$tag->closeTag('h1');
		
		$restaurant->getRestaurantsByCif($cif_restaurant); // Obtenemos la información del restaurante mediante el CIF

		if(isset($restaurant->consulta)!=null){ // Si la consulta es diferente de nulo hacemos lo siguiente

		foreach ($restaurant->consulta as $key => $values) { // Recorremos con un foreach y mostramos los datos pertinentes con '$values'

			if((($values['location']) && ($values['zipcode']))!= null){
			$tag->output('<p>'.$values['location'].', '.$values['zipcode'].'</p>');
			}else{
			   $tag->output('El propietario aún no ha definido su ubicación.');
			}
		}
		
		}
		
		$tag->closeTag('div');	
		
		$tag->openTag('div','','content','');

		$tag->openTag('h1','','','');
			$tag->output('Valoraciones ( '.$restaurant->getCountCommentsByCif($cif_restaurant).' )');
		$tag->closeTag('h1');
		
		$restaurant->getCommentsByCif($cif_restaurant); // Obtenemos la información del restaurante mediante el CIF

		if(isset($restaurant->consulta)!=null){ // Si la consulta es diferente de nulo hacemos lo siguiente

		foreach ($restaurant->consulta as $key => $values) { // Recorremos con un foreach y mostramos los datos pertinentes con '$values'
			$tag->openTag('div','','valoracion','');
			$tag->openTag('div','','campo1','');	
				$tag->output($values['username'].'( '.$restaurant->getCountCommentsByUser($values['id_user']).' )');
			$tag->closeTag('div');
			$tag->openTag('div','','campo2','');	
				$tag->output($values['date'].'&nbsp;&nbsp;'.$values['time']);
			$tag->closeTag('div');
			$tag->openTag('div','','campo3','');	
				$tag->output('Nota: '.$values['note'].'/10');
			$tag->closeTag('div');
			$tag->openTag('div','','campo3','');	
			   $tag->output($values['description']);
			$tag->closeTag('div');
			$tag->closeTag('div');
		}
		
		}
		
		$tag->closeTag('div');	

	
		$tag->closeTag('div');		
		
		$tag->openTag('div','','right','');
		
			$cif = base64_encode($cif_restaurant); // Volvemos a encriptar el CIF del restaurante

			$input->addInput('button','linea','Reservar',array('id'=>'linea','placeholder'=>'','class'=>'btn5','size'=>16,'onclick'=>"javascript:location.href='reserve.php?cif=".$cif."';")); // // Enviamos el parametro '$cif' por get previamente encriptado

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
    }else{ // Si no se ha recibido un parametro GET le redireccionamos a la parte del cliente
        header('location: index.php');
    }

    }else{ // Si el administrador ha iniciado sesión le redireccionamos al portal de administración del restaurante
        header('location: admin/home.php');
    }
    }else{ // Si el usuario ha iniciado sesión le redireccionamos al portal de usuarios
        header('location: user/profile.php');
    }
?>