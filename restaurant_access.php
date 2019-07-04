<?php
	
	include_once 'core/init.php'; // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if(!$mi_sesion->getValor('id_user')==TRUE){ // Controlamos que la sesión sea distinta a la del usuario
	
	if(!$mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea distinta a la del administrador del restaurante
	
	require_once 'includes/validate_restaurant_login.php'; // Incluimos el fichero que validará el Login del restaurante
	
	require_once 'includes/validate_restaurant_register.php'; // Incluimos el fichero que validará el Registro del restaurante

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
	<title>Acceso-Restaurantes - Reserve your place</title>
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

				$tag->openTag('div','','item2_seleccionado','');
					$tag->openTag('img','','',array('src'=>'site_media/img/home.png','width'=>'30','height'=>'30'));
					$tag->closeTag('img');
					$tag->openTag('a','','',array('href'=>'restaurant_access.php')); // Creamos un enlace para que el cliente pueda ver el carrito
						$tag->output('Acceso Restaurantes');
					$tag->closeTag('a');
				$tag->closeTag('div');

				$tag->openTag('div','','item2','');
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
		$tag->output('Ven con tu negocio aquí');
		$tag->closeTag('h2');
		
		$tag->openTag('div','ventana2','','');

			$tag->openTag('div','','titulo','');
				$tag->openTag('h2','','','');
				$tag->output('Ya tienes cuenta?');
				$tag->closeTag('h2');
			$tag->closeTag('div');

			// Mostramos el formulario de Login del restaurante con los campos requeridos

			$tag->openTag('div','','formulario','');

				$form->startForm('','POST','loginRestaurant', array('name'=>'loginRestaurant','class'=>'','enctype'=>'', 'onsubmit'=>'')); // Abrimos el formulario

					$tag->openTag('label','','',array('for'=>'username1'));
					?>
					CIF (<span id='req-cif_restaurant1' class='requisites <?php echo $cif_restaurant1 ?>'>Ingrese un CIF válido, Ex: A12345678</span>):
					<?php
					$tag->closeTag('label');
					$input->addInput('text','cif_restaurant1','',array('id'=>'cif_restaurant1','placeholder'=>'','class'=>'text','size'=>20, 'required'=>'required'));

					$tag->openTag('label','','',array('for'=>'password1'));
					?>
					Password (<span id='req-password1' class='requisites <?php echo $password1 ?>'>Carácteres: Mín. 5, Máx. 12, Alfanuméricos</span>):
					<?php
					$tag->closeTag('label');
					$input->addInput('password','password1','',array('id'=>'password1','placeholder'=>'','class'=>'text','size'=>20, 'required'=>'required'));

					$tag->openTag('a','','',array('href'=>'admin/confirm_recover.php'));
						$tag->output('¿Olvidaste tu Contraseña?');
					$tag->closeTag('a');

					$tag->openTag('div','','','');
					$input->addInput('submit','submit1','Entrar',array('class'=>'submit'));
					$tag->closeTag('div');

					if(empty($error[0]) === false){  // En caso de loguearnos sin exito mediante el array '$error[0]' nos mostrará el error correspondiente 

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

			// Mostramos el formulario de Registro del restaurante con los campos requeridos

			$tag->openTag('div','','formulario','');

			$form->startForm('','POST','registerRestaurant', array('name'=>'registerRestaurant','class'=>'','enctype'=>'', 'onsubmit'=>'')); // Abrimos el formulario
				
				$tag->openTag('label','','',array('for'=>'cif_restaurant2'));
				?>
				CIF (<span id='req-cif_restaurant2' class='requisites <?php echo $cif_restaurant2 ?>'>Ingrese un CIF válido, Ex: A12345678</span>):
				<?php
				$tag->closeTag('label');
				$input->addInput('text','cif_restaurant2','',array('id'=>'cif_restaurant2','placeholder'=>'','class'=>'text','size'=>20, 'required'=>'required'));


				$tag->openTag('label','','',array('for'=>'email'));
				?>
				E-mail (<span id='req-email' class='requisites <?php echo $email ?>'>Ingrese un e-mail válido por favor</span>):
				<?php
				$tag->closeTag('label');		
				$input->addInput('text','email','',array('id'=>'email','placeholder'=>'','class'=>'text','size'=>20, 'required'=>'required'));


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
				
			if(empty($error[1]) === false){ // En caso de registrarnos sin exito mediante el array '$error[1]' nos mostrará el error correspondiente 

				$tag->output('<p>' . implode('</p><p>', $error) . '</p>');	

			}

			if(empty($success) === false){ // Si  se ha registrado correctamente le indicamos al usuario 

				$tag->output('<p>' . implode('</p><p>', $success) . '</p>');	

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