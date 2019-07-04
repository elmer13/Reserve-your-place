<?php
		
	// Este fichero valida el Registro del Acceso al usuario

	if(isset($_POST['submit2'])){ // Comprobamos que se haya recibido la variable POST del 'submit'

		$name     = trim($_POST['name']);
		$surnames = trim($_POST['surnames']);
		$email    = trim($_POST['email']);
		$username = trim($_POST['username2']);
		$password = trim($_POST['password2']);
		
		// Validamos los campos requeridos del formulario
			
		if(!$user->validaEmail($email)){ // Validamos que '$email' contenga los parametros del email

			$error[1] = 'Por favor, introduzca un correo válido';

		}

		if($user->getUserByEmail($email) === true){ // Verificamos que el email no este registrado anteriormente
			
			$error[1] = 'El correo ya existe.';
		
		}else{
			
			if($user->getUserByName($username) === true){ // Verificamos que el usuario no este registrado anteriormente
				
				$error[1] = 'El nombre de usuario ya existe';
			
			}
			
			if(!ctype_alnum($username) || !ctype_alnum($password)){ // Nos aseguramos que el usuario y la contraseña contenga solo carácteres alfanuméricos
			
				$error[1] = 'Por favor, introduzca un usuario y una contraseña con carácteres alfanuméricos';	
			}

			if(strlen($username) <5 || strlen($password) <5 ){ // El usuario y la contraseña no pueden tener menos de 5 carácteres
			
					$error[1] = 'El usuario y la contraseña deben ser igual o superior a 5 carácteres, sin espacios';
			
			}else if(strlen($username) >12 || strlen($password) >12){ // El usuario y la contraseña no pueden tener más de 12 carácteres
			
					$error[1] = 'El usuario y la contraseña deben ser igual o inferior a 12 carácteres, sin espacios.';
			
			}
			
		}
	
		if(empty($error[1]) === true){ // Si no hay errores, llamamos a un método 'setUser' enviando las diferentes variables recibidas por POST
			
			if($user->setUser(array("name"=>$name, "surnames"=>$surnames, "username"=>$username, "password"=>$password, "email"=>$email))==true){
	
			include_once 'send_email_activation_user.php'; // Enviamos al usuario un email de activación de cuenta
		
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