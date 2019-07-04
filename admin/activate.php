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
	<title>Activación - Portal de Administración</title>
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
		$tag->output('Activación de tu cuenta');
		$tag->closeTag('h2');
		
		if (isset ($_GET['email'], $_GET['email_code']) === true) {  // Cogemos los diferentes parametros recibidos por GET
            
            // Las almacenamos en sus respectivas variables
            $email		=trim($_GET['email']);
            $email_code	=trim($_GET['email_code']);	
            
			if($restaurant->getRestaurantByEmail($email) === false) {  // Comprobamos si el email pertenece a un administrador del restaurante previamente registrado

                $errors[] = 'Lo sentimos, pero no hemos podido encontrar la dirección de correo.';

            } else if ($restaurant->activate($email, $email_code) === false) { // Llamamos al método que se encargará de activar la cuenta a medida que comprobamos que no haya surgido algún problema

                $errors[] = 'Lo sentimos, no hemos logrado activar tu cuenta.';

            }

			if(empty($errors) === false){  // Si ha surgido un imprevisto lo notificamos
			
				echo '<p>' . implode('</p><p>', $errors) . ' Usted sera redirigido al inicio de sesión, o si gusta presione directamente <a href="../restaurant_access.php">aquí</a>.</p>';	
		
			}else{  // De lo contrario redireccionamos a la página de inicio de sesión 
				
				echo '<h3>Gracias, hemos activado su cuenta. Usted sera redirigido al inicio de sesión, o si gusta presione directamente <a href="../restaurant_access.php">aquí</a>.</h3><br/>';

            }
        	echo "<script type='text/javascript'>timer()</script>";  // Script para redireccionar en un tiempo determinado
			$tag->openTag('div','contador','','');
			$tag->closeTag('div');

        }else{
            header('Location: ../index.php'); // Si los parámetros necesarios no se encuentran en la Url redirigir al index.
            exit();
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