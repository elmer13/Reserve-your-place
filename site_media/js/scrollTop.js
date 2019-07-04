/*************************************************************************************************/
/*	Fichero js que se encargará de mantener la cabecera arriba del todo en caso que haya scroll  */
/*************************************************************************************************/   	 
$(window).scroll(function(){
    if ($(this).scrollTop() > 60){ // Siempre y cuando sea mayor al limite cambiamos parámetros 
	
		$('.menutop').addClass('fixed').fadeIn(); 
		$('#contenedor').addClass('margen').fadeIn();
		
	}else { // En caso contrario tomamos los valores por defecto
	
		$('.menutop').removeClass('fixed');
		$('#contenedor').removeClass('margen');
		
	}
});