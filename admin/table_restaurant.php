<?php
	
	include_once '../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante
	
		if(isset($_POST['submit'])){ // Comprobamos que se haya recibido la variable POST del 'submit'

				// Almacenamos en variables los datos recibidos
				$cif_restaurante = trim($restaurant_id);
				$number_table 	 = trim($_POST['number_table']);
				$number_people	 = trim($_POST['number_people']);

				if(empty($errors) === true){  // Si no hay errores, llamamos a un método para añadir la mesa en el restaurante determinado
					$restaurant->addTableRestaurant(array('cif_restaurant'=>$cif_restaurante, 'number_table'=>$number_table,'number_people'=>$number_people));
					header('location:table_restaurant.php');
					$correct[] = 'Se ha añadido una mesa a tu plataforma.';
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
	<link rel='stylesheet' type='text/css' href='../site_media/css/style.css'/>
	<link rel='shortcut icon' href='../site_media/img/favicon.ico'/>
	<script type='text/javascript' src='../site_media/js/jquery-1.11.0.min.js'></script>
	<script type='text/javascript' src='../site_media/js/scrollTop.js'></script>
	<script type='text/javascript' src='../site_media/js/btn_movil.js'></script>
	<title>Mesas - Portal de Administración</title>
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
				$tag->openTag('a','','',array('href'=>'home.php'));
					$tag->openTag('img','','',array('src'=>'../site_media/img/icon-reserveyourplace.png','width'=>'70','height'=>'50'));
					$tag->closeTag('img');
				$tag->closeTag('a');
			$tag->closeTag('div');

			$tag->openTag('div','','title',''); // Titulo de la cabecera
				$tag->openTag('h2','','','');
					$tag->openTag('a','','',array('href'=>'home.php'));
						$tag->output('Portal de Administración');
					$tag->closeTag('a');
				$tag->closeTag('h2');
			$tag->closeTag('div');

		$tag->closeTag('div');

		// Sistema de navegación
		$tag->openTag('div','','menutop','');

			$tag->openTag('a','nav-mobile','nav-mobile',array('href'=>'#'));
			$tag->closeTag('a');
		
			$menu->cargarEnlace('home.php','Home','','',array('onclick'=>''));
			$menu->cargarEnlace('add_restaurant.php','Informacion','','');
			$menu->cargarEnlace('table_restaurant.php','Mesas','','selected');
			$menu->cargarEnlace('menu_gourmet.php','Menus y Platos','','');
			$menu->cargarEnlace('reserve.php','Reservas','','');
			$menu->cargarEnlace('comments.php','Comentarios','','');
			$menu->mostrarHorizontal();	
			
			$tag->openTag('ul','','','');
			include_once '../includes/menu_top.php';  // Incluimos diferentes enlaces dependiendo si ha iniciado sesión en el Cliente, Portal de Usuario o Portal de Administración
			$tag->closeTag('ul');
			
		$tag->closeTag('div');

		// Cuerpo de la página
		$tag->openTag('div','contenedor','margen',''); 

		$tag->openTag('h2','','','');
			$tag->output('Mis Mesas');
		$tag->closeTag('h2');

		// Mostramos el formulario con los campos para agregar mesas

		$tag->openTag('div','','informacion_negocio','');
				
			$form->startForm('','POST','', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 
				
				$tag->openTag('div','','line','');
					$tag->openTag('label','','',array('for'=>'number_table')); 
						$tag->output('Número de Mesa: '); 
					$tag->closeTag('label');						
					$input->addInput('text','number_table','',array('id'=>'number_table','placeholder'=>'Número de mesa','class'=>'infor','size'=>16, 'required'=>'required'));
				$tag->closeTag('div');

				$tag->openTag('div','','line','');
					$tag->openTag('label','','',array('for'=>'number_people')); 
						$tag->output('Número de Personas: '); 
					$tag->closeTag('label');						
					$input->addInput('text','number_people','',array('id'=>'number_people','placeholder'=>'Número de Personas','class'=>'infor','size'=>16, 'required'=>'required'));
				$tag->closeTag('div');

				$tag->openTag('div','','button-align-left','');
					$input->addInput('submit','submit','Añadir Mesa',array('id'=>'submit','class'=>'btn2'));
				$tag->closeTag('div');

			$form->endForm(); // Cerramos el formulario

		$tag->closeTag('div');

			$tag->openTag('div','contenedor-table-1','','');

				// Creamos una tabla para mostrar los detalles de las mesas añadidas
				$tag->openTag('table','','board-table',array('border'=>'2'));
					
					// Definimos la cabecera de la tabla
					$tag->openTag('tr','','board-table-tr','');
						
						$tag->openTag('td','','','');
							$tag->output('Número mesa');
						$tag->closeTag('td');
						$tag->openTag('td','','','');
							$tag->output('Número de Personas');
						$tag->closeTag('td');
						$tag->openTag('td','','','');
							$tag->output('Editar');
						$tag->closeTag('td');
						$tag->openTag('td','','','');
							$tag->output('Eliminar');
						$tag->closeTag('td');
						
					$tag->closeTag('tr');

					$restaurant->getTableRestaurantsByCif($restaurant_id); // Obtenemos los datos de las mesas que ha añadido el administrador del restaurante teniendo en cuenta su ID

					if(isset($restaurant->consulta)!=null){ // Siempre y cuando la consulta sea diferente de nulo hacemos lo siguiente
						
						foreach ($restaurant->consulta as $key => $values) {  // Recorremos el array y lo almacenamos en '$values'
								
						// Mostramos las mesas del restaurante
						$tag->openTag('tr','','','');
										
							$tag->openTag('td','','','');
								$tag->output(''.$values['name'].'');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->output(''.$values['number_people'].'');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->openTag('a','','',array('href'=>'admin_tables/edit_table_restaurant.php?id_table='.$values['id_table']));
									$tag->openTag('img','','',array('src'=>'../site_media/img/edit.png','width'=>'30','height'=>'30'));
									$tag->closeTag('img');
								$tag->closeTag('a');
							$tag->closeTag('td');
							$tag->openTag('td','','','');
								$tag->openTag('a','','',array('href'=>'admin_tables/delete_table_restaurant.php?id_table='.$values['id_table']));
									$tag->openTag('img','','',array('src'=>'../site_media/img/delete.png','width'=>'30','height'=>'30'));
									$tag->closeTag('img');
								$tag->closeTag('a');
							$tag->closeTag('td');
								
						$tag->closeTag('tr');
						
						}
							
					}

				$tag->closeTag('table'); // Cerramos la tabla				

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
		header('location: ../index.php');
	}
?>