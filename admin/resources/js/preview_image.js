 /****************************************************************************************************/
/*	Fichero js que se encargará de ejecutar el controlador de eventos a la hora de cambiar iamgenes  */
/*****************************************************************************************************/ 
 $(document).ready(function() { 	
            
    $('#photoimg').live('change', function(){ // Aplicamos el controlador de eventos 
		
		$('#preview').html('');
		$('#preview').html('<img src="../resources/loader.gif" alt="Uploading...."/>');  //imagen de carga
		
		$('#imageform').ajaxForm({ // Iniciamos el formulario teniendo cuenta el 'submit'
		target: '#preview'		
		}).submit(); 
		
	});
}); 