<?php

	include_once 'core/init.php'; // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if(!$mi_sesion->getValor('id_user')==TRUE){ // Controlamos que la sesión sea distinta a la del usuario
	
	if(!$mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea distinta a la del administrador del restaurante
		
	if (isset($_GET['cif']) === true) { // Si se ha recibido un valor por GET como parametro
		
		$cif = base64_decode($_GET['cif']);  // Desencriptamos el parámetro recibido por get en este caso el CIF del restaurante

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
	<title>Reserva - Reserve your place</title>
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

		$tag->openTag('div','contenedor','margen',''); // '$tag' es el objeto instanciado de la clase que nos permite crear elementos html como divs, label, echo, etc
			
		$tag->openTag('h2','','','');
			$tag->output('Crear reserva');
		$tag->closeTag('h2');
			
		$tag->openTag('p','','','');
			$tag->output('Vas a realizar una reserva en el siguiente restaurante: <strong>'.$restaurant->getRestaurantNameByCif($cif).'</strong>.');
		$tag->closeTag('p');
			
		$tag->openTag('div','','informacion_negocio','');
		
			$form->startForm('confirm_reserve.php','POST','', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 

				$tag->openTag('div','','none-line','');						
					$tag->openTag('label','','',array('for'=>'cif')); 
						$tag->output('CIF Restaurant: '); 
					$tag->closeTag('label');
					$input->addInput('text','cif',$cif,array('id'=>'cif','placeholder'=>'','class'=>'infor','size'=>16, 'readonly'=>'','required'=>'required'));
				$tag->closeTag('div');

				$tag->openTag('div','','line','');						
					$tag->openTag('label','','',array('for'=>'date')); 
						$tag->output('Fecha de Reserva: '); 
					$tag->closeTag('label');						
					$input->addInput('date','date','',array('id'=>'date','placeholder'=>'','class'=>'infor','size'=>14, 'readonly'=>'','required'=>'required'));
				$tag->closeTag('div');

				$tag->openTag('div','','line','');
					$tag->openTag('label','','',array('for'=>'time')); 
						$tag->output('Hora: '); 
					$tag->closeTag('label');						
					$input->addInput('time','time','00:00:00',array('id'=>'time','placeholder'=>'','class'=>'infor','size'=>16, 'required'=>'required','step'=>1800));
				$tag->closeTag('div');

				$tag->openTag('div','','line','');						
					$tag->openTag('label','','',array('for'=>'number_people')); 
						$tag->output('Número de Personas: '); 
					$tag->closeTag('label');						
					$input->addInput('text','number_people','',array('id'=>'number_people','placeholder'=>'Número de Personas','class'=>'infor','size'=>14, 'readonly'=>'','required'=>'required'));
				$tag->closeTag('div');

				$tag->openTag('div','','line','');
					$tag->openTag('label','','',array('for'=>'description')); 
						$tag->output('Descripción: '); 
					$tag->closeTag('label');	
					$form->addTextarea('description',5,39,'',array('class'=>'textarea', 'maxlength'=>100,'placeholder'=>'Añadir una descripción'));
					$form->closeTextarea();
				$tag->closeTag('div');

				$tag->openTag('div','','button-align-left','');
					$input->addInput('submit','add-reserve','Reservar',array('id'=>'submit','class'=>'btn'));
				$tag->closeTag('div');

				$form->endForm();
				
				if(isset($_GET['error1'])){
					$error1 = '<p>La fecha tiene que ser superior a la actual</p>';
					$tag->openTag('div','','line','');
						$tag->output($error1);
					$tag->closeTag('div');
				}
				else if(isset($_GET['error2'])){
					$error2 = '<p>Solamente hay disponibles fechas para el presente año</p>';
					$tag->openTag('div','','line','');
						$tag->output($error2);
					$tag->closeTag('div');
				}
				else if(isset($_GET['error3'])){
					$error2 = '<p>El número de personas tiene qu ser un valor numérico</p>';
					$tag->openTag('div','','line','');
						$tag->output($error2);
					$tag->closeTag('div');
				}
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