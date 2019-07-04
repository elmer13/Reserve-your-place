<?php

	include_once '../../core/init.php';

	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Verificamos que el usuario haya iniciado sesion
	
		if(isset($_POST['id_image'])!=null){

			$id_image = $_POST['id_image'];

			if (isset($_FILES['FileInput2']) && !empty($_FILES['FileInput2']['name'])) {

					$var_usar_thumb = 1; //variable que comprueba si tendrá efecto o no el redimensionamiento (1 para sí, 0 para no)
					$var_thumb_ancho = 1260; //variable que especifica el ancho que va a tener la imagen
					$var_thumb_alto = 413; //variable que especifica el alto que va a tener la imagen
					
				
					$name 			= $_FILES['FileInput2']['name'];
					$tmp_name 		= $_FILES['FileInput2']['tmp_name'];
					$allowed_ext 	= array('jpg', 'jpeg', 'png', 'gif' );
					$a 				= explode('.', $name);
					$file_ext 		= strtolower(end($a)); unset($a);
					$file_size 		= $_FILES['FileInput2']['size'];	
					$path 			= 'images';
					$featured_image = 0;
					
					if (in_array($file_ext, $allowed_ext) === false) {
					
						$errors[] = 'El tipo de archivo de imagen no esta permitido.';	
						
					}
					
					if ($file_size > 2097152) {
					
						$errors[] = 'El tamaño del archivo debe ser menor de 2mb.';
						
					}
					
			}
				
			if(empty($errors) === true) {

				if(move_uploaded_file(@$tmp_name, @$path.'/'.@$name)){ //si la imagen es subida al directorio del servidor
				
					$subida = true; //admitimos que la subida fue correcta
					
				}
					
				if(@$subida === true){ //si la subida fue correcta
				
					$obj_simpleimage->load($path.'/'.$name); //leemos la imagen 
				
					if(($_FILES['FileInput2']['type']) != 'image/gif' && $var_usar_thumb == 1){//Si la imagen no es de tipo gif, y marcamos en el formulario como thumbnail
					
						$var_nuevo_archivo = $restaurant->file_newpath($path, $name); //asignamos un nombre para evitar sobreescritura
							$obj_simpleimage->resize($var_thumb_ancho,$var_thumb_alto); //redimensionamos la imagen, con los valores de ancho y alto que hemos especificado
							
					}else{ //sino
					
						$var_nuevo_archivo = $restaurant->file_newpath($path, $name);; //se agregará al nombre original de la imagen una serie de números aleatorios
						
					}
					
					$obj_simpleimage->save($var_nuevo_archivo); //guardamos los cambios efectuados en la imagen
					unlink($path.'/'.$name); //eliminamos del temporal la imagen que estabamos subiendo
					echo "<div id='preview2'>Imagen subida correctamente. <br/><br/><h4>Vista de la imagen:</h4><br/><img src=\"".$var_nuevo_archivo."\"  class='images' alt=\"".$var_nuevo_archivo."\" /></div><br>"; //mostramos los resultados

				}
				
				$restaurant->updateImageById(array('cif_restaurant'=>$restaurant_id,'id_image'=>$id_image ,'src'=>@$var_nuevo_archivo));
					
			}

		}else{
		
			header('location: ../home.php');
			
		}	

	}else{
	
		header('location: ../../index.php');
		
	}
				
?>