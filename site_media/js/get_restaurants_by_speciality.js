/*******************************************************************************************************************************************/
/*	Fichero js que se encargará de cargar los datos mediante ajax partiendo de la consulta en el fichero get_restaurants_by_speciality.php */
/*******************************************************************************************************************************************/
$(document).ready( function (){

	// Asignamos Controlador de eventos que se ejecutará cuando se cambien las diferentes opciones del select
	$('#dropdown_selector').change(function(){
	
		// Establece el valor de option cambiando actualmente la variable option
		var option = $(this).find('option:selected').val();

		//hace la búsqueda
        
		$.ajax({
            type: 'POST', // Método que utilizamos
            url: 'includes/get_restaurants_by_speciality.php', // llamada al archivo php
            data: 'b='+option,
            dataType: 'html',
         
			beforeSend: function(){  // Antes del envio 
                //imagen de carga
                $('#resultado').html("<p align='center'><img src='site_media/img/ajax-loader.gif' /></p>");
            },
			
            error: function(){  // Si hay un error
                alert('error petición ajax');
            },
                 
			success: function(data){ // Si se realiza con éxito                                                     
                $('#resultado').empty();
                $('#resultado').append(data);
            }
        });

	});
});