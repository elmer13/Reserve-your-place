<?php
	
	include_once '../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 

	if(isset($_POST['speciality'])!=null){ // Comprobamos que recibimos este parámetro por POST

		foreach($_POST['speciality'] as $indice => $value) { // Aumentamos +1 a medida que recorremos la variable
			
				$restaurant->addRestaurantSpeciality($value+1,$restaurant_id); // Añadimos la especialidad al restaurante
				header('location:add_restaurant.php');
			
		}

	}else{ // En caso contrario redirigimos a la Página Principal

		header('location: add_restaurant.php');

	}

?>