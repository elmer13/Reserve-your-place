/************************************************************************************************/
/*	Fichero js que se encargará de mostrar y ocultar el elemento determinado al clicar un boton */
/************************************************************************************************/	  
jQuery(document).ready(function(){
  
	jQuery('#botonocultamuestra3').click(function () { // Al clicar el boton hacemos lo siguiente
  
		jQuery('#divocultamuestra3').each(function() { // iterador al clicar el boton
			
			displaying = jQuery(this).css('display'); // Asignamos el css display a una variable
			
			if(displaying == 'block') { // En función del valor de la variable hacemos algo determinado, en este caso ocultarlo 
          
				jQuery(this).fadeOut('slow',function() { // Ocultamos un elemento cambiando su opacidad
					
					jQuery(this).css('display','none'); // Ocultamos el elemento display none
				
				});
        
			}else{ // En caso contrario lo mostramos
			
				jQuery(this).fadeIn('slow',function() {  // Mostramos un elemento cambiando su opacidad
					
					jQuery(this).css('display','block'); // Mostramos el elemento display con block
				
				});
			}
		});
    });
  });