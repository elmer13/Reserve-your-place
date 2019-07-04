<?php

	include_once '../../core/init.php';

	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Verificamos que el usuario haya iniciado sesion
	
		if(isset($_POST['titulo'])!=null){

		foreach ($_POST['titulo'] as $indice => $value) {

			$var_usar_thumb = 1; //variable que comprueba si tendrá efecto o no el redimensionamiento (1 para sí, 0 para no)
			$var_thumb_ancho = 1260; //variable que especifica el ancho que va a tener la imagen
			$var_thumb_alto = 413; //variable que especifica el alto que va a tener la imagen
						
			$cif_restaurant= $_POST['id_restaurant'];
			$cantidad = $_POST['cantidad'];
		    $position = $cantidad + $indice;
			$featured_image=0;
			$name 			= $_FILES['FileInput']['name'][$indice];
			$tmp_name 		= $_FILES['FileInput']['tmp_name'][$indice];
			$allowed_ext 	= array('jpg', 'jpeg', 'png', 'gif' );
			$a 				= explode('.', $name);
			$file_ext 		= strtolower(end($a)); unset($a);	
			$path 			= 'images';

			if (in_array($file_ext, $allowed_ext) === false) {
			
				$errors[] = 'El tipo de archivo de imagen no esta permitido.';	
				
			}

			if(empty($errors) === true){  // Si no hay errores, llamamos a un método 'setArticle' enviando las diferentes variables recibidas por POST
			
				if($restaurant->getCountImagesByCif($cif_restaurant)==true){

					if (move_uploaded_file(@$tmp_name, @$path.'/'.@$name)){ //si la imagen es subida al directorio del servidor
					
						$subida = true; //admitimos que la subida fue correcta
						
					}
					
					if (@$subida === true){ //si la subida fue correcta
					
						$obj_simpleimage->load($path.'/'.$name); //leemos la imagen 
						
						if ( ($_FILES['FileInput']['type']) != 'image/gif' && $var_usar_thumb == 1){//Si la imagen no es de tipo gif, y marcamos en el formulario como thumbnail
						
							$var_nuevo_archivo = $restaurant->file_newpath($path, $name); //asignamos un nombre para evitar sobreescritura
							$obj_simpleimage->resize($var_thumb_ancho,$var_thumb_alto); //redimensionamos la imagen, con los valores de ancho y alto que hemos especificado
						
						}else{ //sino
						
							$var_nuevo_archivo = $restaurant->file_newpath($path, $name);; //se agregará al nombre original de la imagen una serie de números aleatorios
						
						}
						
						$obj_simpleimage->save($var_nuevo_archivo); //guardamos los cambios efectuados en la imagen
						unlink($path.'/'.$name); //eliminamos del temporal la imagen que estabamos subiendo
						
					}
				$restaurant->setImage(array('cif_restaurant'=>$cif_restaurant, 'src'=>$var_nuevo_archivo,'featured_image'=>$featured_image,'position'=>$position));
				header('location: add_image.php');
				}
			}else if (empty($errors) === false) {
			
				echo '<p>' . implode('</p><p>', $errors) . '</p>';	
				
			}
			
		}
		
		}else{
		
			header('location: ../home.php');
			
		}
		
	}else{
	
		header('location: ../../index.php');
		
	}	

?>