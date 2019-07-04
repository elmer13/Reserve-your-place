<?php

	// Se comprueba que el usuario pulsa el botón de confirmar reserva
	if(isset($_POST['confirm_reserve'])){
	
		//Recogemos la información de la reserva que es necesaria para registrar
		$cif_restaurant = trim($_POST['cif_restaurant']);
		$date = trim($_POST['date']);
		$time = trim($_POST['time']);
		$number_people = trim($_POST['number_people']);
		$description = trim($_POST['description']);
		$username = trim($_POST['user']);
		$password = trim($_POST['password']);
		$id_table = '';
		
		//Controlamos si el usuario introducido existe en la base de datos
		if(!$user->getUserByName($username)){

			$errors[] = 'El usuario no existe en la base de datos.';		
		}
			
		//Comprobamos que hay mesas con la cantidad de personas que ha solicitado el usuario
		if($restaurant->getCountTableByNumberPeople($number_people) < 0){

			$errors[] = 'La cantidad de personas para la mesa ha de ser mayor que 0.';	
		}
			
		//Comprobamos las mesas con estas caracteristicas
		$restaurant->getTableRestaurantByNumberPeople($cif_restaurant,$number_people);


		//Recorremos el array de numeros de mesa con X numero de personas
		if(isset($restaurant->consulta)!=null){
			
			foreach ($restaurant->consulta as $key => $value) {
				//Comprobamos si la fecha y la hora y la mesa existen en reservas.
				if(!$user->isTableReservated(array('date'=>$date,'time'=>$time,'id_table'=>$value['id_table']))){
				
					$id_table = $value['id_table'];

				}else{ //En caso contrario mostramos mensaje de error de que no existe ninguna
					$errors[] = 'No hay mesas disponibles con los datos solicitados';
				}
			}
		}
	
			
		if(empty($errors) === true) { // Si no ha habido errores hasta este punto actualizamos los datos del usuario correctamente
					
			//Añadimos los datos para crear la reserva
			$user->addReservation(array("cif_restaurant"=>$cif_restaurant, "date"=>$date,"time"=>$time,"number_people"=>$number_people,"description"=>$description));
				
			//Recogemos la id del usuario con el username solicitado.
			$id_user = $user->getIdUserByUserName($username);
				
			//Con la información de la ID_Reserva, ID_User y ID_Table, pasamos a añadir los dos ultimos parametros a la tabla
			//TotalReservation
				$user->addTotalReservation($id_user,$id_table);
				
				header('Location: reserve_ok.php'); // Redireccionamos a la pantalla de reserva ok

				exit();	
		}
		
	}
	else if(isset($_POST['cancel_reserve'])){
		header('Location: index.php'); // Redireccionamos a la pantalla de index

		exit();	
	}

?>