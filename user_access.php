<?php
	
	include_once 'core/init.php'; // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if(!$mi_sesion->getValor('id_user')==TRUE){ // Controlamos que la sesión sea distinta a la del usuario
	
	if(!$mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea distinta a la del administrador del restaurante

	require_once 'includes/validate_user_login.php'; // Incluimos el fichero que validará el Login del usuario

	require_once 'includes/validate_user_register.php'; // Incluimos el fichero que validará el Registro del usuario

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
	<meta name='description' content='Plataforma de reserva de mesas para restaurantes'>
	<meta name='keywords' content='plataforma, reserva, mesas, restaurante'>
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
	<link rel='stylesheet' type='text/css' href='site_media/css/style.css'/>
	<link rel='shortcut icon' href='site_media/img/favicon.ico'/>
	<script type='text/javascript' src='site_media/js/jquery-1.11.0.min.js'></script> 
	<script type='text/javascript' src='site_media/js/validate.js'></script>	
	<script type='text/javascript' src='site_media/js/scrollTop.js'></script>
	<script type='text/javascript' src='site_media/js/btn_movil.js'></script>
	<title>Acceso Usuarios - Reserve your place</title>
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

			$tag->openTag('div','','item','');
				$tag->openTag('img','','',array('src'=>'site_media/img/home.png','width'=>'30','height'=>'30'));
				$tag->closeTag('img');
				$tag->openTag('a','','',array('href'=>'restaurant_access.php')); // Creamos un enlace para que el cliente pueda ver el carrito
					$tag->output('Acceso Restaurantes');
				$tag->closeTag('a');
			$tag->closeTag('div');

			$tag->openTag('div','','item_seleccionado','');
				$tag->openTag('img','','',array('src'=>'site_media/img/members.png','width'=>'30','height'=>'30'));
				$tag->closeTag('img');
				$tag->openTag('a','','',array('href'=>'user_access.php')); // Creamos un enlace para que el cliente pueda ver el carrito
					$tag->output('Acceso Usuarios');
				$tag->closeTag('a');

			$tag->closeTag('div');
			
			$tag->closeTag('ul');
			
		$tag->closeTag('div');
		
		// Cuerpo de la página
		$tag->openTag('div','contenedor','',''); 

		$tag->openTag('h2','','','');
		$tag->output('Entra en nuestro portal');
		$tag->closeTag('h2');
		
		$tag->openTag('div','ventana2','','');

			$tag->openTag('div','','titulo','');
				$tag->openTag('h2','','','');
				$tag->output('Ya tienes cuenta?');
				$tag->closeTag('h2');
			$tag->closeTag('div');

			// Mostramos el formulario de Login del usuario con los campos requeridos

			$tag->openTag('div','','formulario','');

				$form->startForm('','POST','loginUser', array('name'=>'loginUser','class'=>'','enctype'=>'', 'onsubmit'=>'')); // Abrimos el formulario

					$tag->openTag('label','','',array('for'=>'username'));
					?>
					Usuario (<span id='req-username' class='requisites <?php echo $username ?>'>Carácteres: Mín 5, Máx. 12, A-z</span>):
					<?php
					$tag->closeTag('label');
					$input->addInput('text','username','',array('id'=>'username','placeholder'=>'','class'=>'text','size'=>20, 'required'=>'required'));

					$tag->openTag('label','','',array('for'=>'password1'));
					?>
					Password (<span id='req-password1' class='requisites <?php echo $password1 ?>'>Carácteres: Mín. 5, Máx. 12, Alfanuméricos</span>):
					<?php
					$tag->closeTag('label');
					$input->addInput('password','password1','',array('id'=>'password1','placeholder'=>'','class'=>'text','size'=>20, 'required'=>'required'));

					$tag->openTag('a','','',array('href'=>'user/confirm_recover.php'));
						$tag->output('¿Olvidaste tu Contraseña?');
					$tag->closeTag('a');


					$tag->openTag('div','','','');
					$input->addInput('submit','submit1','Entrar',array('class'=>'submit'));
					$tag->closeTag('div');
			
					if(empty($error[0]) === false){ // En caso de loguearnos sin exito mediante el array '$error[0]' nos mostrará el error correspondiente 
						echo '<p>' . implode('</p><p>', $error) . '</p>';	
					}
				$form->endForm(); // Cerramos el formulario

			$tag->closeTag('div');
			

		$tag->closeTag('div');

		
		$tag->openTag('div','ventana','','');

			$tag->openTag('div','','titulo','');
				$tag->openTag('h2','','','');
				$tag->output('Aún no te has registrado?');
				$tag->closeTag('h2');
			$tag->closeTag('div');

			// Mostramos el formulario de Registro del usuario con los campos requeridos

			$tag->openTag('div','','formulario','');
				
			$form->startForm('','POST','registerUser', array('name'=>'registerUser','class'=>'','enctype'=>'', 'onsubmit'=>'')); // Abrimos el formulario

				$tag->openTag('label','','',array('for'=>'name'));
				?>
				Nombre (<span id='req-name' class='requisites <?php echo $name ?>'>Introduzca su nombre, A-z</span>):
				<?php
				$tag->closeTag('label');
				$input->addInput('text','name','',array('id'=>'name','placeholder'=>'','class'=>'text','size'=>20, 'required'=>'required'));


				$tag->openTag('label','','',array('for'=>'surnames'));
				?>
				Apellidos (<span id='req-surnames' class='requisites <?php echo $surnames ?>'>Introduzca su nombre, A-z</span>):
				<?php
				$tag->closeTag('label');
				$input->addInput('text','surnames','',array('id'=>'surnames','placeholder'=>'','class'=>'text','size'=>20, 'required'=>'required'));


				$tag->openTag('label','','',array('for'=>'email'));
				?>
				E-mail (<span id='req-email' class='requisites <?php echo $email ?>'>Un e-mail válido por favor</span>):
				<?php
				$tag->closeTag('label');		
				$input->addInput('text','email','',array('id'=>'email','placeholder'=>'','class'=>'text','size'=>20, 'required'=>'required'));


				$tag->openTag('label','','',array('for'=>'username2'));
				?>
				Usuario (<span id='req-username2' class='requisites <?php echo $username2 ?>'>Carácteres: Mín 5, Máx. 12, A-z</span>):
				<?php
				$tag->closeTag('label');
				$input->addInput('text','username2','',array('id'=>'username2','placeholder'=>'','class'=>'text','size'=>20, 'required'=>'required'));


				$tag->openTag('label','','',array('for'=>'password2'));
				?>
				Password (<span id='req-password2' class='requisites <?php echo $password2 ?>'>Carácteres: Mín. 5, Máx. 12, Alfanuméricos</span>):
				<?php
				$tag->closeTag('label');
				$input->addInput('password','password2','',array('id'=>'password2','placeholder'=>'','class'=>'text','size'=>20, 'required'=>'required'));	


				$tag->openTag('div','','','');
				$input->addInput('submit','submit2','Registrarse',array('class'=>'submit'));
				$tag->closeTag('div');
				
				$form->endForm(); // Cerramos el formulario
				
				if(empty($error[1]) === false){

					$tag->output('<p>' . implode('</p><p>', $error) . '</p>');	// En caso de Registrarnos sin exito mediante el array '$error[1]' nos mostrará el error correspondiente 

				}

				if(empty($success) === false){

					$tag->output('<p>' . implode('</p><p>', $success) . '</p>');	// Si  se ha registrado correctamente le indicamos al usuario 

				}
				
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
    }else{ // Si el administrador ha iniciado sesión le redireccionamos al portal de administración del restaurante
        header('location: admin/home.php');
    }
    }else{ // Si el usuario ha iniciado sesión le redireccionamos al portal de usuarios
        header('location: user/profile.php');
    }
?>