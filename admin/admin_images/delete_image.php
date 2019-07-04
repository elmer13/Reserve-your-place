<?php
	
	include_once '../../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante
	
		if(isset($_POST['delete_ok'])){ // Si el parámetro delete_ok es verdadero proseguimos con la eliminación
		
				$image_id = $_POST['id_image'];

				if(empty($errors) === true){  // Si no hay errores hacemos lo siguiente
					$restaurant->deleteImageRestaurant($image_id); // Eliminamos la imagen del restaurante determinado

					$correct[] = 'Se ha borrado correctamente.';
					header('location:add_image.php');
				}
		}else if(isset($_POST['delete_nok'])){ // Si se cancela la eliminación redireccionamos a la página de imagenes
			header('location:add_image.php');
		}
?>

<!DOCTYPE>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
	<meta name='description' content='Plataforma de reserva de mesas para restaurantes'>
	<meta name='keywords' content='plataforma, reserva, mesas, restaurante'>
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
	<link rel='stylesheet' type='text/css' href='../../site_media/css/style.css'/>
	<link rel='shortcut icon' href='../../site_media/img/favicon.ico'/>
	<script type='text/javascript' src='../../site_media/js/jquery-1.11.0.min.js'></script>
	<script type='text/javascript' src='../../site_media/js/scrollTop.js'></script>
	<script type='text/javascript' src='../../site_media/js/btn_movil.js'></script>
	<title>Eliminar Imagenes Slider - Portal de Administración</title>
</head>
<body>
<!--
/*************************************************************************************************************************/
/	'$tag'  	        = Objeto instanciado de la clase tags para crear elementos html como divs, label, echo, img, etc. /
/   '$mi_sesion'        = Objeto instanciado de la clase sesion para crear, verificar y borrar sesiones                   /
/	'$restaurant'       = Objeto instanciado de la clase restaurant para realizar las diferentes consultas 				  /
/*************************************************************************************************************************/
-->
	<?php
		// Cabecera
		$tag->openTag('div','header','',''); 

			$tag->openTag('div','','logo',''); // Logo de la cabecera
				$tag->openTag('a','','',array('href'=>'../home.php'));
					$tag->openTag('img','','',array('src'=>'../../site_media/img/icon-reserveyourplace.png','width'=>'70','height'=>'50'));
					$tag->closeTag('img');
				$tag->closeTag('a');
			$tag->closeTag('div');

			$tag->openTag('div','','title',''); // Titulo de la cabecera
				$tag->openTag('h2','','','');
					$tag->openTag('a','','',array('href'=>'../home.php'));
						$tag->output('Portal de Administración');
					$tag->closeTag('a');
				$tag->closeTag('h2');
			$tag->closeTag('div');

		$tag->closeTag('div');

		// Sistema de navegación
		$tag->openTag('div','','menutop','');

			$tag->openTag('a','nav-mobile','nav-mobile',array('href'=>'#'));
			$tag->closeTag('a');
		
			$menu->cargarEnlace('../home.php','Home','','',array('onclick'=>''));
			$menu->cargarEnlace('../add_restaurant.php','Informacion','','');
			$menu->cargarEnlace('../table_restaurant.php','Mesas','','');
			$menu->cargarEnlace('../menu_gourmet.php','Menus y Platos','','');
			$menu->cargarEnlace('../reserve.php','Reservas','','');
			$menu->cargarEnlace('../comments.php','Comentarios','','');
			$menu->mostrarHorizontal();	
		
			$tag->openTag('ul','','','');
			$tag->openTag('div','','item','');
				$tag->openTag('img','','',array('src'=>'../../site_media/img/out.png','width'=>'30','height'=>'30'));
				$tag->closeTag('img');
				$tag->openTag('a','','',array('href'=>'../../includes/logout.php')); 
					$tag->output('Cerrar Sesión');
				$tag->closeTag('a');
			$tag->closeTag('div');
			$tag->closeTag('ul');
			
		$tag->closeTag('div');
		
		// Cuerpo de la página
		$tag->openTag('div','contenedor','margen','');
		
		$tag->openTag('h2','','','');
		$tag->output('Eliminar imagen del restaurante');
		$tag->closeTag('h2');
		
		$tag->openTag('br/','','','');
		
		$tag->openTag("div","","add-content-info","");
		
			if (isset($_GET['id']) === true) { // Si recibimos un parametro por GET lo guardamos en la variable '$id_image' y seguimos
			
				$id_image=trim($_GET['id']);
				
			}else{ // En caso contrario redireccionamos a la Página Principal
			
				header('location: ../../index.php');
				
			}
        	$restaurant->getImageById($id_image);  // Obtenemos los datos de la imagen del restaurante cuya id la pasamos por parámetro
          	
				$tag->openTag("div","preview2","","");

				if($restaurant->consulta!=null){ // Siempre y cuando la consulta sea diferente de nulo hacemos lo siguiente
				
					foreach ($restaurant->consulta as $key => $value) { // Recorremos el array y lo almacenamos en '$value'
					
						$form->startForm('','POST','', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 
						$tag->output("<img src='".$value["src"]."'  class='images'>");
								$input->addInput('hidden','id_image',$value['id_image'],array('id'=>'cif_restaurant','placeholder'=>'','class'=>'infor','size'=>16, 'readonly'=>'readonly','required'=>'required'));
							$tag->openTag('p','','','');
								$tag->output('Estas seguro de querer eliminar esta información');
							$tag->closeTag('p');
							$tag->openTag('br/','','','');
							
							$tag->openTag('div','','button-align-left','');
								$input->addInput('submit','delete_nok','Cancelar',array('id'=>'delete_nok','placeholder'=>'','class'=>'btn_left btn','size'=>16));
								$input->addInput('submit','delete_ok','Confirmar',array('id'=>'delete_ok','placeholder'=>'','class'=>'btn_left btn','size'=>16));
							$tag->closeTag('div');
							
						$form->endForm();// Cerramos el formulario
						
					}
					
				}

				$tag->closeTag('div');
			
			$tag->closeTag('div');

		$tag->closeTag('div');	

		// Pie de página
		$tag->openTag('div','footer','','');
			$tag->openTag('a','','','');
				$tag->output('&copy;  2014 - 2015 Reserveyourplace.com - Todos los derechos reservados');
			$tag->closeTag('a');
		$tag->closeTag('div');
	?>
</body>
</html>

<?php
	}else{ // Si el administrador del restaurante no ha iniciado sesión le redireccionamos a la Página Principal
		header('location: ../../index.php');
	}
?>