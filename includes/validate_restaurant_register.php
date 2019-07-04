<?php
	
	// Este fichero valida el Registro del Acceso al restaurante

	if(isset($_POST['submit2'])){ // Comprueba que se haya presionado un submit a la hora de enviar los datos 

		// Almacenamos en diferentes variables los datos recibidos
		
		$email          = trim($_POST['email']);
		$cif_restaurant = trim($_POST['cif_restaurant2']);
		$password       = trim($_POST['password2']);

		// Validamos los campos requeridos del formulario
			
		if(!$restaurant->validaEmail($email)){ // Validamos que '$email' contenga los parametros del email

			$error[1] = 'Por favor, introduzca un correo válido';

		}

		if(!$restaurant->validaCif($cif_restaurant)){ // Validamos que '$cif_restaurant' tenga las carácteristicas de un CIF

			$error[1] = 'Por favor, introduzca un CIF válido';

		}

		if($restaurant->getRestaurantByEmail($email) === true){ // Verificamos que el email no este registrado anteriormente
		
			$error[1] = 'El correo ya existe.';
			
		}else{
				
			if($restaurant->getRestaurantByCif($cif_restaurant) === true){ // Verificamos que el cif no este registrado anteriormente
					
				$error[1] = 'El CIF del restaurante ya existe';
			
			}
				
			if(!ctype_alnum($password)){ // Comprobamos que la contraseña solo tenga caracteres alfanuméricos
				
				$error[1] = 'Por favor, introduzca una contraseña con carácteres alfanuméricos';	
			
			}
				
			if(strlen($password) <5 ){  // La contraseña no puede tener menos de 5 carácteres

				
				$error[1] = 'La contraseña debe ser igual o superior a 5 carácteres, sin espacios.';
			
			}else if(strlen($password) >12){ // La contraseña no puede tener más de 12 carácteres
				
				$error[1] = 'La contraseña debe ser igual o inferior a 12 carácteres, sin espacios.';
			
			}
		}

		if(empty($error[1]) === true){ // Si no hay errores, llamamos al método 'setRestaurant' enviando las diferentes variables recibidas por POST

			if($restaurant->setRestaurant(array('cif_restaurant'=>$cif_restaurant, 'password'=>$password, 'email'=>$email))==true){ 

				include_once 'send_email_activation_restaurant.php'; // Enviamos al propietario del restaurante un email de activación de cuenta
		
				if(!$exito){ // Si el email no ha sido enviado correctamente lo hacemos saber
					
					$tag->output('Problemas enviando correo electrónico');
					$tag->output('<br>'.$mail->ErrorInfo);

				}else{ // Si el email ha sido correctamente enviado 

					$success[] = 'Gracias por registrarse. Por favor, consulte su correo electrónico.';

				}
			}	
		}
	}
?>