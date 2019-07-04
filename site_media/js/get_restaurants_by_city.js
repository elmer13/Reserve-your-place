/*************************************************************************************************************************************/
/*	Fichero js que se encargará de cargar los datos mediante ajax partiendo de la consulta en el fichero get_restaurants_by_city.php */
/*************************************************************************************************************************************/
$(document).ready(function(){
                                                                          
    //hacemos focus al campo de búsqueda
    $('#busqueda').focus();
                                                                                                    
    //comprobamos si se pulsa una tecla
    $('#busqueda').keyup(function(e){
                                     
		//obtenemos el texto introducido en el campo de búsqueda
		var consulta = $('#busqueda').val();
																			   
		//hace la búsqueda
																					  
		$.ajax({	
			type: 'POST', // Método que utilizamos
			url: 'includes/get_restaurants_by_city.php', // llamada al archivo php
			data: 'b='+consulta, // parametros que se envian
			dataType: 'html', // tipo html
				
			beforeSend: function(){ // Antes del envio 
				//imagen de carga
				$('#resultado').html("<p align='center'><img src='site_media/img/ajax-loader.gif' /></p>");
			},
							
			error: function(){ // Si hay un error
				alert('error petición ajax');
			},
							
			success: function(data){ // Si se realiza con éxito                                                    
				$('#resultado').empty();
				$('#resultado').append(data);
																	 
			}
		
		});                                                                               
                                                                           
	});
                                                                   
});
  