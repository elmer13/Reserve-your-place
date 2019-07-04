<?php
	
	include_once '../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante
	
	require_once '../includes/validate_edit_restaurant.php';  // Incluimos el fichero que validará las modificaciones de los datos del restaurante

		
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
	<script type='text/javascript' src='../site_media/js/jquery.min.js'></script>
	<script type='text/javascript' src='../site_media/js/jquery.form.js'></script>
	<script type='text/javascript' src='../site_media/js/scrollTop.js'></script>
	<script type='text/javascript' src='resources/js/hideandshow.js'></script>
	<script type='text/javascript' src='../site_media/js/btn_movil.js'></script>
	<title>Información - Portal de Administración</title>
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
			$menu->cargarEnlace('add_restaurant.php','Informacion','','selected');
			$menu->cargarEnlace('table_restaurant.php','Mesas','','');
			$menu->cargarEnlace('menu_gourmet.php','Menus y Platos','','');
			$menu->cargarEnlace('reserve.php','Reservas','','');
			$menu->cargarEnlace('comments.php','Comentarios','','');
			$menu->mostrarHorizontal();	
			
			$tag->openTag('ul','','','');
			include_once '../includes/menu_top.php';  // Incluimos diferentes enlaces dependiendo si ha iniciado sesión en el Cliente, Portal de Usuario o Portal de Administración
			$tag->closeTag('ul');
			
		$tag->closeTag('div');
		
		// Cuerpo de la página
		$tag->openTag('div','contenedor','',''); 

		$tag->openTag('h2','','','');
		$tag->output('Información de tu negocio');
		$tag->closeTag('h2');
			
		// Mostramos el formulario con los datos del restaurante, por supuesto también los puede modificar

		$tag->openTag('div','','informacion_negocio','');

			$form->startForm('','POST','', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 

				$tag->openTag('div','','line','');						
				$tag->openTag('label','','',array('for'=>'codigo')); 
				$tag->output('Cif_restaurant: '); 
				$tag->closeTag('label');						
				$input->addInput('text','cif_restaurant',$restaurant_id,array('id'=>'cif_restaurant','placeholder'=>'','class'=>'infor','size'=>16, 'readonly'=>'readonly','required'=>'required'));
				$tag->closeTag('div');

				$tag->openTag('div','','line','');
				$tag->openTag('label','','',array('for'=>'name')); 
				$tag->output('Nombre: '); 
				$tag->closeTag('label');						
				$input->addInput('text','name',@$restaurantData['name'],array('id'=>'name','placeholder'=>'','class'=>'infor','size'=>16, 'required'=>'required'));
				$tag->closeTag('div');
				
				$tag->openTag('div','','line','');
				$tag->openTag('label','','',array('for'=>'description')); 
				$tag->output('Descripción: '); 
				$tag->closeTag('label');	
				$form->addTextarea('description',5,39,'',array('class'=>'textarea', 'maxlength'=>500));
				$tag->output(@$restaurantData['description']);
				$form->closeTextarea();
				$tag->closeTag('div');

				$tag->openTag('div','','line','');
				$tag->openTag('label','','',array('for'=>'location')); 
				$tag->output('Localización: '); 
				$tag->closeTag('label');						
				$input->addInput('text','location',@$restaurantData['location'],array('id'=>'location','placeholder'=>'','class'=>'infor','size'=>16, 'required'=>'required'));
				$tag->closeTag('div');
								
				$tag->openTag('div','','line','');
				$tag->openTag('label','','',array('for'=>'zipcode')); 
				$tag->output('Código Postal: '); 
				$tag->closeTag('label');						
				$input->addInput('text','zipcode',@$restaurantData['zipcode'],array('id'=>'zipcode','placeholder'=>'','class'=>'infor','size'=>16, 'required'=>'required'));
				$tag->closeTag('div');

				$tag->openTag('div','','line','');
				$tag->openTag('label','','',array('for'=>'city')); 
				$tag->output('Ciudad: '); 
				$tag->closeTag('label');						
				$input->addInput('text','city',@$restaurantData['city'],array('id'=>'city','placeholder'=>'','class'=>'infor','size'=>16, 'required'=>'required'));
				$tag->closeTag('div');
								
				$tag->openTag('div','','line','');
				$tag->openTag('label','','',array('for'=>'capacity')); 
				$tag->output('Capacidad: '); 
				$tag->closeTag('label');						
				$input->addInput('text','capacity',@$restaurantData['capacity'],array('id'=>'capacity','placeholder'=>'','class'=>'infor','size'=>16, 'required'=>'required'));
				$tag->closeTag('div');

				$tag->openTag('div','','line','');
				$tag->openTag('label','inline','',array('for'=>'capacity')); 
				$tag->output('Parking: '); 
				$tag->closeTag('label');	

				if($restaurantData['parking']==1){

				$tag->openTag('div','','onoffswitch','');
				$form->addInput('checkbox','parking','1',array('id'=>'myonoffswitch','placeholder'=>'','class'=>'onoffswitch-checkbox','size'=>16,'checked'=>'checked'));
				$tag->openTag('label','','onoffswitch-label',array('for'=>'myonoffswitch')); 
				$tag->openTag('span','','onoffswitch-inner',''); 
				$tag->closeTag('span');	
				$tag->openTag('span','','onoffswitch-switch',''); 
				$tag->closeTag('span');	
				$tag->closeTag('label');	
				$tag->closeTag('div');	

				}else{

				$tag->openTag('div','','onoffswitch','');
				$form->addInput('checkbox','parking','1',array('id'=>'myonoffswitch','placeholder'=>'','class'=>'onoffswitch-checkbox','size'=>16));
				$tag->openTag('label','','onoffswitch-label',array('for'=>'myonoffswitch')); 
				$tag->openTag('span','','onoffswitch-inner',''); 
				$tag->closeTag('span');	
				$tag->openTag('span','','onoffswitch-switch',''); 
				$tag->closeTag('span');	
				$tag->closeTag('label');	
				$tag->closeTag('div');	

				}

				$tag->closeTag('div');
				$tag->output('<br/>');

				// En caso de no introducir correctamente los datos del formulario mostramos el error
				if(empty($errors) === false){
					echo '<p>' . implode('</p><p>', $errors) . '</p>';	
				}
				
				$tag->openTag('a','','',array('href'=>'../includes/change_password_restaurant.php')); // Enlace para cambiar de contraseña
					$tag->output('&nbsp;&nbsp;Cambiar Contraseña');
				$tag->closeTag('a');

				$tag->output('<br/>');
				$input->addInput('submit','submit','Guardar',array('id'=>'submit','class'=>'btn3'));
				$input->addInput('reset','','Cancelar',array('id'=>'reset','class'=>'btn3'));

			$form->endForm(); // Cerramos el formulario

		$tag->closeTag('div');	

		$tag->openTag('div','','detalles_negocio','');
			
			$tag->openTag('div','','detalles_negocio_speciality','');	

				$tag->openTag('h1','','','');
				$tag->output('Especialidad');
				$tag->closeTag('h1');
				$tag->output('<br/>');


				$restaurant->getRestaurantSpecialityByCif($restaurant_id); // Obtenemos las especialidades del Restaurante mediante su id

				$tag->openTag('div','','results','');

				if(isset($restaurant->consulta)!=null){ // Siempre y cuando el resultado de la consulta sea diferente de nulo hacemos lo siguiente

				foreach ($restaurant->consulta as $key => $value) { // Recorremos los resultado y lo asignamos a '$values'

				// Mostramos las especialidades seleccionadas por el usuario, además añadimos un enlace donde también podrá eliminarse

				$tag->openTag('div','','file','');				
					$tag->output("<li>".$value['name']."<a href='admin_speciality/delete_speciality_restaurant.php?id_speciality=".$value['speciality']."'><img src='../site_media/img/delete.png'></img></a></li>");
				$tag->closeTag('div');

				}

				}else{ // Si el administrador del restaurante aún no ha definido las especialidades lo hacemos saber

					$tag->output('No ha definido las especialidades del restaurante');

				}

				$tag->closeTag('div');

				$tag->openTag('div','','line','');
				$input->addInput('button','linea','Añadir especialidad',array('id'=>'botonocultamuestra3','placeholder'=>'','class'=>'btn','size'=>16,'onclick'=>'')); // Boton paa añadir especialidades
				$tag->closeTag('div');
					
				$tag->openTag('div','divocultamuestra3','','');	
				
				$restaurant->getSpeciality(); // Obtenemos las especialidades que puede tener un restaurante

				foreach ($restaurant->consulta as $key => $value) { // Recorremos los resultados

					$array[]=$value['name'];
						
				}

				// Mostramos las especialidades mediante un checkbox para que el administrador del restaurante haga sus elecciones
				$form->startForm('add_speciality.php','POST','', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 
				
				$form->addcheckradio('checkbox','speciality', $array,'','','');
					
				$tag->openTag('div','','','');
				$input->addInput('submit','submit2','Guardar cambios',array('id'=>'btn','class'=>'btn'));
				$tag->closeTag('div');


				$form->endForm(); // Cerramos el formulario

				$tag->closeTag('div');

			$tag->closeTag('div');

			$tag->openTag('div','','detalles_negocio_transport','');	

				$tag->openTag('h1','','','');
				$tag->output('Transporte Público');
				$tag->closeTag('h1');

				$tag->openTag('div','','information','');

				$restaurant->getRestaurantTransportByCif($restaurant_id); // Obtenemos los transportes del restaurante mediante su id

				if(isset($restaurant->consulta)!=null){ // Siempre y cuando el resultado de la consulta sea diferente de nulo hacemos lo siguiente

				foreach ($restaurant->consulta as $key => $values) { // Recorremos los resultados y los mostramos
				
					$tag->output('<li>'.$values['name'].', Linea: '.$values['linea'].', '.$values['station'].'</li><br/>');	

				}
				
				}else{ // Si el restaurante aún no ha asociado los transportes lo hacemos saber

					$tag->output('No ha definido los transportes públicos del restaurante.');
						
				}
						
				$tag->closeTag('div');
					
				$input->addInput('button','linea','Acceder a la sección de transporte',array('id'=>'linea','placeholder'=>'','class'=>'btn','size'=>16,'onclick'=>"javascript:location.href='admin_transport/add_transport.php';")); // Botón que nos permitirá ir a la sección de transportes

			$tag->closeTag('div');

			$tag->openTag('div','','detalles_negocio_schedules','');

				$tag->openTag('h1','','','');
				$tag->output('Franjas horarias');
				$tag->closeTag('h1');

				$tag->openTag('div','','information','');

				$restaurant->getRestaurantSchedulesByCif($restaurant_id); // Obtenemos los horarios del restaurante mediante su id

				if(isset($restaurant->consulta)!=null){ // Siempre y cuando el resultado de la consulta sea diferente de nulo hacemos lo siguiente

					foreach ($restaurant->consulta as $key => $values) { // Recorremos los resultados y lo almacenamos en '$values'

						$tag->output('<li>De '.$restaurant->getNameById($values['day_week_start']).' a '.$restaurant->getNameById($values['day_week_finish']).' de '.$values['time_start'].' a '.$values['time_finish'].'</li><br/>');	
							
					}
							
				}else{ // Si el restaurante aún no ha asociado horarios lo hacemos saber
							
					$tag->output('No ha definido horarios del restaurante.');
							
				}

				$tag->closeTag('div');
				
				$input->addInput('button','linea','Acceder a la sección de horarios',array('id'=>'linea','placeholder'=>'','class'=>'btn','size'=>16,'onclick'=>"javascript:location.href='admin_schedules/add_schedules.php';")); // Botón que nos permitirá ir a la sección de horarios

			$tag->closeTag('div');

			$tag->openTag('div','','detalles_negocio_gallery','');

				$tag->openTag('h1','','','');
				$tag->output('Galeria de Imagenes');
				$tag->closeTag('h1');
					
				$input->addInput('button','linea','Acceder a la galeria de imagenes',array('id'=>'linea','placeholder'=>'','class'=>'btn','size'=>16,'onclick'=>"javascript:location.href='admin_images/add_image.php';")); // Botón que nos permitirá ir a la sección de imagenes

			$tag->closeTag('div');

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