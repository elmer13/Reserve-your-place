<?php

	// Archivo llamado desde ajax para filtrar la búsqueda de restaurantes por nombres

      $buscar = $_POST['b']; // Recogemos la variable enviada por 'POST' y la almacenamos en una variable
       
      if(!empty($buscar)){ // Si la variable es diferente de vacio la enviamos como parametro a la función buscar

            buscar($buscar);

      }

    // Función que recibirá el filtro para el buscador 
       
      function buscar($b){

      	include_once '../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 

      	$restaurant->getByName($b); // Obtenemos la información del restaurante teniendo en cuenta el nombre definido en la variable '$b'

		if(isset($restaurant->consulta)!=null){  // Si la consulta es diferente de nulo mostramos los resultados

			foreach ($restaurant->consulta as $key => $values){ // Recorremos los diferentes resultados y los mostramos con '$values'

				$tag->openTag('div','','producto','');

					$cif = base64_encode($values['cif_restaurant']); // Encriptamos el CIF del restaurante

					$tag->openTag('a','','',array('href'=>'details.php?cif='.$cif));

						if($restaurant->getFeaturedImage($values['cif_restaurant'])){

							$tag->openTag('img','','',array('src'=>'admin/admin_images/'.$restaurant->getFeaturedImage($values['cif_restaurant']))); // Obtenemos la imagen principal del restaurante
							$tag->closeTag('img');

						}else{

							$tag->openTag('img','','',array('src'=>'admin/admin_images/images/not_found.png'));
							$tag->closeTag('img');

						}

					$tag->closeTag('a');

					$tag->openTag('div','','informacion','');				

						$tag->openTag('div','','campo','');

							$tag->output($values['name']); // Obtenemos el nombre del restaurante

						$tag->closeTag('div');

						
						$tag->openTag('div','','campo2','');

							if($values['capacity']){

								$tag->output($values['capacity'].' plazas'); // Obtenemos las plazas que tiene el restaurante

							}
					
						$tag->closeTag('div');
					
						$tag->openTag('div','','campo3','');
							
							if($restaurant->getRestaurantSpecialityRoundByCif($values['cif_restaurant'])){
							
								$tag->output('Especialidad: '.$restaurant->getRestaurantSpecialityRoundByCif($values['cif_restaurant']));  // Obtenemos una especialidad del restaurante aleatoriamente				
					
							}

						$tag->closeTag('div');

					
						$tag->openTag('div','','campo','');

							if($restaurant->getRestaurantsNote($values['cif_restaurant'])){

								$tag->output('Nota: '.$restaurant->getRestaurantsNote($values['cif_restaurant']).'/10'); // Obtenemos la nota media del restaurante sobre 10

							}
				
						$tag->closeTag('div');
							
						$tag->openTag('div','','campo2','');

							if($restaurant->getRestaurantsMenuCheap($values['cif_restaurant'])){

								$tag->output('A partir de '.$restaurant->getRestaurantsMenuCheap($values['cif_restaurant']).'€'); // Obtenemos el precio del menú más barato del restaurante
						
							}
				
						$tag->closeTag('div');
							
						$tag->openTag('div','','campo3','');

							if(($values['location']) &&($values['city'])!=null){

								$tag->output($values['location'].', '.$values['city']); // Concatenamos la dirección y la ciudad

							}
						$tag->closeTag('div');
						
					$tag->closeTag('div');

					
					$tag->openTag('div','','campo4','');
				
						$input->addInput('button','linea','Leer más',array('id'=>'linea','placeholder'=>'','class'=>'btn3','size'=>16,'onclick'=>"javascript:location.href='details.php?cif=".$cif."';")); // Para ver una información más detallada
								
						$input->addInput('button','linea','Reservar',array('id'=>'linea','placeholder'=>'','class'=>'btn3','size'=>16,'onclick'=>"javascript:location.href='reserve.php?cif=".$cif."';")); // // Enviamos el parametro '$cif' por get previamente encriptado

					$tag->closeTag('div');
			
				$tag->closeTag('div');

			}

		}else{ // Si la consulta es nula lo hacemos saber

            $tag->output('No se han encontrado resultados para su búsqueda.'); 
        
        }

    }
?>