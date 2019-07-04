<?php
	include_once '../../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 

	if($mi_sesion->getValor('id_user')==TRUE){ // Controlamos que la sesión sea la del usuario
	
	require_once '../../includes/validate_comments.php'; // Incluimos el fichero que validará los comentarios 

?>
<!DOCTYPE>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
	<meta name='description' content='Plataforma de reserva de mesas para restaurantes'>
	<meta name='keywords' content='plataforma, reserva, mesas, restaurante'>
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
	<link rel='stylesheet' type='text/css' href='../../site_media/css/style.css'/>
	<link rel='shortcut icon' href='../../site_media/img/favicon.ico'/>
	<link rel='stylesheet' type='text/css' media='all' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css'>
	<script type='text/javascript' src='../../site_media/js/jquery-1.11.0.min.js'></script>
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'></script>
	<script type='text/javascript' src='../../site_media/js/scrollTop.js'></script>
	<script type='text/javascript' src='../../site_media/js/get_note_service_add.js'></script>
	<script type='text/javascript' src='../../site_media/js/btn_movil.js'></script>
	<title>Añadir Comentario - Portal del Usuario</title>
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
				$tag->openTag('a','','',array('href'=>'../profile.php'));
					$tag->openTag('img','','',array('src'=>'../../site_media/img/icon-reserveyourplace.png','width'=>'70','height'=>'50'));
					$tag->closeTag('img');
				$tag->closeTag('a');
			$tag->closeTag('div');

			$tag->openTag('div','','title',''); // Titulo de la cabecera
				$tag->openTag('h2','','','');
					$tag->openTag('a','','',array('href'=>'../profile.php'));
						$tag->output('Portal del Usuario');
					$tag->closeTag('a');
				$tag->closeTag('h2');
			$tag->closeTag('div');

		$tag->closeTag('div');

		// Sistema de navegación
		$tag->openTag('div','','menutop','');

			$tag->openTag('a','nav-mobile','nav-mobile',array('href'=>'#'));
			$tag->closeTag('a');

			$menu->cargarEnlace('../profile.php','Información','','');
			$menu->cargarEnlace('../reserve.php','Mis reservas','','');
			$menu->cargarEnlace('../comments.php','Mis Comentarios','','selected');
			$menu->mostrarHorizontal();	

			$tag->openTag('ul','','','');
			$tag->openTag('div','','item','');
				$tag->openTag('img','','',array('src'=>'../../site_media/img/out.png','width'=>'30','height'=>'30'));
				$tag->closeTag('img');
				$tag->openTag('a','','',array('href'=>'../../includes/logout.php')); // Creamos un enlace para que Cerrar Sesión
					$tag->output('Cerrar Sesión');
				$tag->closeTag('a');
			$tag->closeTag('div');
			$tag->closeTag('ul');

		$tag->closeTag('div');

		// Cuerpo de la página
		$tag->openTag('div','contenedor','',''); 

		$tag->openTag('h2','','','');
			$tag->output('Añadir nuevo comentario');
		$tag->closeTag('h2');
			
		$tag->openTag('div','','informacion_negocio','');
			
			// Creamos un formulario para agregar las valoraciones del usuario 

			$form->startForm('','POST','', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 
					
				$tag->openTag('div','','none-line','');						
					$tag->openTag('label','','',array('for'=>'id_user')); 
						$tag->output('Id User: '); 
					$tag->closeTag('label');						
					$input->addInput('text','id_user',$user_id,array('id'=>'id_user','placeholder'=>'','class'=>'infor','size'=>16, 'readonly'=>'readonly','required'=>'required'));
				$tag->closeTag('div');
			
				$tag->openTag('div','','line','');						
					$tag->openTag('label','','',array('for'=>'cif_restaurant'));	
						$tag->output('Selecciona Restaurante: ');
					$tag->closeTag('label');			

					$user->getNameRestaurantReservationByUser($user_id); // Obtenemos los restaurantes disponibles para realizar la reserva

					foreach ($user->consulta as $key => $value) { // Recorremos los resultados de la consulta y lo almacenamos en '$values'
						$array[0]= 'Seleccione una opción';
						$array[$value['cif_restaurant']]=$value['name'].'-'.$value['date'];		
					}
					$form->addSelect('cif_restaurant', $array,0);
			
				$tag->closeTag('div');

				$user->getNameTypeRatings(); // Obtenemos los tipos de valoraciones que se pueden realizar a la hora de añadir el comentario
					
				if(isset($user->consulta)!=null){ // Siempre y cuando la consulta sea diferente de nulo hacemos lo siguiente
			
					foreach ($user->consulta as $key => $values) { // Recorremos los resultados de la consulta y lo almacenamos en '$values'
						
						$tag->openTag('div','','filter','');
							$tag->openTag('label','','',array('for'=>'slider-'.$values['id_type_rating'])); 
								$tag->output($values['name']); 
							$tag->closeTag('label');
					
								// Slider UI del elemento 'range' para el filtro por notas

							$input->addInput('text','input-'.$values['id_type_rating'],'',array('id'=>'input-'.$values['id_type_rating'],'placeholder'=>'','class'=>'nota','readonly'=>'readonly'));
								
							$tag->openTag('div','slider-'.$values['id_type_rating'],'','');
							$tag->closeTag('div');
						$tag->closeTag('div');

					}
				}

				$tag->openTag('div','','line','');
					$tag->openTag('label','','',array('for'=>'description')); 
						$tag->output('Descripción: '); 
					$tag->closeTag('label');	
					$form->addTextarea('description',5,39,'',array('class'=>'textarea', 'maxlength'=>100,'placeholder'=>'Añadir un comentario(opcional)'));
					$form->closeTextarea();
				$tag->closeTag('div');

				$tag->openTag('div','','button-align-left','');
					$input->addInput('submit','add-comment','Añadir comentario',array('id'=>'submit','class'=>'btn'));
				$tag->closeTag('div');

			$form->endForm(); // Cierre de formulario 

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
		header('location: ../../index.php');
	}
?>