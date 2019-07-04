<?php

	// Se comprueba que el usuario pulsa el botón de confirmar reserva
	if(isset($_POST['add-comment'])){
	
		//Recogemos la información de la reserva que es necesaria para registrar
		$cif_restaurant = trim($_POST['cif_restaurant']);
		$id_user = trim($_POST['id_user']);
		$date = date('Y-m-d');
		$time = date('H:i:s');
		$validates = array('1'=>$_POST['input-1'],'2'=>$_POST['input-2'],'3'=>$_POST['input-3'],'4'=>$_POST['input-4'],'5'=>$_POST['input-5'],'6'=>$_POST['input-6']);
		$description = trim($_POST['description']);
		$count_raitings = 0;
		
		//Realizamos la formula para conseguir la nota media
		foreach($validates as $value){
			$count_raitings = $count_raitings + $value;
		}
		$average_raiting = $count_raitings/6;
		
		//Añadimos los datos recibidos a la base de datos
		$user->addRaiting(array('cif_restaurant'=>$cif_restaurant,'id_user'=>$id_user,'date'=>$date,'time'=>$time,'description'=>$description,'note'=>$average_raiting));
		
		//Recorremos el array de tipos de raiting para añadir las notas a su id_raiting.
		foreach($validates as $key => $values){
			$user->addRatingNotes($key,$values);	
		}
		
		header("Location: ../comments.php");
	}

?>