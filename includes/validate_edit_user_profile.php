<?php
	
	// Este fichero valida la actualización de los datos personales recibidos desde la parte del usuario

  	if(empty($_POST) === false){ // Comprueba que los datos recibidos por POST no sean vacios
			
		// Almacenamos en diferentes variables los datos recibidos
							
		$name 		= trim($_POST['name']); 
		$surnames 	= trim($_POST['surnames']);	
		$gender		= trim($_POST['gender']);
		$location 	= trim($_POST['location']);
		$zipcode	= trim($_POST['zipcode']);	
		$city 		= trim($_POST['city']);	

		// Validamos los campos requeridos del formulario

		if(isset($name) && !empty ($name)){ // Comprobamos que la variable '$name' existe y que sea diferente de vacio

			if(!preg_match('/^([a-z ñáéíóú]{2,60})$/i', $name)){ // Utilizamos una expresión regular para validar el nombre (entre otras cosas que no contenga caracteres desde la a-z)

				$errors[] = 'Ingrese un nombre válido';

			}

		}

		
		if(isset($surnames) && !empty ($surnames)){ // Comprobamos que la variable '$name' existe y que sea diferente de vacio

			if(!preg_match('/^([a-z ñáéíóú]{2,60})$/i', $surnames)){ // Utilizamos una expresión regular para validar el apellido (entre otras cosas que no contenga caracteres desde la a-z)

				$errors[] = 'Ingrese un apellido válido';

			}

		}
				
		
		if(isset($gender) && !empty($gender)){ // Comprobamos que la variable '$gender' existe y que sea diferente de vacio
					
			$allowed_sexo = array('Seleccione una opción','Hombre','Mujer'); // Creamos un array con las diferentes opciones del gender 
					
			$gender = $allowed_sexo[$gender]; // Segun el tipo de genero le asignamos un valor del array '$allowed_sexo' y lo guardamos en una variable

		}

		
		if(isset($zipcode) && !empty ($zipcode)){ // Comprobamos que la variable '$zipcode' existe y que sea diferente de vacio

			if(!preg_match('/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', $zipcode)){ // Utilizamos una expresión regular para validar el código postal (entre otras cosas que sean 5 numeros)

				$errors[] = 'Ingrese un código postal válido!';

			}

		}


		if(empty($errors) === true) { // Si no ha habido errores hasta este punto actualizamos los datos del usuario correctamente
					
			$user->updateUser(array('name'=>$name , 'surnames'=>$surnames, 'gender'=>$gender, 'location'=>$location, 'zipcode'=>$zipcode, 'city'=>$city,'id_user'=>$user_id));

			header('Location: profile.php'); // Redireccionamos a la información del usuario

			exit();
				
		}
            
	}
			
?>