<?php
	
	include_once '../core/init.php'; // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 

	if(!$mi_sesion->getValor('id_user')==TRUE){ // Verificamos que el usuario haya iniciado sesion
	
	if(!$mi_sesion->getValor('id_restaurant')==TRUE){ // Verificamos que el usuario haya iniciado sesion

?>

<!DOCTYPE>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
	<meta name='description' content='Plataforma de reserva de mesas para restaurantes'>
	<meta name='keywords' content='plataforma, reserva, mesas, restaurante'>
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
	<link rel='shortcut icon' href='../site_media/img/favicon.ico'/>
	<link rel='stylesheet' type='text/css' href='../site_media/css/style.css'/>
	<script type='text/javascript' src='resources/js/timer.js'></script>
	<title>Confirmar Recuperación - Portal de Administración</title>
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
		// Cuerpo de la página
		$tag->openTag('div','contenedor','','');

		$tag->openTag('h2','','','');
		$tag->output('Recuperar Contraseña');
		$tag->closeTag('h2');

		$tag->openTag('p','','','');
		$tag->output('Ingrese su email a continuación para que podamos confirmar su solicitud.');
		$tag->closeTag('p');

		$tag->output('<hr/>');

			// Formulario de introducción del email para recuperar su contraseña correspondiente
			$form->startForm('','POST','loginUser', array('name'=>'','class'=>'','enctype'=>'', 'onsubmit'=>'')); // Abrimos el formulario
						
				$tag->openTag('label','','',array('for'=>'email'));
				$tag->output('Email: ');
				$tag->closeTag('label');
				$input->addInput('text','email','',array('id'=>'email','placeholder'=>'','class'=>'','size'=>50, 'required'=>'required'));

				$tag->openTag('div','','','');
				$input->addInput('submit','','Recuperar',array('class'=>'submit'));
				$tag->closeTag('div');

			$form->endForm(); // Cerramos el formulario

		if (isset($_POST['email']) === true && empty($_POST['email']) === false) { // Comprobamos que el dato recibido por POST sea diferente de vacio

			if ($restaurant->getRestaurantByEmail($_POST['email']) === true){ // Posteriormente comprobamos si el email pertenece a un administrador de restaurante previamente registrado

				$restaurant->confirm_recover($_POST['email']); // Por último llamamos al método para confirmar la recuperación de contraseña

				include_once '../includes/send_email_recover_password_restaurant.php'; // Enviamos el email de confirmación al administrador del restaurante

				echo '<h3>Gracias, por favor revise su correo electrónico para confirmar su solicitud de una password.</h3><br/>';

			} else {  // Si ha surgido un imprevisto lo notificamos

				echo 'Lo sentimos, pero no existe ese correo electrónico.<br/>';

			}
        		echo "<script type='text/javascript'>timer()</script>"; // Script para redireccionar en un tiempo determinado
				$tag->openTag('div','contador','','');
				$tag->closeTag('div');
			}       	

       	$tag->closeTag('div');
	?>
</body>
</html>

<?php
	}else{ // Si el administrador ha iniciado sesión le redireccionamos al portal de administración del restaurante
		header('location: home.php');
	}
	}else{ // Si el usuario ha iniciado sesión le redireccionamos al portal de usuarios
		header('location: ../user/profile.php');
	}
?>