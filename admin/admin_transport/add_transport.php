<?php
	
	include_once '../../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante

	    if (isset($_GET['error']) === true) { // Si recibe como parámetro por un método GET 'error' lo notificamos 

	  		if($_GET['error']==1){

	        	$error[] = '<h3>Fallo en la operación.</h3>';	

	    	}

	  		if($_GET['error']==2){

	        	$error[] = '<h3>Fallo en el servidor.</h3>';	        

	    	}

	    }

		if(isset($_POST['submit'])){ // Comprobamos que se haya recibido la variable POST del 'submit'

			$type_transport = htmlentities(trim($_POST["type_transport"]));
			$linea 			= trim($_POST["linea"]);
			$station		= trim($_POST["station"]);

			if(empty($errors) === true){ // Si no hay errores, llamamos a un método para añadir el transporte del restaurante tanto a la tabla transport como restaurant_transport

				$restaurant->addTransport(array("type_transport"=>$type_transport, "linea"=>$linea,"station"=>$station));
				$restaurant->addRestaurantTransport($restaurant_id);
				header("location:add_transport.php");
			}
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
	<title>Añadir Transporte - Portal de Administración</title>
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
		$tag->output('Añadir transportes públicos');
		$tag->closeTag('h2');

			// Mostramos el formulario con los campos requeridos para añadir transporte

			$tag->openTag('div','','informacion_negocio','');

				$form->startForm('','POST','', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 

				$tag->openTag('div','','line','');						
				$tag->openTag('label','','',array('for'=>'type_transport'));	
				$tag->output('Tipo de Transportes: ');
				$tag->closeTag('label');			

				$restaurant->getTypeTransport(); // Recogemos los datos de la tabla type_transport de la base de datos

				foreach ($restaurant->consulta as $key => $value) { // Recorremos los resultado y lo vamos añadiendo a un array para posteriormente enviarlo 
					$array[0]= 'Seleccione una opción';
					$array[]=$value['name'];		
				}
				$form->addSelect('type_transport', $array,0);
				$tag->closeTag('div');	

				$tag->openTag('div','','line','');
				$tag->openTag('label','','',array('for'=>'linea')); 
				$tag->output('Línea: '); 
				$tag->closeTag('label');						
				$input->addInput('text','linea','',array('id'=>'linea','placeholder'=>'','class'=>'infor','size'=>16, 'required'=>'required'));
				$tag->closeTag('div');

				$tag->openTag('div','','line','');
				$tag->openTag('label','','',array('for'=>'station')); 
				$tag->output('Estación: '); 
				$tag->closeTag('label');						
				$input->addInput('text','station','',array('id'=>'station','placeholder'=>'','class'=>'infor','size'=>16, 'required'=>'required'));
				$tag->closeTag('div');
					
				$tag->openTag('div','','button-align-left','');
				$input->addInput('reset','','Cancelar',array('id'=>'reset','class'=>'btn'));
				$input->addInput('submit','submit','Guardar',array('id'=>'submit','class'=>'btn'));
				$tag->closeTag('div');

				$form->endForm(); // Cerramos el formulario

			$tag->closeTag('div');

			$tag->openTag('div','contenedor-table-1','','');

				// Creamos una tabla para mostrar los detalles de los transportes añadidos
				$tag->openTag('table','','board-table',array('border'=>'2'));

					// Definimos la cabecera de la tabla
					$tag->openTag('tr','','board-table-tr','');

						$tag->openTag('td','','','');
							$tag->output('Tipo de transportes');
						$tag->closeTag('td');
						$tag->openTag('td','','','');
							$tag->output('Línea');
						$tag->closeTag('td');
						$tag->openTag('td','','','');
								$tag->output('Estación');
						$tag->closeTag('td');
						$tag->openTag('td','','','');
							$tag->output('Editar');
						$tag->closeTag('td');
						$tag->openTag('td','','','');
							$tag->output('Eliminar');
						$tag->closeTag('td');

					$tag->closeTag('tr');

				$restaurant->getRestaurantTransportByCif($restaurant_id); // Obtenemos los datos de las transportes que ha añadido el administrador del restaurante teniendo en cuenta su ID

				if(isset($restaurant->consulta)!=null){ // Siempre y cuando la consulta sea diferente de nulo hacemos lo siguiente

					foreach ($restaurant->consulta as $key => $values) {  // Recorremos el array y lo almacenamos en '$values'
								
						// Mostramos los transportes del restaurante

						$tag->openTag('tr','','','');

							$tag->openTag('td','','','');
								$tag->output(''.$values['name'].'');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->output(''.$values['linea'].'');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->output(''.$values['station'].'');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->openTag('a','','',array('href'=>'edit_transport.php?id='.$values['id_transport'].''));
								$tag->openTag('img','','',array('src'=>'../../site_media/img/edit.png','width'=>'30','height'=>'30'));
								$tag->closeTag('img');
								$tag->closeTag('a');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->openTag('a','','',array('href'=>'delete_transport.php?id='.$values['id_transport'].''));
									$tag->openTag('img','','',array('src'=>'../../site_media/img/delete.png','width'=>'30','height'=>'30'));
									$tag->closeTag('img');
								$tag->closeTag('a');
							$tag->closeTag('td');

						$tag->closeTag('tr');	
							
					}

				}

				$tag->closeTag('table'); // Cerramos la tabla

				if(isset($error)!=null){ // Si hay imprevistos, los mostramos 

					foreach($error as $errores){
						$tag->output('<h2>'.$errores.'</h2>');
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
	}else{ // Si el administrador del restaurante no ha iniciado sesión le redireccionamos a la Página Principal
		header('location: ../../index.php');
	}
?>