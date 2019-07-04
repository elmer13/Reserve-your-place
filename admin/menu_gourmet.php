<?php
	
	include_once '../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante

		// Controlamos las redirecciones a las diferentes pantallas

		if(isset($_POST['add-menu'])){
			header ('Location: admin_menu/add_menu.php');
		}
		else if (isset($_POST['add-gourmet'])){
			header ('Location: admin_gourmet/add_gourmet.php');
		}
		else if (isset($_POST['view-gourmets'])){
			header ('Location: admin_gourmet/gourmet_home.php');
		}
		else if (isset($_POST['view-menus'])){
			header ('Location: admin_menu/configure_menu.php');
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
	<title>Menus y Platos - Portal de Administración</title>
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
			$menu->cargarEnlace('table_restaurant.php','Mesas','','');
			$menu->cargarEnlace('menu_gourmet.php','Menus y Platos','','selected');
			$menu->cargarEnlace('reserve.php','Reservas','','');
			$menu->cargarEnlace('comments.php','Comentarios','','');
			$menu->mostrarHorizontal();	
			
			$tag->openTag('ul','','','');
			include_once '../includes/menu_top.php';  // Incluimos diferentes enlaces dependiendo si ha iniciado sesión en el Cliente, Portal de Usuario o Portal de Administración
			$tag->closeTag('ul');
			
		$tag->closeTag('div');
		
		// Cuerpo de la página
		$tag->openTag('div','contenedor','margen',''); 

			$tag->openTag('div','contenedor-table','','');
				
				$tag->openTag('div','contenedor-table-1','','');
					
					$form->startForm('','POST','', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 
						
						$tag->openTag('div','','title-menu','');
						
							$tag->openTag('h2','','','');
							$tag->output('Mis Menús');
							$tag->closeTag('h2');
						
						$tag->closeTag('div');
						
						$tag->openTag('div','','button-container','');

						$tag->openTag('div','','button-align-left-2','');

						$input->addInput('submit','add-menu','Añadir Menú',array('id'=>'submit','class'=>'btn3'));
						
						if($restaurant->getCountsMenuByCif($restaurant_id) != 0){ // Si existe un menú mostramos esta opción

							$input->addInput('submit','view-menus','Configurar Menús',array('id'=>'submit','class'=>'btn3'));

						}
						$tag->closeTag('div');

						$tag->closeTag('div');
						
						// Creamos una tabla para mostrar los detalles del menu
						$tag->openTag('table','','board-table',array('border'=>'2'));
					
								// Definimos la cabecera de la tabla
								$tag->openTag('tr','','board-table-tr','');

									$tag->openTag('td','','','');
										$tag->output('Menú');
									$tag->closeTag('td');
									$tag->openTag('td','','','');
										$tag->output('Precio');
									$tag->closeTag('td');
									$tag->openTag('td','','','');
										$tag->output('Descripción');
									$tag->closeTag('td');
									$tag->openTag('td','','','');
										$tag->output('Editar');
									$tag->closeTag('td');
									$tag->openTag('td','','','');
										$tag->output('Configuración');
									$tag->closeTag('td');
									$tag->openTag('td','','','');
										$tag->output('Eliminar');
									$tag->closeTag('td');

								$tag->closeTag('tr');

							$restaurant->getMenuByCif($restaurant_id); // Obtenemos los datos de los menús que ha añadido el administrador del restaurante teniendo en cuenta su ID

							if(isset($restaurant->consulta)!=null){  // Siempre y cuando la consulta sea diferente de nulo hacemos lo siguiente

								foreach ($restaurant->consulta as $key => $values) { // Recorremos el array y lo almacenamos en '$values'

									// Mostramos los menús del restaurante
									$tag->openTag('tr','','','');
										$tag->openTag('td','','','');
											$tag->output(''.$values['name'].'');
										$tag->closeTag('td');
										$tag->openTag('td','','','');
											$tag->output(''.$values['price'].' €');
										$tag->closeTag('td');
										$tag->openTag('td','','','');
											$tag->output(''.$values['description'].'');
										$tag->closeTag('td');
										$tag->openTag('td','','','');
											$tag->openTag('a','','',array('href'=>'admin_menu/edit_menu_info.php?id_menu='.$values['id_menu']));
												$tag->openTag('img','','',array('src'=>'../site_media/img/edit.png','width'=>'30','height'=>'30'));
												$tag->closeTag('img');
											$tag->closeTag('a');
										$tag->closeTag('td');
										$tag->openTag('td','','','');
											$tag->openTag('a','','',array('href'=>'admin_menu/configure_menu.php?menu_id='.$values['id_menu']));
												$tag->openTag('img','','',array('src'=>'../site_media/img/settings.png','width'=>'30','height'=>'30'));
												$tag->closeTag('img');
											$tag->closeTag('a');
										$tag->closeTag('td');
										$tag->openTag('td','','','');
											$tag->openTag('a','','',array('href'=>'admin_menu/delete_menu_info.php?id_menu='.$values['id_menu']));
												$tag->openTag('img','','',array('src'=>'../site_media/img/delete.png','width'=>'30','height'=>'30'));
												$tag->closeTag('img');
											$tag->closeTag('a');
										$tag->closeTag('td');
									$tag->closeTag('tr');

								}

							}
						
						$tag->closeTag('table'); // Cerramos la tabla

					$form->endForm(); // Cerramos el formulario

				$tag->closeTag('div');

				$tag->openTag('div','contenedor-table-2','','');

					$form->startForm('','POST','', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 

						$tag->openTag('div','','title-menu','');
							$tag->openTag('h2','','','');
								$tag->output('Mi Gourmet');
							$tag->closeTag('h2');
						$tag->closeTag('div');

						$tag->openTag('div','','button-container','');
						
						$tag->openTag('div','','button-align-left-2','');
							
							$input->addInput('submit','add-gourmet','Añadir Gourmet',array('id'=>'submit','class'=>'btn3'));

							if($restaurant->getCountsGourmetByCif($restaurant_id) != 0){ // Si existe un plato mostramos esta opción

								$input->addInput('submit','view-gourmets','Ver y configurar mis Gourmets',array('id'=>'submit','class'=>'btn3'));

							}

						$tag->closeTag('div');

						$tag->closeTag('div');

						// Creamos una tabla para mostrar los detalles de los platos
						$tag->openTag('table','','board-table',array('border'=>'2'));
							
							// Definimos la cabecera de la tabla
							$tag->openTag('tr','','board-table-tr','');

								$tag->openTag('td','','','');
									$tag->output('Categoría');
								$tag->closeTag('td');
								$tag->openTag('td','','','');
									$tag->output('Gourmet');
								$tag->closeTag('td');
								$tag->openTag('td','','','');
									$tag->output('Precio');
								$tag->closeTag('td');
								$tag->openTag('td','','','');
									$tag->output('Descripción');
								$tag->closeTag('td');

							$tag->closeTag('tr');

							$restaurant->getGourmetRecomendationOkByCif($restaurant_id); // Obtenemos los datos de los platos recomendados que ha seleccionado el administrador del restaurante teniendo en cuenta su ID

							if(isset($restaurant->consulta)!=null){ // Siempre y cuando la consulta sea diferente de nulo hacemos lo siguiente

								foreach ($restaurant->consulta as $key => $values) { // Recorremos el array y lo almacenamos en '$values'

									$tag->openTag('tr','','','');

										$tag->openTag('td','','','');
											$tag->output($restaurant->getNameByIdTypeGourmet($values['type_gourmet']));
										$tag->closeTag('td');
										$tag->openTag('td','','','');
											$tag->output($values['name_gourmet']);
										$tag->closeTag('td');
										$tag->openTag('td','','','');
											$tag->output($values['price']);
										$tag->closeTag('td');
										$tag->openTag('td','','','');
											$tag->output($values['description']);
										$tag->closeTag('td');

									$tag->closeTag('tr');

								}

							}

						$tag->closeTag('table'); // Cerramos la tabla

					$form->endForm();

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
		header('location: ../index.php');
	}
?>