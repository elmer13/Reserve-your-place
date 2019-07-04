<?php
	
	// Diferentes enlaces que se asignaran dependiendo de la sesión en la que este 

	if($mi_sesion->getValor('id_user')==TRUE){ // Verificamos que la sesión actual sea la del usuario
		
		$tag->openTag('div','','item','');

			$tag->openTag('img','','',array('src'=>'../site_media/img/out.png','width'=>'30','height'=>'30'));
			$tag->closeTag('img');
			$tag->openTag('a','','',array('href'=>'../includes/logout.php')); 
				$tag->output('Cerrar Sesión');
			$tag->closeTag('a');

		$tag->closeTag('div');
			
	}else if($mi_sesion->getValor('id_restaurant')==TRUE){ // Verificamos que la sesión actual sea la del administrador del restaurante
		
		$tag->openTag('div','','item','');
					
			$tag->openTag('img','','',array('src'=>'../site_media/img/out.png','width'=>'30','height'=>'30'));
			$tag->closeTag('img');
			$tag->openTag('a','','',array('href'=>'../includes/logout.php')); 
				$tag->output('Cerrar Sesión');
			$tag->closeTag('a');
		
		$tag->closeTag('div');
	
	}else{ // Siempre y cuando las sesiones sean diferentes a las del usuario y el administrador del restaurante 
			
		$tag->openTag('div','','item','');
					
			$tag->openTag('img','','',array('src'=>'site_media/img/home.png','width'=>'30','height'=>'30'));
			$tag->closeTag('img');
			$tag->openTag('a','','',array('href'=>'restaurant_access.php')); 
				$tag->output('Acceso Restaurantes');
			$tag->closeTag('a');
		
		$tag->closeTag('div');
				
		$tag->openTag('div','','item2','');
			
			$tag->openTag('img','','',array('src'=>'site_media/img/members.png','width'=>'30','height'=>'30'));
			$tag->closeTag('img');
			$tag->openTag('a','','',array('href'=>'user_access.php')); 
				$tag->output('Acceso Usuarios');
			$tag->closeTag('a');
		
		$tag->closeTag('div');
	
	}

?>