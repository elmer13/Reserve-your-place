<?php
	
	include_once '../../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante

   	if (isset($_GET['id']) === true) { // Nos aseguramos que se haya recibido un parámetro por GET 
         
		if(isset($_POST['submit'])){ // Comprobamos que se haya recibido la variable POST del 'submit'
				
			$transport_id 	= $_POST["id_transport"];
			$type_transport	= $_POST["type_transport"];
			$linea 			= trim($_POST["linea"]);
			$station		= trim($_POST["station"]);

			if(empty($errors) === true){  // Si no hay errores, llamamos a un método para editar los datos del transporte

				$restaurant->editTransport(array("type_transport"=>$type_transport, "linea"=>$linea,"station"=>$station,"id_transport"=>$transport_id));
				header("location:add_transport.php");

			}
		}else if(isset($_POST['cancel'])){ // Si se cancela la edición redireccionamos a la página de transporte

			header("location:add_transport.php");
			
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
	<title>Editar Transporte - Portal de Administración</title>
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
		$tag->output('Editar transportes públicos');
		$tag->closeTag('h2');

			$tag->openTag('div','','informacion_negocio','');

			$id_transport=trim($_GET['id']); // Almacenamos el parámetro recibido por get en la variable '$id_transport'
			
			$restaurant->getRestaurantTransportById($id_transport);  // Obtenemos los transportes del restaurante cuya id la pasamos por parámetro
			
			if(isset($restaurant->consulta)!=null){ // Siempre y cuando la consulta sea diferente de nulo hacemos lo siguiente
			
			foreach ($restaurant->consulta as $key => $value) {  // Recorremos el array y lo almacenamos en '$value'
			
			// Mostramos el formulario con los datos del transporte, por supuesto también los puede modificar
			
			$form->startForm('','POST','', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 

			$tag->openTag('div','','none-line','');						
			$tag->openTag('label','','',array('for'=>'codigo')); 
			$tag->output('Id Transporte: '); 
			$tag->closeTag('label');						
			$input->addInput('text','id_transport',$value['id_transport'],array('id'=>'cif_restaurant','placeholder'=>'','class'=>'infor','size'=>16, 'readonly'=>'readonly','required'=>'required'));
			$tag->closeTag('div');

			$tag->openTag('div','','line','');						
			$tag->openTag('label','','',array('for'=>'gender'));	
			$tag->output('Tipo de transportes: ');
			$tag->closeTag('label');			
			$name	= @$value['name'];
			$restaurant->getTypeTransport();

			foreach ($restaurant->consulta as $key => $values) {
						$array[0]= 'Seleccione una opción';
						$array[]=$values['name'];		
			}
			$form->addSelect('type_transport', $array,0,$name);
			$tag->closeTag('div');	

			$tag->openTag('div','','line','');
			$tag->openTag('label','','',array('for'=>'name')); 
			$tag->output('Línea: '); 
			$tag->closeTag('label');						
			$input->addInput('text','linea',$value['linea'],array('id'=>'name','placeholder'=>'','class'=>'infor','size'=>16, 'required'=>'required'));
			$tag->closeTag('div');

			$tag->openTag('div','','line','');
			$tag->openTag('label','','',array('for'=>'name')); 
			$tag->output('Estación: '); 
			$tag->closeTag('label');						
			$input->addInput('text','station',$value['station'],array('id'=>'name','placeholder'=>'','class'=>'infor','size'=>16, 'required'=>'required'));
			$tag->closeTag('div');

			$tag->openTag('div','','button-align-left','');
			$input->addInput('submit','cancel','Cancelar',array('id'=>'submit2','class'=>'btn'));
			$input->addInput('submit','submit','Guardar',array('id'=>'submit','class'=>'btn'));
			$tag->closeTag('div');
			$form->endForm(); // Cerramos el formulario
			}
		
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
	}else{ // Si no se recibe nada por GET redireccionamos a la Página Principal
		header('location: ../../index.php '); 
	}
	}else{  // Si el administrador del restaurante no ha iniciado sesión le redireccionamos a la Página Principal
		header('location: ../../index.php');
	}
?>