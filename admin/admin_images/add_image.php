<?php
	
	include_once '../../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante

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
	<script type='text/javascript' src='../../site_media/js/jquery.min.js'></script>
	<script type='text/javascript' src='../../site_media/js/jquery.form.js'></script>
	<script type='text/javascript' src='../resources/js/preview_image.js' ></script>
	<title>Galeria de Imagenes - Portal de Administración</title>
	
	<script type='text/javascript'>
	$(document).ready(function() {
	/* En el change del campo file, cambiamos el val del campo ficticio por el del verdadero */
	$('#photoimg').change(function(){
	$('#url-archivo').val($(this).val());
	});
	});
	</script>
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
		$tag->openTag('div','contenedor','','');
		
		$tag->openTag('h2','','','');
		$tag->output('Galeria de Imagenes');
		$tag->closeTag('h2');

			// Mostramos el formulario con los campos requeridos para añadir la imagen principal del restaurante
			
			$tag->openTag('div','','profile_picture','');

			$form->startForm('upload_featured_image.php','POST','imageform', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 

			$tag->openTag('h3','','','');
			$tag->output('Imagen principal');
			$tag->closeTag('h3');

        	$restaurant->getFeaturedImageByCif($restaurant_id); // Obtenemos los datos de la imagen principal del restaurante si existe mediante el CIF
        				
        	if(@$restaurant->consulta!=null){  // Si existe hacemos lo siguiente
        		foreach ($restaurant->consulta as $key => $value) {  // Recorremos el array y lo almacenamos en '$values'
					$tag->openTag('div','preview','',''); // Mostramos la foto 
						$tag->openTag('img','','preview',array('src'=>''.$value['src'].''));
						$tag->closeTag('img');
					$tag->closeTag('div');	
				}
        	}else{ // Si no existe mostramos la imagen por defecto
					$tag->openTag('div','preview','','');
						$tag->openTag('img','','preview',array('src'=>'images/not_found.png'));
						$tag->closeTag('img');
					$tag->closeTag('div');	        					  
        	}
        	?>
			<input type='hidden' id='url-archivo' />
			<label class='cargar'>
			subir<span>
        	<?php
			$input->addInput('file','FileInput','',array('id'=>'photoimg','class'=>'photoimg'));
			?>
			</span>
			</label>
			<?php
			$form->endForm(); // Cerramos el formulario

		$tag->closeTag('div');

		$tag->openTag('div','','galeria','');

			$tag->openTag('h3','','','');
			$tag->output('Imagenes Slider (Máximo 5 imagenes)');
			$tag->closeTag('h3');

			// Mostramos el formulario para subir las imagenes para el Slider
			
			$form->startForm("order_images.php","POST","fotos", array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 

		
			$cantidad=0;
			$restaurant->getImagesByCif($restaurant_id); // Dependiendo del tipo de categoria mostraremos unos articulos u otros
							
			if(isset($restaurant->consulta)!=null){ // Si existen productos en esta categoria mostramos
				$tag->openTag('div','','container','');
				
				foreach($restaurant->consulta as $key=>$values){ // Recorremos el array de la consulta
									
				$cantidad++;
				$id_image = $values['id_image'];

				$tag->openTag('div','','bloques','');

				$tag->openTag('p','','','');

					$tag->openTag('a','','',array('href'=>'#'));
					$tag->output('Subir');
					$tag->closeTag('a');	
					$tag->openTag('a','','',array('href'=>'#'));
					$tag->output('&nbsp;&nbsp;Bajar');
					$tag->closeTag('a');
				$tag->openTag('a','','',array('href'=>"delete_image.php?id=$id_image"));
					$tag->output('&nbsp;&nbsp;&nbsp;Eliminar&nbsp;&nbsp;&nbsp;');
			$tag->closeTag('a');

				$tag->closeTag('p');	

				$tag->openTag('a','','',array('href'=>"edit_image.php?id=$id_image"));

					$tag->openTag('img','','',array('src'=>"".$values['src'].""));
					$tag->closeTag('img');					
					
					$input->addInput('hidden',"position[]","$id_image",array('id'=>'','class'=>''));
				
				$tag->closeTag('a');
				$tag->closeTag('div');
				}
				$tag->closeTag('div');

			}else{

				$tag->output('No existen fotos');

			}
						
			$input->addInput('submit','','Guardar Cambios',array('id'=>'guardar_posicion','class'=>'btn'));
							
			$form->endForm(); // Cerramos el formulario
		?>

		<script type='text/javascript' src='../resources/js/order_photos.js'></script>
						
		<?php
		$tag->output('<br/>');
		if($cantidad<5){
		$tag->output('<br/>');
		$tag->openTag("h4","","","");
			$tag->output("Subir fotos nuevas");
		$tag->closeTag("h4");
		$tag->output('<br/>');
		$form->startForm('upload_images.php','POST','', array('name'=>'','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 

		$input->addInput("hidden","id_restaurant","$restaurant_id",array('id'=>'','class'=>''));
		$input->addInput("hidden","cantidad","$cantidad",array('id'=>'','class'=>''));

		$tag->openTag('div','inputs_file','','');					

		$tag->openTag('div','','','');	

			$input->addInput('hidden','titulo[]','',array('id'=>'','class'=>''));

			$input->addInput('file','FileInput[]','',array('id'=>'photoimg2','class'=>''));

		$tag->closeTag('div');

		$tag->closeTag('div');

		$input->addInput('submit','submit','agregar fotos',array('id'=>'','class'=>'boton'));

		$input->addInput('button','','+ foto',array('id'=>'otra_foto','class'=>'boton'));

		?>

		<script type='text/javascript' src='../resources/js/multi_files.js'></script>
	
		<?php
		$form->endForm(); // Cerramos el formulario
			
		}else if($cantidad>5){

		}
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