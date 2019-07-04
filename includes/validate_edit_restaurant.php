<?php
	
	// Este fichero valida la actualización de los datos recibidos desde la parte del administrador del restaurante

	if(isset($_POST['submit'])){ // Comprueba que se haya presionado un submit a la hora de enviar los datos 
		
		// Almacenamos en diferentes variables los datos recibidos

		$name        = trim($_POST['name']);
		$description = trim($_POST['description']);
		$location    = addslashes(trim($_POST['location']));
		$zipcode     = trim($_POST['zipcode']);
		$city        = trim($_POST['city']);	
		$capacity    = trim($_POST['capacity']);
		$parking     = trim($_POST['parking']);	

		// Validamos los campos requeridos del formulario

		if(isset($zipcode) && !empty ($zipcode)){ // Comprobamos que la variable '$zipcode' existe y que sea diferente de vacio
					
			if(!preg_match('/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/', $zipcode)){ // Utilizamos una expresión regular para validar el código postal (entre otras cosas que sean 5 numeros)
				
					$errors[] = 'Ingrese un código postal válido!';
			
			}	

		}

		if(isset($capacity) && !empty ($capacity)){ // Comprueba que la variable '$capacity' existe y que sea diferente de vacio
			
			if(ctype_digit($capacity) === false){	// Por supuesto la capacidad tiene que ser numérico
				
				$errors[] = 'Por favor, introduzca su capacidad con valores numéricos';
			
			}	

		}			

	
		if(empty($errors) === true){  // Si no ha habido errores hasta este punto actualizamos los datos del usuario correctamente

			$restaurant->editRestaurant(array('name'=>$name,'description'=>$description,'location'=>$location,'zipcode'=>$zipcode, 'city'=>$city, 'capacity'=>$capacity,'parking'=>$parking,'cif_restaurant'=>$restaurant_id));
				
			header('location: add_restaurant.php'); // Redireccionamos a la información del restaurante
				
		}
	}

?>