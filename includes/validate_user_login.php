<?php

	// Este fichero valida el Login del Acceso al usuario

	if(isset($_POST['submit1'])){ // Comprueba que se haya presionado un submit a la hora de enviar los datos 

		// Almacenamos en diferentes variables los datos recibidos

		$username = htmlentities(trim($_POST['username']));
		$password = htmlentities(trim($_POST['password1']));

		// Validamos los campos requeridos del formulario

		if(empty($username) === true || empty($password) === true){ // Comprobamos que las variables '$username'  o '$password' sean diferente de vacio

			$error[0] = 'Lo sentimos, pero necesitamos su nombre de usuario y password.';

		}else if($user->getUserByName($username) === false){ // // Invocamos al método para comprobar la existencia del usuario

			$error[0] = 'El nombre de usuario no existe';

		} else if($user->email_confirmed($username) === false){ // Verificamos que haya activado su cuenta via email

			$error[0] = 'Lo sentimos, pero es necesario activar su cuenta. Por favor, consulte su correo electrónico.';

		} else {

			if(strlen($password) < 5){ // La contraseña no puede tener menos de 5 carácteres

				$error[0] = 'La contraseña debe ser superior a 5 caracteres, sin espacios.';

			}

			if(strlen($password) > 12){ // La contraseña no puede tener más de 12 carácteres

				$error[0] = 'La contraseña debe ser inferior a 12 caracteres, sin espacios.';
			}

			$login = $user->login($username, $password); // Una vez se ha llegado a este punto llamamos al método Login 

			if($login === false){ // Si el metodo Login nos retorna falso lo hacemos saber 

				$error[0] = 'Lo sentimos, la contraseña no corresponde con el usuario';
			}

			if(empty($error[0]) === true){ // En caso de que nos hayamos logueado correctamente y no haya errores el login nos retornara nuestra ID

				session_regenerate_id(true); //Destruimos la vieja sesion id y creamos una nueva

				$_SESSION['id_user'] =  $login; // Almacenamos la ID en una variable de sesión 

				header('Location: user/profile.php'); // Redireccionamos al Portal de usuarios

				exit();

			}
		}
	}
?>