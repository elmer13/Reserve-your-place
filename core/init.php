<?php 
	// Incluimos las diferentes clases 
	error_reporting(0);
	include_once 'classes/user.php';
	include_once 'classes/bcrypt.php';
	include_once 'classes/sesion.php';
	include_once 'classes/HtmlForm.php';
	include_once 'classes/tags.php';
	include_once 'classes/restaurant.php';
	include_once 'classes/HtmlEnlace.php';
	include_once 'classes/class.phpmailer.php';
	include_once 'classes/class.smtp.php';
	include_once 'classes/SimpleImage.class.php';

	// Instanciamos cada una de las clases que necesitaremos 
	$user = new User();   
	$mi_sesion = new Sesion();
	$bcrypt 	= new Bcrypt(12);
	$errors = array();
	@$form = new HtmlForm();
	@$input = new HtmlForm();
	@$tag = new Tag();
	$menu = new HtmlEnlace();
	$enlace = new HtmlEnlace();
	$restaurant = new Restaurant();
	$obj_simpleimage = new SimpleImage(); 

	// Sesión de usuario

	if($mi_sesion->getValor('id_user')==TRUE){  // Siempre y cuando la sesión sea la del usuario
	$user_id 	= $_SESSION['id_user']; // Guardamos la id de sesión en la variable '$user_id'
	$user->getUserById($user_id); // Buscamos la información del usuario mediante la id de sesión
		foreach($user->consulta[0] as $key=>$values){ // Recorremos el array
				$userData[$key] = $values; // Guardamos el valor en un array, de manera que haciendo $userData['campo'] obtendriamos el valor de un campo determinado
		}
	}

	// Sesión del restaurante

	if($mi_sesion->getValor('id_restaurant')==TRUE){  // Siempre y cuando la sesión sea la del restaurante
	$restaurant_id 	= $_SESSION['id_restaurant']; // Guardamos la id de sesión en la variable '$restaurant_id'
	$restaurant->getRestaurantByCif($restaurant_id); // Buscamos la información del usuario mediante la id de sesión
		foreach($restaurant->consulta[0] as $key=>$values){ // Recorremos el array 
				$restaurantData[$key] = $values; // Guardamos el valor en un array, de manera que haciendo $restaurantData['campo'] obtendriamos el valor de un campo determinado
		}
	}

	// Array de errores

	foreach($errors as $key=>$values){
	$error[$key]=$values;
	}
?>