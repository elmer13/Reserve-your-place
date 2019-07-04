<?php

	include_once '../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 

	if($mi_sesion->getValor('id_user')==TRUE){ // Controlamos que la sesión sea la del usuario
	
	require_once '../includes/validate_edit_user_profile.php'; // Incluimos el fichero que validará las modificaciones de los datos del usuario

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
	<title>Información - Portal del Usuario</title>
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

			$menu->cargarEnlace('profile.php','Información','','selected');
			$menu->cargarEnlace('reserve.php','Mis reservas','','');
			$menu->cargarEnlace('comments.php','Mis Comentarios','','');
			$menu->mostrarHorizontal();	

			$tag->openTag('ul','','','');
			include_once '../includes/menu_top.php'; // Incluimos diferentes enlaces dependiendo si el usuario ha iniciado sesión en el cliente, portal de usuario o portal de administración
			$tag->closeTag('ul');

		$tag->closeTag('div');

		// Cuerpo de la página
		$tag->openTag('div','contenedor','',''); 

		$tag->openTag('h2','','','');
		$tag->output('Mi Perfil');
		$tag->closeTag('h2');

		$tag->openTag('p','','','');
			$tag->openTag('b','','','');
				$tag->output('Nota: La información que usted publique aquí estará asignada a su reserva.');
			$tag->closeTag('b');
		$tag->closeTag('p');

			// Mostramos el formulario con los datos personales del usuario, por supuesto también los puede modificar

			$tag->openTag('div','','informacion_negocio','');

				$form->startForm('','POST','', array('name'=>'','class'=>'','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario

				$tag->openTag('div','','line','');						
				$tag->openTag('label','','',array('for'=>'username')); 
				$tag->output('Usuario: '); 
				$tag->closeTag('label');						
				$input->addInput('text','username',''.@$userData['username'].'',array('id'=>'username','placeholder'=>'','class'=>'infor','size'=>25, 'readonly'=>'readonly','required'=>'required'));
				$tag->closeTag('div');

				$tag->openTag('div','','line','');						
				$tag->openTag('label','','',array('for'=>'name'));	
				$tag->output('Nombre: ');
				$tag->closeTag('label');			
				$input->addInput('text','name',''.@$userData['name'].'',array('id'=>'name','placeholder'=>'','class'=>'infor','size'=>25,  'required'=>'required'));
				$tag->closeTag('div');	

				$tag->openTag('div','','line','');						
				$tag->openTag('label','','',array('for'=>'surnames'));	
				$tag->output('Apellidos: ');
				$tag->closeTag('label');			
				$input->addInput('text','surnames',''.@$userData['surnames'].'',array('id'=>'surnames','placeholder'=>'','class'=>'infor','size'=>25,  'required'=>'required'));
				$tag->closeTag('div');	


				$tag->openTag('div','','line','');						
				$tag->openTag('label','','',array('for'=>'gender'));	
				$tag->output('Sexo: ');
				$tag->closeTag('label');			
				$sexo 	= @$userData['gender'];
				$values = array('Seleccione una opción', 'Hombre', 'Mujer');				
				$form->addSelect('gender', $values,0,$sexo);
				$tag->closeTag('div');	

				$tag->openTag('div','','line','');						
				$tag->openTag('label','','',array('for'=>'location'));	
				$tag->output('Dirección: ');
				$tag->closeTag('label');			
				$input->addInput('text','location',''.@$userData['location'].'',array('id'=>'location','placeholder'=>'','class'=>'infor','size'=>25,  'required'=>'required'));
				$tag->closeTag('div');	
			
				$tag->openTag('div','','line','');						
				$tag->openTag('label','','',array('for'=>'zipcode'));	
				$tag->output('Código Postal: ');
				$tag->closeTag('label');			
				$input->addInput('text','zipcode',''.@$userData['zipcode'].'',array('id'=>'zipcode','placeholder'=>'','class'=>'infor','size'=>25,  'required'=>'required'));
				$tag->closeTag('div');	

				$tag->openTag('div','','line','');						
				$tag->openTag('label','','',array('for'=>'city'));	
				$tag->output('Ciudad: ');
				$tag->closeTag('label');			
				$input->addInput('text','city',''.@$userData['city'].'',array('id'=>'city','placeholder'=>'','class'=>'infor','size'=>25,  'required'=>'required'));
				$tag->closeTag('div');	

				$tag->output('<br/>');
				
				// En caso de no introducir correctamente los datos del formulario mostramos el error
				if(empty($errors) === false){
					echo '<p>' . implode('</p><p>', $errors) . '</p>';	
				}

				$tag->openTag('div','','line','');	
				$tag->openTag('a','','',array('href'=>'../includes/change_password_user.php')); // Creamos un enlace para que el cliente pueda ver el carrito
					$tag->output('Cambiar Contraseña');
				$tag->closeTag('a');
				$tag->closeTag('div');

				$tag->openTag('div','','button-align-left','');
				$tag->output('&nbsp;&nbsp;');
					$input->addInput('submit','submit','Confirmar',array('id'=>'submit','class'=>'btn'));
				$tag->closeTag('div');

				$form->endForm(); // Cerramos el formulario

				$tag->output('<br/>');
					
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