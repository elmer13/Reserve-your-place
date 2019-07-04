/*************************************************************************************************************************************/
/*	Fichero js que se encargará de cargar los datos mediante ajax partiendo de la consulta en el fichero get_restaurants_by_note.php */
/*************************************************************************************************************************************/
$(function() {
	
	$('#slider-nota').slider({
		// Características del Slider
        range: true,
        min: 1, // Límite mínimo
        max: 10,// Límite máximo
        values: [ 4, 8 ], // Valor por defecto
		
        slide: function( event, ui ) {
            
			$('#nota').val( ui.values[ 0 ] + ' - ' + ui.values[ 1 ] );
            $('#inputnota_min').attr('value', ui.values[ 0 ]);
            $('#inputnota_max').attr('value', ui.values[ 1 ]);

			var minimo=$('#slider-nota').slider('values', 0 ); // Cogemos el valor mínimo seleccionado
			var maximo=$('#slider-nota').slider('values', 1 ); // Cogemos el valor máximo seleccionado
            
			//hace la búsqueda
			
			$.ajax({
                type:'POST', // Método que utilizamos
                url: 'includes/get_restaurants_by_note.php',   // llamada al archivo php
				data: 'b='+minimo+'&c='+maximo, // parametros que se envian
                dataType: 'html', // tipo html
                    
				beforeSend: function(){ // Antes del envio 
                    //imagen de carga
					$('#resultado').html("<p align='center'><img src='site_media/img/ajax-loader.gif' /></p>");
                },
                
				error: function(){	// Si hay un error
                    alert('error petición ajax');
                },
                    
				success: function(data){ // Si se realiza con éxito                                               
                    $('#resultado').empty();
                    $('#resultado').append(data);
                }
			});
        }
    });

    $('#nota').val( $('#slider-nota').slider('values', 0 ) + ' - ' + $('#slider-nota').slider('values', 1 )); // Ver los rangos de mayor a menor seleccionados

	$('#inputnota_min').attr('value', $('#slider-nota').slider('values', 0 ));
    $('#inputnota_max').attr('value', $('#slider-nota').slider('values', 1 ));

});