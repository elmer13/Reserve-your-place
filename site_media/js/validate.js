/*****************************************************************************************************************************/
/*	Fichero js que se encargará de validar de lado del cliente el Registro y Loguin del Acesso del Usuario y del Restaurante */
/*****************************************************************************************************************************/ 
$(document).ready(function(){

// Validación del Login tanto del Usuario como del Restaurante

	// Funciones de validación del Nombre de Usuario
	
	function validateUsername(){
		//NO cumple longitud minima y maxima
		if($('#username').val().length < 5 || $('#username').val().length > 12 ){
			$('#req-username').addClass('error');
			$('#username').addClass('error');
			return false;
		}
		//SI longitud pero NO solo carácteres A-z
		else if(!$('#username').val().match(/^[a-zA-Z]+$/)){
			$('#req-username').addClass('error');
			$('#username').addClass('error');
			return false;
		}
		// SI longitud, SI carácteres A-z
		else{
			$('#req-username').removeClass('error');
			$('#username').removeClass('error');
			return true;
		}
	}
	
	// Funciones de validación del CIF
	
	function validateCifRestaurant(){
		//NO hay nada escrito
		if($('#cif_restaurant1').val().length == 0){
			$('#req-cif_restaurant1').addClass('error');
			$('#cif_restaurant1').addClass('error');
			return false;
		}
		// SI escrito, NO válido CIF
		else if(!$('#cif_restaurant1').val().match(/(^[A-Z]{1}[0-9]{8}$)/)){
			$('#req-cif_restaurant1').addClass('error');
			$('#cif_restaurant1').addClass('error');
			return false;
		}
		// SI rellenado, SI CIF válido
		else{
			$('#req-cif_restaurant1').removeClass('error');
			$('#cif_restaurant1').removeClass('error');
			return true;
		}
	}

	// Funciones de validación del Password
	
	function validatePassword(){
		//NO tiene mínimo de 5 carácteres o mas de 12 carácteres
		if($('#password1').val().length < 5 || $('#password1').val().length > 12){
			$('#req-password1').addClass('error');
			$('#password1').addClass('error');
			return false;
		}
		// SI longitud, NO válido numeros y letras
		else if(!$('#password1').val().match(/^[0-9a-zA-Z]+$/)){
			$('#req-password1').addClass('error');
			$('#password1').addClass('error');
			return false;
		}
		// SI rellenado, SI Password válido
		else{
			$('#req-password1').removeClass('error');
			$('#password1').removeClass('error');
			return true;
		}
	}
	
	// Controlamos la validación en los distintos eventos
	// Perdida de foco
	$('#username').blur(validateUsername);
	$('#password1').blur(validatePassword); 
	$('#cif_restaurant1').blur(validateCifRestaurant);
	
	// Pulsacion de tecla
	$('#username').keyup(validateUsername);
	$('#password1').keyup(validatePassword);
	$('#cif_restaurant1').keyup(validateCifRestaurant);
	
	//controlamos el foco / perdida de foco para los input text
	$('.text').focus(function(){
		$(this).addClass('active');
	});

	$('.text').blur(function(){
		$(this).removeClass('active');  
	});

	// Envio de formulario Login del Usuario
	$('#loginUser').submit(function(){
		if(validateUsername() & validatePassword())
			return true;
		else
			return false;
	});

	// Envio de formulario Login del Restaurante
	$('#loginRestaurant').submit(function(){
		if(validateCifRestaurant() & validatePassword())
			return true;
		else
			return false;
	});

});

