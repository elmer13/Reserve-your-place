<?php
	
	include_once '../../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante

   	if (isset($_GET['id']) === true) { // Nos aseguramos que se haya recibido un parámetro por GET 
	
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
	<title>Editar Imagenes Slider - Portal de Administración</title>
	<script type="text/javascript" >
	 $(document).ready(function() { 
			
	            $('#photoimg2').live('change', function()			{ 
				           $("#preview2").html('');
				    $("#preview2").html('<img src="../resources/loader.gif" alt="Uploading...."/>');
				$("#imageform2").ajaxForm({
							target: '#preview2'
			}).submit();
			
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
		$tag->openTag('div','contenedor','margen','');
		
		$tag->openTag('h2','','','');
		$tag->output('Editar imagenes slider');
		$tag->closeTag("h2");
		
			$tag->openTag('div','','profile_picture',''); 

				// Mostramos el formulario con el cual editará las fotos del slider
				
				$form->startForm('validate_edit_image.php','POST','imageform2', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 

				$id_image = $_GET['id'];  // Almacenamos el parámetro recibido por get en la variable '$id_image'
				
				$restaurant->getImageById($id_image);  // Obtenemos las imagenes restaurante cuya id la pasamos por parámetro
				
				$tag->openTag('div','preview2','','');

				if($restaurant->consulta!=null){ // Siempre y cuando la consulta sea diferente de nulo hacemos lo siguiente
				
					foreach ($restaurant->consulta as $key => $value) { // Recorremos el array y lo almacenamos en '$value'

						echo "<img src='".$value["src"]."'  class='images'>"; 

					}
				}

				$tag->closeTag('div');

				$input->addInput('file','FileInput2','',array('id'=>'photoimg2','placeholder'=>'','class'=>'','size'=>16, 'required'=>'required','step'=>1800));	

				$input->addInput('hidden','id_image',$id_image,array('id'=>'id_image','placeholder'=>'','class'=>'','size'=>16, 'required'=>'required','step'=>1800));
				

				$form->endForm(); // Cerramos el formulario

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
	}else{ // Si no se recibe nada por GET redireccionamos a la Página Principal
		header('location: ../../index.php '); 
	}
	}else{  // Si el administrador del restaurante no ha iniciado sesión le redireccionamos a la Página Principal
		header('location: ../../index.php');
	}
?>