<?php

	include_once 'core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if(!$mi_sesion->getValor('id_user')==TRUE){ // Controlamos que la sesión sea distinta a la del usuario
	
	if(!$mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea distinta a la del administrador del restaurante*/
		
		require_once 'includes/validate_reserve.php'; //Incluimos fichero para comprobar que la reserva es correcta
		
		if(isset($_POST['add-reserve'])){
			$fecha_actual = date('Y-m-d');
			$fecha_anual = date('2014-12-31');
			if($_POST['date'] < $fecha_actual){
				$cif = base64_encode($_POST['cif']); 
				header('Location: reserve.php?cif='.$cif.'&error1');
			}
			if( $_POST['date'] > $fecha_anual){
				$cif = base64_encode($_POST['cif']); 
				header('Location: reserve.php?cif='.$cif.'&error2');
			}
			if(isset($_POST['number_people'])){
				if(ctype_digit($_POST['number_people']) === false){	// Por supuesto el numero de personas tiene que ser numérico
					$cif = base64_encode($_POST['cif']); 
					header('Location: reserve.php?cif='.$cif.'&error3');
				
				}
			}			
			/*else if(isset($_POST['time'])){
				$restaurant->getTimeSchedulesByCif($_POST['cif']);
				if(isset($restaurant->consulta)!=null){
					foreach ($restaurant->consulta as $key => $value) {
						if($_POST['time'] < $value['time_start'] || $_POST['time'] > $value['time_finish']){
							$cif = base64_encode($_POST['cif']);
							header('Location: reserve.php?cif='.$cif.'&error3');
						}
					}
				}
			}*/
			/*else if(isset($_POST['number_people'])){
				if($restaurant->getTablesByNumberPeople($_POST['cif'],$_POST['number_people']) > 0){
					if($restaurant->getTablesReservationsByNumberPeople($_POST['cif'],$_POST['number_people']) > 0){
						$cif = base64_encode($_POST['cif']); 
						header('Location: reserve.php?cif='.$cif.'&error3');
					}
				}
				else{
					$cif = base64_encode($_POST['cif']); 
					header('Location: reserve.php?cif='.$cif.'&error4');
				}
			}*/
		}
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
	<title>Confirmar Reserva - Reserve your place</title>
</head>
<body>
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
		$tag->openTag('div','contenedor','margen',''); // '$tag' es el objeto instanciado de la clase que nos permite crear elementos html como divs, label, echo, etc

		$tag->openTag('h2','','','');
			$tag->output('Confirmación de Reserva');
		$tag->closeTag('h2');

		$tag->openTag('br/','','','');

		$tag->openTag('div','','add-content-info','');

			$tag->openTag('p','','','');
				$tag->output('Los datos de tu reserva son los siguientes:');
			$tag->closeTag('p');

			$tag->openTag('br/','','','');

			// Formulario donde mostramos y  a la vez enviamos los datos de la reserva

			$tag->openTag('div','','informacion_negocio','');

				$form->startForm('','POST','', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 

					$tag->openTag('p','','','');
						$tag->output('Restaurante: '.$restaurant->getRestaurantNameByCif($_POST['cif']));
						$input->addInput('hidden','cif_restaurant',$_POST['cif'],array('id'=>'','class'=>''));
					$tag->closeTag('p');

					$tag->openTag('p','','','');
						$tag->output('Fecha: '.$_POST['date']);
						$input->addInput('hidden','date',$_POST['date'],array('id'=>'','class'=>''));
					$tag->closeTag('p');

					$tag->openTag('p','','','');
						$tag->output('Hora: '.$_POST['time']);
						$input->addInput('hidden','time',$_POST['time'],array('id'=>'','class'=>''));
					$tag->closeTag('p');

					$tag->openTag('p','','','');
						$tag->output('Número de Personas: '.$_POST['number_people']);
						$input->addInput('hidden','number_people',$_POST['number_people'],array('id'=>'','class'=>''));
					$tag->closeTag('p');

					$tag->openTag('p','','','');
						$tag->output('Descripción: '.$_POST['description']);
						$input->addInput('hidden','description',$_POST['description'],array('id'=>'','class'=>''));
					$tag->closeTag('p');

					$tag->openTag('br/','','','');

					$tag->openTag('p','','','');
						$tag->openTag('b','','','');
							$tag->output('Recuerda que puedes cancelarla con 24 horas de antelación ');
							$tag->output('es necesario que inicies sesión para terminar de confirmar la reserva.');
						$tag->closeTag('b');
					$tag->closeTag('p');

					// Formulario de Inicio de sesión

					$tag->openTag('div','','line','');						
						$tag->openTag('label','','',array('for'=>'user')); 
							$tag->output('Usuario: '); 
						$tag->closeTag('label');						
						$input->addInput('text','user','',array('id'=>'user','placeholder'=>'Usuario','class'=>'infor','size'=>14, 'readonly'=>'','required'=>'required'));
					$tag->closeTag('div');

					$tag->openTag('div','','line','');						
						$tag->openTag('label','','',array('for'=>'password')); 
							$tag->output('Contraseña: '); 
						$tag->closeTag('label');						
						$input->addInput('password','password','',array('id'=>'password','placeholder'=>'Contraseña','class'=>'infor','size'=>14, 'readonly'=>'','required'=>'required'));
					$tag->closeTag('div');

					$tag->openTag('div','','button-align-left','');
						$input->addInput('submit','confirm_reserve','Confirmar',array('id'=>'confirm_reserve','placeholder'=>'','class'=>'btn_left btn','size'=>16));
						$input->addInput('submit','cancel_reserve','Cancelar',array('id'=>'confirm_reserve','placeholder'=>'','class'=>'btn_left btn','size'=>16));
					$tag->closeTag('div');

				$form->endForm(); // Cierre de formulario

			$tag->closeTag('div');

			$tag->openTag('br/','','','');

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
    }else{ // Si el administrador ha iniciado sesión le redireccionamos al portal de administración del restaurante
        header('location: admin/home.php');
    }
    }else{ // Si el usuario ha iniciado sesión le redireccionamos al portal de usuarios
        header('location: user/profile.php');
    }
?>