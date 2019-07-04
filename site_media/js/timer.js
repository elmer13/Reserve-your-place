/******************************************************************************************************************************/
/*	Fichero js que se encargará de ejecutar la función timer() cuya funcion es hacer una redirección en un tiempo determinado */
/******************************************************************************************************************************/ 
var timer = function(){
	
	var t=setTimeout('timer()',1000); // Determinamos el tiempo para el temporizador
	
	document.getElementById('contador').innerHTML = 'Usted sera redirigido al inicio de sesión en: '+i--+' segs.'; // Texto que saldrá previamente a la redirección
	
	if (i==0){location.href='../user_access.php'; // Página a la que será redireccionada
		
		clearTimeout(t); // Despejamos el temporizador
	}
}
i=10; // Ponemos el valor por defecto de la i a 10