// Validación del Registro tanto del Usuario como del Restaurante
$(document).ready(function(){

	// Funciones de validación del CIF
	
	function validateCifRestaurant(){
		//NO hay nada escrito
		if($('#cif_restaurant2').val().length == 0){
			$('#req-cif_restaurant2').addClass('error');
			$('#cif_restaurant2').addClass('error');
			return false;
		}
		// SI escrito, NO válido CIF
		else if(!$('#cif_restaurant2').val().match(/(^[A-Z]{1}[0-9]{8}$)/)){
			$('#req-cif_restaurant2').addClass('error');
			$('#cif_restaurant2').addClass('error');
			return false;
		}
		// SI rellenado, SI CIF válido
		else{
			$('#req-cif_restaurant2').removeClass('error');
			$('#cif_restaurant2').removeClass('error');
			return true;
		}
	}

	// Funciones de validación del nombre
	
	function validateName(){
		//SI longitud pero NO solo carácteres A-z
		if(!$('#name').val().match(/^[a-zA-Z]+$/)){
			$('#req-name').addClass('error');
			$('#name').addClass('error');
			return false;
		}
		// SI longitud, SI carácteres A-z
		else{
			$('#req-name').removeClass('error');
			$('#name').removeClass('error');
			return true;
		}
	}

	// Funciones de validación de los Apellidos
	function validateSurnames(){
		//SI longitud pero NO solo carácteres A-z
		if(!$('#surnames').val().match(/^[a-zA-Z ]+$/)){
			$('#req-surnames').addClass('error');
			$('#surnames').addClass('error');
			return false;
		}
		// SI longitud, SI carácteres A-z
		else{
			$('#req-surnames').removeClass('error');
			$('#surnames').removeClass('error');
			return true;
		}
	}

	// Funciones de validación del nombre de Usuario
	
	function validateUsername(){
		//NO cumple longitud minima
		if($('#username2').val().length < 5 || $('#username2').val().length > 12 ){
			$('#req-username2').addClass('error');
			$('#username2').addClass('error');
			return false;
		}
		//SI longitud pero NO solo carácteres A-z
		else if(!$('#username2').val().match(/^[a-zA-Z]+$/)){
			$('#req-username2').addClass('error');
			$('#username2').addClass('error');
			return false;
		}
		// SI longitud, SI carácteres A-z
		else{
			$('#req-username2').removeClass('error');
			$('#username2').removeClass('error');
			return true;
		}
	}
	
	// Funciones de validación del Password
	
	function validatePassword(){
		//NO tiene mínimo de 5 carácteres o mas de 12 carácteres
		if($('#password2').val().length < 5 || $('#password2').val().length > 12){
			$('#req-password2').addClass('error');
			$('#password2').addClass('error');
			return false;
		}
		// SI longitud, NO válido numeros y letras
		else if(!$('#password2').val().match(/^[0-9a-zA-Z]+$/)){
			$('#req-password2').addClass('error');
			$('#password2').addClass('error');
			return false;
		}
		// SI rellenado, SI Password válido
		else{
			$('#req-password2').removeClass('error');
			$('#password2').removeClass('error');
			return true;
		}
	}
	
	// Funciones de validación del Email
	
	function validateEmail(){
		//NO hay nada escrito
		if($('#email').val().length == 0){
			$('#req-email').addClass('error');
			$('#email').addClass('error');
			return false;
		}
		// SI escrito, NO válido email
		else if(!$('#email').val().match(/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i)){
			$('#req-email').addClass('error');
			$('#email').addClass('error');
			return false;
		}
		// SI rellenado, SI email válido
		else{
			$('#req-email').removeClass('error');
			$('#email').removeClass('error');
			return true;
		}
	}
	
	//controlamos la validación en los distintos eventos
	// Perdida de foco
	$('#name').blur(validateName);
	$('#surnames').blur(validateSurnames);
	$('#email').blur(validateEmail);
	$('#username2').blur(validateUsername);
	$('#cif_restaurant2').blur(validateCifRestaurant)
	$('#password2').blur(validatePassword);  
	
	// Pulsacion de tecla
	$('#name').keyup(validateName);
	$('#surnames').keyup(validateSurnames);
	$('#email').keyup(validateEmail);
	$('#username2').keyup(validateUsername);
	$('#cif_restaurant2').keyup(validateCifRestaurant)
	$('#password2').keyup(validatePassword);
	
	
	//controlamos el foco / perdida de foco para los input text
	$('.text').focus(function(){
		$(this).addClass('active');
	});

	$('.text').blur(function(){
		$(this).removeClass('ctive');  
	});

	// Envio de formulario Registro del Usuario
	$('#registerestaurant').submit(function(){
		if(validateName() & validateSurnames() & validateEmail() &  validateUsername() & validatePassword())
			return true;
		else
			return false;
	});

	// Envio de formulario Registro del Restaurante
	$('#registerRestaurant').submit(function(){
		if(validateCifRestaurant() & validateEmail() & validatePassword())
			return true;
		else
			return false;
	});

});

