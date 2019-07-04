<?php
	include_once 'DBAbstractModel.php'; // Importar modelo de abstracción de base de datos

	class User extends DBAbstractModel{
	    // Atributos de la clase
		protected $email;
		public $usuario;
		public $password;
		public $email_code;
		public $propiedad;
		
		// Traer datos de un cliente por el email
		public function getUserByEmail($email='') {
			if($email != '') {
				$this->query = "
				SELECT *
				FROM user
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
		public function getUserByName($nombre='') {
		if($nombre != '') {
		$this->query = "
		SELECT *
		FROM user
		WHERE username = '$nombre'
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
		public function getUserById($id='') {
		if($id != '') {
		$this->query = "
		SELECT *
		FROM user
		WHERE id_user = '$id'
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
		public function setUser($user_data=array()){
			if(array_key_exists('email', $user_data)) {
				if(!$this->getUserByEmail($user_data['email'])){
					foreach ($user_data as $propiedad=>$valor) {
						$$propiedad = $valor;
					}
					global $bcrypt; // making the $bcrypt variable global so we can use here

					$email_code = $email_code = uniqid('code_',true); // Creating a unique string.
					$password   = $bcrypt->genHash($password);
					
					$this->query = "
					INSERT INTO user
					(name, surnames,username, password, email, email_code)
					VALUES
					('$name', '$surnames', '$username', '$password', '$email', '$email_code')
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
		
	public function getUserEmailCode($email){
		if($email != '') {
		$this->query = "
		SELECT email_code
		FROM user
		WHERE email = '$email' 
		";
		}		
		
		$this->getResultsFromQuery();
	}

	public function getUserGeneratedString($email){
		if($email != '') {
		$this->query = "
		SELECT generated_string
		FROM user
		WHERE email = '$email' 
		";
		}		
		
		$this->getResultsFromQuery();
	}

	public function updateUserGeneratedString($id_user){
        $this->query = "
            UPDATE user
            SET generated_string = 0
            WHERE id_user = '$id_user'
         ";
                        
        $this->ejecutarConsulta();
    }

	public function activate($email, $email_code) {
		if($email != '' ) {
		$this->query = "
		SELECT COUNT(id_user)
		FROM user
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
			UPDATE user
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
	public function email_confirmed($usuario='') {
		if($usuario != '') {
		$this->query = "
		SELECT COUNT(id_user)
		FROM user
		WHERE username = '$usuario' AND confirmed = 1
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
		SELECT password,id_user
		FROM user
		WHERE username = '$usuario' 
		";
		}		
		try{
		$this->getResultsFromQuery();
		foreach($this->consulta[2] as $key=>$values){
			$propiedad[$key] = $values;
		}

			$stored_password  = $propiedad['password']; // stored hashed password
			$id   				= $propiedad['id_user']; // id of the user to be returned if the password is verified, below.
			
			if($bcrypt->verify($password, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
				return $id;	// returning the user's id.
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
			SELECT COUNT(id_user)
			FROM user
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
	
	public function change_password($user_id, $password) {

		global $bcrypt;

		/* Two create a Hash you do */
		$password_hash = $bcrypt->genHash($password);
		$this->query = "
		UPDATE user
		SET password = '$password_hash'
		WHERE id_user = '$user_id'
		";	

		try{
			$this->ejecutarConsulta();		
			return true;
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}
	
	public function confirm_recover($email){
		$this->getUserByEmail($email);
		foreach($this->consulta[1] as $key=>$values){
			$propiedad[$key] = $values;
		}
		$user =$propiedad["username"];

		$unique = uniqid('',true);
		$random = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0, 10);
		
		$generated_string = $unique . $random; // a random and unique string
		
		$this->query = "
			UPDATE user
			SET generated_string = '$generated_string'
			WHERE email = '$email'
		";

		try{
			
			$this->ejecutarConsulta();

		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
	

		// Modificar un cliente teniendo como comparador el nif
		public function updateUser($user_data=array()) {
			foreach ($user_data as $propiedad=>$valor) {
				$$propiedad = $valor;
			}
			$this->query = "
			UPDATE user
			SET name='$name',
			surnames='$surnames',
			gender='$gender',
			location='$location',
			zipcode='$zipcode',
			city='$city'
			WHERE id_user = '$id_user'
			";
			$this->ejecutarConsulta();
		}
		
		//Recoger la id de usuario a partir del Username
		public function getIdUserByUserName($username) {
			$this->query = "
			SELECT id_user
			FROM user
			WHERE username = '$username';
			";
			$this->getResultsFromQuery();
				foreach ($this->consulta as $key => $value) {
					$id_user=$value["id_user"];
				}
			return $id_user;
		}
		
		/**** RESERVATION ***/
		
		public function addReservation($user_data=array()) {
			unset($this->consulta);
			foreach($user_data as $propiedad=>$valor){
				$$propiedad = $valor;
			}
			$this->query = "
				INSERT INTO reservations
				(cif_restaurant,date,time,number_people,description)
				VALUES
				('$cif_restaurant','$date','$time',$number_people,'$description')";
			$this->ejecutarConsulta();
			
		}
		
		public function getIdReservation() {
			unset($this->consulta);
			$this->query = "
			SELECT id_reservation
			FROM reservations
			order by id_reservation desc limit 1
			";
			$this->getResultsFromQuery();
		}
		
		public function addTotalReservation($id_user, $id_table_restaurant){
			unset($this->consulta);
			$this->getIdReservation();
			foreach($this->consulta as $propiedad=>$valor){
				$this->propiedad = $valor;
			}
			$id_reservation = $this->propiedad["id_reservation"];
					$this->query = "
					INSERT INTO total_reservations
					(id_user, id_reservation, id_table_restaurant)
					VALUES
					('$id_user','$id_reservation','$id_table_restaurant');
					";
					$this->ejecutarConsulta();
			
		}
		
		public function getReservationByUser($user_id) {
			unset($this->consulta);
			$this->query = "
			SELECT rt.name, rv.date, rv.time, rv.number_people, rv.description
			FROM user u, total_reservations tr, reservations rv, restaurant rt
			WHERE u.id_user = tr.id_user AND tr.id_reservation = rv.id_reservation AND rv.cif_restaurant = rt.cif_restaurant
			AND u.id_user = $user_id
			";
			$this->getResultsFromQuery();
			
		}
		
		public function isTableReservated($user_data=array()) {
			unset($this->consulta);
			foreach($user_data as $propiedad=>$valor){
				$$propiedad = $valor;
			}
			$this->query = "
			SELECT * 
			FROM reservations r, total_reservations trv, tables_restaurant trt
			WHERE r.id_reservation = trv.id_reservation AND trv.id_table_restaurant = trt.id_table
			AND r.date = '$date' AND r.time = '$time' AND trv.id_table_restaurant = $id_table
			";
			$this->getResultsFromQuery();
			
		}
		
		/**** RAITINGS ***/
		
		public function addRaiting($user_data=array()) {
			unset($this->consulta);
			foreach($user_data as $propiedad=>$valor){
				$$propiedad = $valor;
			}
			$this->query = "
				INSERT INTO ratings
				(cif_restaurant,id_user,date,time,description,note)
				VALUES
				('$cif_restaurant',$id_user,'$date','$time','$description',$note)";
			$this->ejecutarConsulta();
			
		}
		
		public function getIdRating() {
			unset($this->consulta);
			$this->query = "
			SELECT id_rating
			FROM ratings
			order by id_rating desc limit 1
			";
			$this->getResultsFromQuery();
		}
		
		public function addRatingNotes($id_type_rating, $note){
			unset($this->consulta);
			$this->getIdRating();
			foreach($this->consulta as $propiedad=>$valor){
				$this->propiedad = $valor;
			}
			$id_rating = $this->propiedad["id_rating"];
			foreach($user_data as $propiedad=>$valor){
				$this->propiedad = $valor;
			}
					$this->query = "
					INSERT INTO rating_notes
					(id_rating, id_type_rating, note)
					VALUES
					($id_rating,$id_type_rating,$note);
					";
					$this->ejecutarConsulta();
			
		}
		
		public function getRatingsByUser($user_id) {
			unset($this->consulta);
			$this->query = "
			SELECT re.name, ra.date, ra.time, ra.description, ra.note
			FROM ratings ra, restaurant re, user u
			WHERE ra.cif_restaurant = re.cif_restaurant AND ra.id_user = u.id_user AND u.id_user = $user_id
			";
			$this->getResultsFromQuery();
			
		}
		
		public function getNameRestaurantByCif($id_reservation) {
			unset($this->consulta);
			$this->query = "
			SELECT rt.name
			FROM restaurant rt, reservations rv
			WHERE rt.cif_restaurant = rv.cif_restaurant AND rv.id_reservation = $id_reservation
			";
			$this->getResultsFromQuery();
			
		}
		
		public function getNameRestaurantReservationByUser($user_id) {
			unset($this->consulta);
			$this->query = "
			SELECT rt.cif_restaurant, rt.name, rv.date
			FROM user u, total_reservations tr, reservations rv, restaurant rt
			WHERE u.id_user = tr.id_user AND  rv.cif_restaurant = rt.cif_restaurant AND tr.id_reservation = rv.id_reservation
			AND u.id_user = '$user_id'
			";
			$this->getResultsFromQuery();
			
		}
		
		public function getCountReservationsByUser($user_id) {
			unset($this->consulta);
			$this->query = "
			SELECT count(tr.id_reservation) count_id
			FROM reservations r, total_reservations tr 
			WHERE tr.id_reservation = r.id_reservation AND tr.id_user = '$user_id'
			";
			$this->getResultsFromQuery();
				foreach ($this->consulta as $key => $value) {
					$count_reservation=$value["count_id"];
				}
			return $count_reservation;
			
		}
		
		public function getNameTypeRatings() {
			unset($this->consulta);
			$this->query = "
			SELECT *
			FROM type_ratings
			";
			$this->getResultsFromQuery();		
		}
		
	}
?>