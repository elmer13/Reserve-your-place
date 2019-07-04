<?php
	include_once 'DBAbstractModel.php'; // Importar modelo de abstracción de base de datos

	class Restaurant extends DBAbstractModel{
	    // Atributos de la clase
		protected $email;
		public $cif_restaurant;
		public $password;
		public $email_code;
		public $propiedad;

		public function getSpecialityOfRestaurant() {
				$this->query = "
				SELECT *
				FROM speciality
				";
				$this->getResultsFromQuery();
		}
		
		// Traer datos de un cliente por el email
		public function getRestaurantByEmail($email='') {
			if($email != '') {
				$this->query = "
				SELECT *
				FROM restaurant
				WHERE email = '$email'
				";
				$this->getResultsFromQuery();
			}
			if(count($this->consulta) == 1) {
				foreach ($this->consulta as $propiedad=>$valor) {
					$this->propiedad = $valor;
				}
				return true;
			} else {
				return false;
			}
		}
		
		// Traer datos del cliente mediante su nombre
		public function getRestaurantByCif($nombre='') {
		if($nombre != '') {
		$this->query = "
		SELECT *
		FROM restaurant
		WHERE cif_restaurant = '$nombre'
		";
		$this->getResultsFromQuery();
		}
			if(count($this->consulta) == 1) {
				foreach ($this->consulta as $propiedad=>$valor) {
					$this->propiedad = $valor;

				}
				return true;
			} else {
				return false;
			}
		}

		
		// Crear un nuevo usuario
		public function setRestaurant($restaurant_data=array()){
			if(array_key_exists('email', $restaurant_data)) {
				if(!$this->getRestaurantByEmail($restaurant_data['email'])){
					foreach ($restaurant_data as $propiedad=>$valor) {
						$$propiedad = $valor;
					}
					global $bcrypt; // making the $bcrypt variable global so we can use here

					$email_code = $email_code = uniqid('code_',true); // Creating a unique string.
					$password   = $bcrypt->genHash($password);
					
					$this->query = "
					INSERT INTO restaurant
					(cif_restaurant, password, email, email_code)
					VALUES
					('$cif_restaurant', '$password', '$email', '$email_code')
					";
					try{
					$this->ejecutarConsulta();

					}catch(PDOException $e){
						die($e->getMessage());
					}	
						return true;
				}
					return false;
			}
		}

		public function editRestaurant($restaurant_data=array()) {
			foreach ($restaurant_data as $propiedad=>$valor) {
				$$propiedad = $valor;
				
			}
			$this->query = "
			UPDATE restaurant
			SET name='$name',
			description='$description',
			location='$location',
			zipcode='$zipcode',
			city='$city',
			capacity='$capacity',
			parking='$parking'
			WHERE cif_restaurant = '$cif_restaurant'
			";
			$this->ejecutarConsulta();
		}
		
	public function getRestaurantNameByCif($cif_restaurant){
		unset($this->consulta);
		$this->query = "
		SELECT name
		FROM restaurant
		WHERE cif_restaurant = '$cif_restaurant' 
		";
		$this->getResultsFromQuery();
		foreach ($this->consulta as $key => $value) {
					$name=$value["name"];
				}
			return $name;
	}
		
	public function getRestaurantEmailCode($email){
		if($email != '') {
		$this->query = "
		SELECT email_code
		FROM restaurant
		WHERE email = '$email' 
		";
		}		
		
		$this->getResultsFromQuery();
	}

	public function getRestaurantGeneratedString($email){
		if($email != '') {
		$this->query = "
		SELECT generated_string
		FROM restaurant
		WHERE email = '$email' 
		";
		}		
		
		$this->getResultsFromQuery();
	}

	public function updateRestaurantGeneratedString($id_restaurant){
         $this->query = "
         UPDATE restaurant
         SET generated_string = 0
         WHERE cif_restaurant = '$id_restaurant'
        ";
                        
        $this->ejecutarConsulta();
    }

	public function activate($email, $email_code) {
		if($email != '' ) {
		$this->query = "
		SELECT COUNT(cif_restaurant)
		FROM restaurant
		WHERE email = '$email' AND email_code = '$email_code' AND confirmed = 0
		";	
		}
		
		try{
		$this->getResultsFromQuery();
		foreach($this->consulta[1] as $key=>$values){
			$propiedad[$key] = $values;
		}
		if($propiedad[$key]==1){
			$this->query = "
			UPDATE restaurant
			SET confirmed= 1
			WHERE email = '$email'
			";
				$this->ejecutarConsulta();
				return true;
			}else{
				return false;
			}
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function validaEmail($valor){
		if(filter_var($valor, FILTER_VALIDATE_EMAIL) === FALSE){
			return false;
		}else{
			return true;
		}
	}
	
	public function validaCif($valor){
	$patron1 = '/(^[A-Z]{1}[0-9]{8}$)/';
	if (preg_match($patron1, $valor)) {
			return true;
		}else{
			return false;
		}
	}

	public function email_confirmed($usuario='') {
		if($usuario != '') {
		$this->query = "
		SELECT COUNT(cif_restaurant)
		FROM restaurant
		WHERE cif_restaurant = '$usuario' AND confirmed = 1
		";
		}
		try{
		$this->getResultsFromQuery();
		foreach($this->consulta[1] as $key=>$values){
			$propiedad[$key] = $values;
		}
		if($propiedad[$key]==1){
			return true;
		}else{
			return false;
		}

		} catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function login($usuario, $password) {

		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called
		if($usuario != '') {
		$this->query = "
		SELECT password,cif_restaurant
		FROM restaurant
		WHERE cif_restaurant = '$usuario' 
		";
		}		
		try{
		$this->getResultsFromQuery();
		foreach($this->consulta[2] as $key=>$values){
			$propiedad[$key] = $values;
		}

			$stored_password  = $propiedad['password']; // stored hashed password
			$id   				= $propiedad['cif_restaurant']; // id of the restaurant to be returned if the password is verified, below.
			
			if($bcrypt->verify($password, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
				return $id;	// returning the restaurant's id.
			}else{
				return false;	
			}
		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}

	public function recover($email, $generated_string) {

		if($generated_string == 0){
			return false;
		}else{
			$this->query = "
			SELECT COUNT(cif_restaurant)
			FROM restaurant
			WHERE email = '$email' AND generated_string = '$generated_string'
			";
		try{
			$this->getResultsFromQuery();
			foreach($this->consulta[1] as $key=>$values){
				$propiedad[$key] = $values;
			}
			if($propiedad[$key]==1){
					
					return true;
				}else{
					return false;
				}

			} catch(PDOException $e){
				die($e->getMessage());
			}
		}
	}
	
	public function change_password($id_restaurant, $password) {

		global $bcrypt;

		/* Two create a Hash you do */
		$password_hash = $bcrypt->genHash($password);
		$this->query = "
		UPDATE restaurant
		SET password = '$password_hash'
		WHERE cif_restaurant = '$id_restaurant'
		";	

		try{
			$this->ejecutarConsulta();		
			return true;
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}
	
	public function confirm_recover($email){
		$this->getRestaurantByEmail($email);
		foreach($this->consulta[1] as $key=>$values){
			$propiedad[$key] = $values;
		}

		$unique = uniqid('',true);
		$random = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0, 10);
		
		$generated_string = $unique . $random; // a random and unique string
		
		$this->query = "
			UPDATE restaurant
			SET generated_string = '$generated_string'
			WHERE email = '$email'
		";

		try{
			
			$this->ejecutarConsulta();

			//mail($email, 'Recover Password', "Hello,\r\nPlease click the link below:\r\n\r\nhttp://blooming.hol.es/recover.php?email=" . $email . "&generated_string=" . $generated_string . "\r\n\r\n We will generate a new password for you and send it back to your email.\r\n\r\n-- Example team");			
			
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}

		// Reasignación del nombre de la imagen al agregar articulo permitiendo asi que no haya problemas en caso de tener el mismo nombre
		public function file_newpath($path, $filename){
			if ($pos = strrpos($filename, '.')) {
			   $name = substr($filename, 0, $pos);
			   $ext = substr($filename, $pos);
			} else {
			   $name = $filename;
			}
			
			$newpath = $path.'/'.$filename;
			$newname = $filename;
			$counter = 0;
			
			while (file_exists($newpath)) {
			   $newname = $name .'_'. $counter . $ext;
			   $newpath = $path.'/'.$newname;
			   $counter++;
			}	
			return $newpath;
		}

		// Crear un nuevo articulo
		public function setImage($restaurant_data=array()){
					foreach ($restaurant_data as $propiedad=>$valor) {
						$$propiedad = $valor;
					}
					$this->query = "
					INSERT INTO gallery_images
					(cif_restaurant, src, featured_image, position)
					VALUES
					('$cif_restaurant', '$src', '$featured_image','$position')
					";
					$this->ejecutarConsulta();
			
		}

		// Crear un nuevo articulo
		public function updateImage($restaurant_data=array()){
			foreach ($restaurant_data as $propiedad=>$valor) {
				$$propiedad = $valor;
			}
			$this->query = "
			UPDATE gallery_images
			SET src = '$src'
			WHERE cif_restaurant='$cif_restaurant' AND featured_image='$featured_image'
			";
			$this->ejecutarConsulta();
		}
					
		// Crear un nuevo articulo
		public function updateImageById($restaurant_data=array()){
		
			foreach ($restaurant_data as $propiedad=>$valor) {
				$$propiedad = $valor;
			}
			$this->query = "
			UPDATE gallery_images
			SET src = '$src'
			WHERE cif_restaurant='$cif_restaurant' AND id_image='$id_image' AND featured_image=0
			";
			$this->ejecutarConsulta();
		}
					
		// Traer datos de articulos de la categoria correspondiente por ID
		public function getImagesByCif($cif_restaurant='') {
			unset($this->consulta);
			if($cif_restaurant != '') {
				$this->query = "
				SELECT *
				FROM gallery_images
				WHERE cif_restaurant= '$cif_restaurant' AND featured_image=0
				ORDER BY position ASC
				";
				$this->getResultsFromQuery();
			}
		}

		public function getCountImagesByCif($cif_restaurant='') {
			unset($this->consulta);
			if($cif_restaurant != '') {
				$this->query = "
				SELECT *
				FROM gallery_images
				WHERE cif_restaurant= '$cif_restaurant' AND featured_image=0
				";
				$this->getResultsFromQuery();
			}
			if(count($this->consulta) <= 4) {
				return true;
			}
			return false;
		}

		// Traer datos de articulos de la categoria correspondiente por ID
		public function getFeaturedImageByCif($cif_restaurant='') {
			unset($this->consulta);
			if($cif_restaurant != '') {
				$this->query = "
				SELECT *
				FROM gallery_images
				WHERE cif_restaurant= '$cif_restaurant' AND featured_image=1
				LIMIT 1
				";
				$this->getResultsFromQuery();
			}
		}

		// Traer datos de articulos de la categoria correspondiente por ID
		public function getImageById($id_image='') {
			unset($this->consulta);
			if($id_image != '') {
				$this->query = "
				SELECT *
				FROM gallery_images
				WHERE id_image= '$id_image' AND featured_image=0
				LIMIT 1
				";
				$this->getResultsFromQuery();
			}
		}		

		public function updatePositionImages($restaurant_data=array()) {
			foreach ($restaurant_data as $propiedad=>$valor) {
				$$propiedad = $valor;
			}
			$this->query = "
			UPDATE gallery_images
			SET position='$position'
			WHERE id_image = '$id_image' LIMIT 1
			";
			$this->ejecutarConsulta();
		}

		public function deleteImageRestaurant($id_image=''){
			if(($id_image!='')){
			$this->query = "
			DELETE FROM gallery_images
			WHERE id_image='$id_image'
			";
			$this->ejecutarConsulta();
			return true;
			}else{
			return false;	
			}	
		}
		
		/********* TRANSPORT **********/

		public function addTransport($restaurant_data=array()){
					foreach ($restaurant_data as $propiedad=>$valor) {
						$$propiedad = $valor;
					}
					$this->query = "
					INSERT INTO transport
					(type_transport, linea, station)
					VALUES
					('$type_transport', '$linea', '$station')
					";
					$this->ejecutarConsulta();
			
		}
		
				// Retorna el id de pedido más reciente
		public function getIdTransport() {
			$this->query = "
			SELECT id_transport
			FROM transport
			order by id_transport desc limit 1
			";
			$this->getResultsFromQuery();
		}
		
		public function addRestaurantTransport($cif_restaurant){
			$this->getIdTransport();	
			foreach($this->consulta as $propiedad=>$valor){
				$this->propiedad = $valor;
			}
			$id_transport= $this->propiedad["id_transport"];
					$this->query = "
					INSERT INTO restaurant_transport
					(cif_restaurant, id_transport)
					VALUES
					('$cif_restaurant','$id_transport');
					";
					$this->ejecutarConsulta();
			
		}

		public function addRestaurantSpeciality($speciality,$cif_restaurant){

					$this->query = "
					INSERT INTO speciality_restaurants
					(cif_restaurant, speciality)
					VALUES
					('$cif_restaurant','$speciality');
					";
					$this->ejecutarConsulta();
			
		}

		public function getRestaurantSpecialityByCif($cif_restaurant){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM speciality_restaurants a, speciality b
			WHERE a.speciality=b.id_speciality AND a.cif_restaurant='$cif_restaurant'
			";
			$this->getResultsFromQuery();			
		}

		public function getRestaurantSpecialityRoundByCif($cif_restaurant){
			unset($this->consulta);
			$this->query = "
			SELECT name
			FROM speciality_restaurants a, speciality b
			WHERE a.speciality=b.id_speciality AND a.cif_restaurant='$cif_restaurant'
			ORDER BY rand() LIMIT 1;
			";
			$this->getResultsFromQuery();		
			
			if(isset($this->consulta)!=null){
				foreach ($this->consulta as $key => $value) {				
					$valor=$value["name"];
				}
				return $valor;
			}
		}		

		public function getRestaurantTransportByCif($id_restaurant) {
			unset($this->consulta);
				$this->query = "
				SELECT *
				FROM restaurant_transport a, transport b, type_transport c
				WHERE a.id_transport= b.id_transport AND b.type_transport=c.id_type_transport AND a.cif_restaurant='$id_restaurant'
				";
				$this->getResultsFromQuery();
			
		}

		public function editTransport($restaurant_data=array()){
					foreach ($restaurant_data as $propiedad=>$valor) {
						$$propiedad = $valor;
					}
				$this->query = "
			UPDATE transport
			SET type_transport='$type_transport',
			linea = '$linea',
			station ='$station'
			WHERE id_transport='$id_transport'
			";
			$this->ejecutarConsulta();
			
		}


		
		public function getIdTypeTransportByName($name){
			unset($this->consulta);
				$this->query = "
				SELECT id_type_transport
				FROM type_transport
				WHERE name= '$name'
				LIMIT 1
				";
				$this->getResultsFromQuery();
		}
		
		public function getRestaurantTransportById($id_transport) {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM restaurant_transport a, transport b, type_transport c
			WHERE a.id_transport ='$id_transport' AND b.id_transport= a.id_transport AND b.type_transport=c.id_type_transport
			";
			$this->getResultsFromQuery();
		}



		public function deleteRestaurantTransport($id_transport='',$id_restaurant=''){
			if(($id_transport!='') AND ($id_restaurant!='')){
			$this->query = "
			DELETE FROM restaurant_transport
			WHERE cif_restaurant = '$id_restaurant' AND id_transport='$id_transport'
			";
			$this->ejecutarConsulta();
			return true;
			}else{
			return false;	
			}	
		}

		public function deleteTransport($id_transport=''){
			if(($id_transport!='')){
			$this->query = "
			DELETE FROM transport
			WHERE id_transport='$id_transport'
			";
			$this->ejecutarConsulta();
			return true;
			}else{
			return false;	
			}	
		}
		/********* SCHEDULES **********/

		public function addSchedules($restaurant_data=array()){
					foreach ($restaurant_data as $propiedad=>$valor) {
						$$propiedad = $valor;
					}
					$this->query = "
					INSERT INTO schedules
					(day_week_start, day_week_finish, time_start, time_finish)
					VALUES
					('$day_week_start', '$day_week_finish', '$time_start', '$time_finish')
					";
					$this->ejecutarConsulta();
			
		}
		
				// Retorna el id de pedido más reciente
		public function getIdSchedules() {
			$this->query = "
			SELECT id_schedule
			FROM schedules
			order by id_schedule desc limit 1
			";
			$this->getResultsFromQuery();
		}
		
		public function addRestaurantSchedules($cif_restaurant){
			$this->getIdSchedules();
			foreach($this->consulta as $propiedad=>$valor){
				$this->propiedad = $valor;
			}
			$id_schedule= $this->propiedad["id_schedule"];
					$this->query = "
					INSERT INTO schedule_restaurants
					(cif_restaurant, id_schedule)
					VALUES
					('$cif_restaurant','$id_schedule');
					";
					$this->ejecutarConsulta();
			
		}

		public function getRestaurantSchedulesByCif($id_restaurant) {
			unset($this->consulta);
				$this->query = "
				SELECT *
				FROM schedule_restaurants a, schedules b, type_day_week c
				WHERE a.id_schedule=b.id_schedule AND b.day_week_start=c.id_day_week AND a.cif_restaurant='$id_restaurant'
				";
				$this->getResultsFromQuery();
			
		}

		public function editSchedules($restaurant_data=array()){
			
					foreach ($restaurant_data as $propiedad=>$valor) {
						$$propiedad = $valor;
					}
				$this->query = "
			UPDATE schedules
			SET day_week_start='$day_week_start',
			day_week_finish = '$day_week_finish',
			time_start ='$time_start',
			time_finish ='$time_finish'
			WHERE id_schedule='$id_schedule'
			";
			$this->ejecutarConsulta();
			
		}


		public function getRestaurantSchedulesById($id_schedule) {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM schedule_restaurants a, schedules b, type_day_week c
			WHERE a.id_schedule ='$id_schedule' AND b.id_schedule= a.id_schedule AND b.day_week_start=c.id_day_week
			";
			$this->getResultsFromQuery();
		}

		public function getNameById($id){
				unset($this->consulta);
				$this->query = "
				SELECT name
				FROM type_day_week
				WHERE id_day_week='$id'
				LIMIT 1
				";
				$this->getResultsFromQuery();
		foreach ($this->consulta as $key => $value) {
			$name=$value["name"];
		}
		return $name;
		}


		public function deleteRestaurantSchedules($id_schedule='',$id_restaurant=''){
			if(($id_schedule!='') AND ($id_restaurant!='')){
			$this->query = "
			DELETE FROM schedule_restaurants
			WHERE cif_restaurant = '$id_restaurant' AND id_schedule='$id_schedule'
			";
			$this->ejecutarConsulta();
			return true;
			}else{
			return false;	
			}	
		}

		public function deleteSchedules($id_schedule=''){
			if(($id_schedule!='')){
			$this->query = "
			DELETE FROM schedules
			WHERE id_schedule='$id_schedule'
			";
			$this->ejecutarConsulta();
			return true;
			}else{
			return false;	
			}	
		}
		
		public function getTimeSchedulesByCif($cif_restaurant){
			unset($this->consulta);
			$this->query= "
			SELECT s.time_start, s.time_finish
			FROM schedules s, schedule_restaurants sr
			WHERE s.id_schedule = sr.id_schedule AND sr.cif_restaurant = 'L12345678'
			";
			$this->getResultsFromQuery();
		}

		/********* TABLES RESTAURANT **********/
		
		public function getIdTableRestaurant() {
			$this->query = "
			SELECT id_table
			FROM tables_restaurant
			order by id_table desc limit 1
			";
			$this->getResultsFromQuery();
		}
		
		public function addTableRestaurant($restaurant_data=array()){
			foreach($restaurant_data as $propiedad=>$valor){
				$$propiedad = $valor;
			}
			$this->query = "
				INSERT INTO tables_restaurant
				(cif_restaurant,name,number_people)
				VALUES
				('$cif_restaurant','$number_table',$number_people)";
			$this->ejecutarConsulta();
		}
		
		public function getNameNumberPeopleByCif($cif_restaurant, $date, $time){
			unset($this->consulta);
			$this->query = "
			SELECT tre.id_table, u.name, r.number_people
			FROM tables_restaurant tre, user u, reservations r, total_reservations tr 
			WHERE u.id_user = tr.id_user AND tr.id_reservation = r.id_reservation AND tr.id_table_restaurant = tre.id_table 
			AND r.date = '$date' AND r.time = '$time' AND tre.cif_restaurant = '$cif_restaurant'
			";
			$this->getResultsFromQuery();
		}
		
		public function getNameTableRestaurantById($id_table) {
			unset($this->consulta);
			$this->query = "
				SELECT name
				FROM tables_restaurant
				WHERE id_table = $id_table;
				";
				$this->getResultsFromQuery();
				foreach ($this->consulta as $key => $value) {				
					$name=$value["name"];
				}
				return $name;
		}
		
		public function getTableRestaurantsByCif($cif_restaurant) {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM tables_restaurant tr
			WHERE tr.cif_restaurant ='$cif_restaurant'
			";
			$this->getResultsFromQuery();
		}
		
		public function editTableRestaurant($restaurant_data=array()){
			foreach ($restaurant_data as $propiedad=>$valor) {
				$$propiedad = $valor;
			}
			$this->query = "
			UPDATE tables_restaurant
			SET name='$number_table',
			number_people = $number_people
			WHERE id_table='$id_table'
			";
			$this->ejecutarConsulta();
			
		}
		
		public function getTableRestaurantById($id_table) {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM tables_restaurant
			WHERE id_table='$id_table'
			";
			$this->getResultsFromQuery();
			
		}
		
		public function getTableRestaurantByNumberPeople($cif_restaurant, $number_people){
			unset($this->consulta);
				$this->query = "
				SELECT id_table
				FROM tables_restaurant tr, restaurant r
				WHERE tr.cif_restaurant = r.cif_restaurant AND tr.cif_restaurant = '$cif_restaurant' AND number_people= '$number_people';
				";
				$this->getResultsFromQuery();
				foreach ($this->consulta as $key => $value) {				
					$valor=$value["id_table"];
				}
				return $valor;
		}
		
		public function getCountTableByNumberPeople($number_people){
			unset($this->consulta);
				$this->query = "
				SELECT count(id_table) count_tables
				FROM tables_restaurant 
				WHERE number_people= '$number_people'
				";
				$this->getResultsFromQuery();
				foreach ($this->consulta as $key => $value) {				
					$count_tables=$value['count_tables'];
				}
				return $count_tables;
		}

		public function getSpecialityRestaurantById($id_speciality) {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM speciality_restaurants a, speciality b
			WHERE a.speciality= b.id_speciality AND a.speciality ='$id_speciality'
			LIMIT 1
			";
			$this->getResultsFromQuery();
			
		}
		

		public function deleteTableRestaurant($id_table) {
			if(($id_table!='')){
				$this->query = "
				DELETE FROM tables_restaurant
				WHERE id_table = '$id_table'
				";
				$this->ejecutarConsulta();
				return true;
			}else{
			return false;	
			}	
		}

		public function deleteSpecialityRestaurant($id_speciality) {
			if(($id_speciality!='')){
				$this->query = "
				DELETE FROM speciality_restaurants
				WHERE speciality = '$id_speciality'
				";
				$this->ejecutarConsulta();
				return true;
			}else{
			return false;	
			}	
		}
		
		public function getTablesByNumberPeople($cif_restaurant,$number_people){
			unset($this->query);
			$this->query = "
			SELECT count(id_table) countTables
			FROM tables_restaurant 
			WHERE number_people = '$number_people' AND cif_restaurant = '$cif_restaurant'
			";
			$this->getResultsFromQuery();
			foreach ($this->consulta as $key => $value) {				
				$count_tables=$value['countTables'];
			}
			return $count_tables;
		}
		
		public function getTablesReservationsByNumberPeople($cif_restaurant,$number_people){
			unset($this->query);
			$this->query = "
			SELECT count(tr.id_table) countIdTable
			FROM tables_restaurant tr, total_reservations trv
			WHERE tr.id_table = trv.id_table_restaurant AND number_people = '$number_people' AND cif_restaurant = '$cif_restaurant'
			";
			$this->getResultsFromQuery();
			foreach ($this->consulta as $key => $value) {				
				$count_tables=$value['countIdTable'];
			}
			return $count_tables;
		}
		
		/*** MENUS	***/
		
		public function addMenu($restaurant_data=array()){
			foreach($restaurant_data as $propiedad=>$valor){
				$$propiedad = $valor;
			}
			$this->query = "
				INSERT INTO menu
				(cif_restaurant,name,price,description)
				VALUES
				('$cif_restaurant','$name',$price,'$description')";
			$this->ejecutarConsulta();
		}
		
		public function getMenuByCif($cif_restaurant) {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM menu
			WHERE cif_restaurant ='$cif_restaurant'
			";
			$this->getResultsFromQuery();
		}
		
		public function editMenu($restaurant_data=array()){
			foreach ($restaurant_data as $propiedad=>$valor) {
				$$propiedad = $valor;
			}
			$this->query = "
			UPDATE menu
			SET name='$name',
			price = $price,
			description = '$description'
			WHERE id_menu= $id_menu
			";
			$this->ejecutarConsulta();
			
		}
		
		public function getMenuById($id_menu) {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM menu
			WHERE id_menu = $id_menu
			";
			$this->getResultsFromQuery();
			
		}
		
		public function deleteMenu($id_menu) {
			if(($id_menu!='')){
				$this->query = "
				DELETE FROM menu
				WHERE id_menu = '$id_menu'
				";
				$this->ejecutarConsulta();
				return true;
			}else{
			return false;	
			}	
		}
		
		public function getNameMenuById($id_menu) {
			unset($this->consulta);
			$this->query = "
			SELECT name
			FROM menu
			WHERE id_menu = '$id_menu'
			";
			$this->getResultsFromQuery();
			
			if(isset($this->consulta)!=null){
				foreach ($this->consulta as $key => $value) {				
					$valor=$value["name"];
				}
				return $valor;
			}			
			
		}
		
		public function getRestaurantsMenuCheap($cif_restaurant) {
			unset($this->consulta);
			$this->query = "
			SELECT a.price
			FROM menu a, restaurant b
			WHERE a.cif_restaurant = b.cif_restaurant AND a.cif_restaurant = '$cif_restaurant' 
			ORDER by a.price ASC LIMIT 1
			";
			$this->getResultsFromQuery();
			
			if(isset($this->consulta)!=null){
				foreach ($this->consulta as $key => $value) {				
					$valor=$value["price"];
				}
				return $valor;
			}			
			
		}
			
		public function getRestaurantsNote($cif_restaurant) {
			unset($this->consulta);
			$this->query = "
			SELECT a.note
			FROM ratings a, restaurant b
			WHERE a.cif_restaurant = b.cif_restaurant AND a.cif_restaurant = '$cif_restaurant' 
			";
			$this->getResultsFromQuery();
			
			if(isset($this->consulta)!=null){
				foreach ($this->consulta as $key => $value) {				
					$valor=$value["note"];
				}
				return $valor;
			}			
			
		}

		
		public function getMenuComplete($id_menu,$id_gourmet) {
			unset($this->consulta);
			$this->query = "
			SELECT name
			FROM menu
			WHERE id_menu = '$id_menu'
			";
			$this->getResultsFromQuery();
			foreach ($this->consulta as $key => $value) {
				$name=$value["name"];
			}
			return $name;
		}
		
		public function getCountsMenuByCif($cif_restaurant){
		
			unset($this->consulta);
				$this->query = "
				SELECT COUNT(id_menu) countR
				FROM menu
				WHERE cif_restaurant = '$cif_restaurant'
				";
				$this->getResultsFromQuery();
				foreach ($this->consulta as $key => $value) {
					$count_menu=$value["countR"];
				}
			return $count_menu;
		
		}
		
		public function getIdMenu() {
			$this->query = "
			SELECT id_menu
			FROM menu
			order by id_menu desc limit 1
			";
			$this->getResultsFromQuery();
			foreach ($this->consulta as $key => $value) {
					$id_menu=$value["id_menu"];
				}
			return $id_menu;
		}
		
		/********* MENU COMPLETE **********/
		
		public function getMenuCompleteByIdGourmet($id_menu,$id_gourmet) {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM menu_complete mc, gourmet g, menu m
			WHERE mc.id_menu = m.id_menu AND mc.id_gourmet = g.id_gourmet 
			AND mc.id_menu = $id_menu AND mc.id_gourmet = $id_gourmet
			";
			$this->getResultsFromQuery();
		}
		
		public function deleteMenuComplete($id_menu,$id_gourmet) {
			if(($id_menu!='')){
				$this->query = "
				DELETE FROM menu_complete
				WHERE id_menu = $id_menu AND id_gourmet = $id_gourmet
				";
				$this->ejecutarConsulta();
				return true;
			}else{
			return false;	
			}	
		}
		
		/********* GOURMET **********/
		
		public function addGourmet($restaurant_data=array()){
			foreach($restaurant_data as $propiedad=>$valor){
				$$propiedad = $valor;
			}
			$this->query = "
				INSERT INTO gourmet
				(cif_restaurant,type_gourmet,name_gourmet,price,description,recomendation)
				VALUES
				('$cif_restaurant',$type_gourmet,'$name',$price,'$description',$recomendation)";
			$this->ejecutarConsulta();
		}
		
		public function addGourmetToMenu($restaurant_data=array()){
			foreach($restaurant_data as $propiedad=>$valor){
				$$propiedad = $valor;
			}
			$this->query = "
				INSERT INTO menu_complete
				(id_menu,id_gourmet)
				VALUES
				($id_menu,$id_gourmet)";
			$this->ejecutarConsulta();
		}
		
		public function getGourmetByCif($cif_restaurant) {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM gourmet g
			WHERE cif_restaurant = '$cif_restaurant'
			";
			$this->getResultsFromQuery();
		}
		
		public function getGourmetByCifOrderByType($cif_restaurant) {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM gourmet g
			WHERE cif_restaurant = '$cif_restaurant'
			ORDER BY type_gourmet ASC
			";
			$this->getResultsFromQuery();
		}
		
		public function getNameByIdTypeGourmet($type_gourmet){
				unset($this->consulta);
				$this->query = "
				SELECT name
				FROM type_gourmet
				WHERE id_type_gourmet = '$type_gourmet'
				LIMIT 1
				";
				$this->getResultsFromQuery();
				foreach ($this->consulta as $key => $value) {
					$name=$value["name"];
				}
			return $name;
		}
		
		public function getCountsRecomendationGourmetByCif($cif_restaurant){
		
			unset($this->consulta);
				$this->query = "
				SELECT COUNT(recomendation) countR
				FROM gourmet
				WHERE recomendation = 1 AND cif_restaurant = '$cif_restaurant'
				LIMIT 5
				";
				$this->getResultsFromQuery();
				foreach ($this->consulta as $key => $value) {
					$count_recomendations=$value["countR"];
				}
			return $count_recomendations;
		
		}
		
		public function getGourmetRecomendationOkByCif($cif_restaurant){
		
			unset($this->consulta);
				$this->query = "
				SELECT *
				FROM gourmet
				WHERE recomendation = 1 AND cif_restaurant = '$cif_restaurant'
				";
				$this->getResultsFromQuery();
		
		}
		
		public function getGourmetsByIdTypeGourmet($cif_restaurant, $type_gourmet){
		
			unset($this->consulta);
				$this->query = "
				SELECT *
				FROM gourmet
				WHERE cif_restaurant = '$cif_restaurant' AND type_gourmet = '$type_gourmet'
				";
				$this->getResultsFromQuery();
		}
		
		public function editGourmet($restaurant_data=array()){
			foreach ($restaurant_data as $propiedad=>$valor) {
				$$propiedad = $valor;
			}
			$this->query = "
			UPDATE gourmet
			SET type_gourmet= $type_gourmet,
			name_gourmet = '$name',
			price = $price,
			description = '$description',
			recomendation = $recomendation
			WHERE id_gourmet = $id_gourmet
			";
			$this->ejecutarConsulta();
			
		}
		
		public function getGourmetTypeById($id_gourmet) {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM gourmet g, type_gourmet tg
			WHERE g.type_gourmet = tg.id_type_gourmet AND id_gourmet = '$id_gourmet'
			LIMIT 1
			";
			$this->getResultsFromQuery();
			
		}
		
		public function deleteGourmet($id_gourmet) {
			if(($id_gourmet!='')){
				$this->query = "
				DELETE FROM gourmet
				WHERE id_gourmet = '$id_gourmet'
				";
				$this->ejecutarConsulta();
				return true;
			}else{
			return false;	
			}	
		}
		
		public function getGourmetByIdMenu($id_menu) {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM gourmet g, menu_complete mc
			WHERE g.id_gourmet = mc.id_gourmet AND mc.id_menu = '$id_menu'
			";
			$this->getResultsFromQuery();
			
		}
		
		public function getCountsGourmetByCif($cif_restaurant){
		
			unset($this->consulta);
				$this->query = "
				SELECT COUNT(id_gourmet) countR
				FROM gourmet
				WHERE cif_restaurant = '$cif_restaurant'
				";
				$this->getResultsFromQuery();
				foreach ($this->consulta as $key => $value) {
					$count_gourmet=$value["countR"];
				}
			return $count_gourmet;
		
		}
		
		/*** RESERVATION ***/
		
		public function getReservationByCif($cif_restaurant) {
			unset($this->consulta);
			$this->query = "
			SELECT r.id_reservation, r.date, r.time, u.name name_user, trt.name, r.number_people, r.description
			FROM reservations r, tables_restaurant trt, total_reservations trv, user u
			WHERE r.id_reservation = trv.id_reservation AND trt.id_table = trv.id_table_restaurant AND u.id_user = trv.id_user AND
			r.cif_restaurant = '$cif_restaurant'
			";
			$this->getResultsFromQuery();
			
		}
		
		/*** COMMENTS ***/
		
		public function getCommentsByCif($cif_restaurant) {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM ratings r, user u
			WHERE r.id_user = u.id_user AND r.cif_restaurant = '$cif_restaurant'
			ORDER BY r.id_rating DESC
			";
			$this->getResultsFromQuery();
			
		}

		public function getCountCommentsByCif($cif_restaurant) {
			unset($this->consulta);
			$this->query = "
			SELECT count(r.description)
			FROM ratings r, user u
			WHERE r.id_user = u.id_user AND r.cif_restaurant = '$cif_restaurant'
			";
			$this->getResultsFromQuery();
			
		foreach ($this->consulta as $key=>$valor) {
			$valor= $valor['count(r.description)'];
		}
		return $valor;
		}

		public function getCountCommentsByUser($id_user) {

			unset($this->consulta);
			$this->query = "
			SELECT count(id_rating)
			FROM ratings r, user u
			WHERE r.id_user = u.id_user AND r.id_user= '$id_user'
			";
			$this->getResultsFromQuery();
			
		foreach ($this->consulta as $key=>$valor) {
			$valor= $valor['count(id_rating)'];
		}
		return $valor;
		}


		
		/*** DATOS ***/

		public function getRestaurants() {
				$this->query = "
				SELECT *
				FROM restaurant
				";
				$this->getResultsFromQuery();
		}

		public function getFeaturedImage($id_restaurant){
				unset($this->consulta);				
				$this->query = "
				SELECT src
				FROM gallery_images
				WHERE cif_restaurant='$id_restaurant' AND featured_image=1
				LIMIT 1
				";
				$this->getResultsFromQuery();
				if(isset($this->consulta)!=null){
				foreach ($this->consulta as $key => $value) {
					$src=$value["src"];
				}
				return $src;
				}else{
					return false;
				}

		}

		public function getSpeciality(){
			unset($this->consulta);
				$this->query = "
				SELECT *
				FROM speciality
				ORDER BY id_speciality ASC;
				";
				$this->getResultsFromQuery();
		}

		public function getTypeTransport(){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM type_transport
			ORDER BY id_type_transport ASC;
			";
			$this->getResultsFromQuery();
		}
		
		public function getTypeGourmet(){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM type_gourmet
			ORDER BY id_type_gourmet ASC;
			";
			$this->getResultsFromQuery();
		}

		public function getTypeDayWeek(){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM type_day_week
			ORDER BY id_day_week ASC;
			";
			$this->getResultsFromQuery();
		}
		
		public function getRestaurantsByCif($restaurant_id){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM restaurant
			WHERE cif_restaurant ='$restaurant_id'
			";
			$this->getResultsFromQuery();
		}

/*NUEVO*/

		public function getSpecialityByTypeSpeciality($nombre){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM  speciality a, restaurant b,  speciality_restaurants c  
			WHERE b.cif_restaurant= c.cif_restaurant AND a.id_speciality = c.speciality AND a.id_speciality = '$nombre';
			";
			$this->getResultsFromQuery();

		}

		public function getSpecialityById($id){
				unset($this->consulta);
				$this->query = "
				SELECT name
				FROM speciality
				WHERE id_speciality='$id'
				LIMIT 1
				";
				$this->getResultsFromQuery();
		foreach ($this->consulta as $key => $value) {
			$name=$value["name"];
		}
		return $name;
		}

		public function getMenuPrice0And20(){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM  menu a, restaurant b
			WHERE a.cif_restaurant= b.cif_restaurant AND a.price >=0 AND a.price<=20;
			";
			$this->getResultsFromQuery();

		}

		public function getMenuPrice20And40(){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM  menu a, restaurant b
			WHERE a.cif_restaurant= b.cif_restaurant AND a.price >=20 AND a.price<=40;
			";
			$this->getResultsFromQuery();

		}

		public function getMenuPrice40And60(){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM  menu a, restaurant b
			WHERE a.cif_restaurant= b.cif_restaurant AND a.price >=40 AND a.price<=60;
			";
			$this->getResultsFromQuery();

		}

		public function getMenuPrice60And80(){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM  menu a, restaurant b
			WHERE a.cif_restaurant= b.cif_restaurant AND a.price >=60 AND a.price<=80;
			";
			$this->getResultsFromQuery();

		}

		public function getMenuPrice80And100(){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM  menu a, restaurant b
			WHERE a.cif_restaurant= b.cif_restaurant AND a.price >=80 AND a.price<=100;
			";
			$this->getResultsFromQuery();

		}

		public function getMenuByPrice($minimo, $maximo){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM  menu a, restaurant b
			WHERE a.cif_restaurant= b.cif_restaurant AND a.price >='$minimo' AND a.price<='$maximo';
			";
			$this->getResultsFromQuery();

		}

		public function getRestaurantsByNote($minimo, $maximo){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM  ratings a, restaurant b
			WHERE a.cif_restaurant= b.cif_restaurant AND a.note >='$minimo' AND a.note<='$maximo';
			";
			$this->getResultsFromQuery();

		}
		
		public function getMenuPriceMoreOf100(){
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM  menu a, restaurant b
			WHERE a.cif_restaurant= b.cif_restaurant AND a.price >100;
			";
			$this->getResultsFromQuery();

		}

		public function getByCity($busqueda='') {
			if($busqueda != '') {
				$this->query = "
				SELECT *
				FROM restaurant
				WHERE city LIKE '%$busqueda%'
				";
				$this->getResultsFromQuery();
			}
		}

		public function getByName($busqueda='') {
			if($busqueda != '') {
				$this->query = "
				SELECT *
				FROM restaurant
				WHERE name LIKE '%$busqueda%'
				";
				$this->getResultsFromQuery();
			}
		}
	}
?>