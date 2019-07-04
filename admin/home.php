<?php
	
	include_once '../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante
		
		// Definimos variables globales que utilizaremos posteriormente para mostrar las mesas
		$table_container = 10;
		$table_count = 0;
		
		if(isset($_POST['search-reserve'])){
			header ("Location: home.php?date=".$_POST['date']."&time=".$_POST['time']);
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
	<title>Home - Portal de Administración</title>
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
		
			$menu->cargarEnlace('home.php','Home','','selected',array('onclick'=>''));
			$menu->cargarEnlace('add_restaurant.php','Informacion','','');
			$menu->cargarEnlace('table_restaurant.php','Mesas','','');
			$menu->cargarEnlace('menu_gourmet.php','Menus y Platos','','');
			$menu->cargarEnlace('reserve.php','Reservas','','');
			$menu->cargarEnlace('comments.php','Comentarios','','');
			$menu->mostrarHorizontal();	
			
			$tag->openTag('ul','','','');
			include_once '../includes/menu_top.php';  // Incluimos diferentes enlaces dependiendo si ha iniciado sesión en el Cliente, Portal de Usuario o Portal de Administración
			$tag->closeTag('ul');
			
		$tag->closeTag('div');
		
		// Cuerpo de la página
		$tag->openTag('div','contenedor','',''); 
			
				$tag->openTag('div','','conatiner-home-admin1','');
					$form->startForm('','POST','', array('name'=>'frmempleado','class'=>'','enctype'=>'multipart/form-data', 'onsubmit'=>''));
					// Filtro para buscar las diferentes mesas del restaurante teniendo en cuenta la fecha y la hora
					$tag->openTag('div','','date-time-home-admin','');

						$tag->output('Fecha de Reserva: ');					
							if(isset($_GET['date'])){
								$input->addInput('date','date',$_GET['date'],array('id'=>'date','placeholder'=>'','class'=>'','size'=>14, 'readonly'=>'','required'=>'required'));
							}
							else{
								$input->addInput('date','date',date('Y-m-d'),array('id'=>'date','placeholder'=>'','class'=>'','size'=>14, 'readonly'=>'','required'=>'required'));
							}
						$tag->output('Hora: '); 						
							if(isset($_GET['date'])){
								$input->addInput('time','time',$_GET['time'],array('id'=>'time','placeholder'=>'','class'=>'','size'=>14, 'readonly'=>'','required'=>'required'));
							}
							else{
								$input->addInput('time','time',date('H:00:00'),array('id'=>'time','placeholder'=>'','class'=>'','size'=>14, 'readonly'=>'','required'=>'required'));
							}

					$tag->closeTag('div');

					$tag->openTag('div','','button-home-admin','');
							$input->addInput('submit','search-reserve','Reservar',array('id'=>'submit','class'=>'btn'));
					$tag->closeTag('div');
					
				$tag->closeTag('div');
			$form->endForm();
			$tag->openTag('div','','container-home-admin2-border','');

				if(isset($_GET['date']) && isset($_GET['time'])){
					$restaurant->getNameNumberPeopleByCif($restaurant_id,$_GET['date'],$_GET['time']); // Obtenemos las mesas enviandole como parámetro la id del restaurante
				}
				if(!isset($_GET['date']) && !isset($_GET['time'])){
					$restaurant->getNameNumberPeopleByCif($restaurant_id,date('Y-m-d'),date('H:00:00')); // Obtenemos las mesas enviandole como parámetro la id del restaurante
				}
				$tag->openTag('div','','container-home-admin2','');

					if(isset($restaurant->consulta)!=null){  // Si el resultado de la consulta es diferente de nulo hacemos lo siguiente

						foreach ($restaurant->consulta as $key => $value) { // Recorremos los resultados y los mostramos con '$values'

							// Mostramos las mesas de 10 en 10 
							$table_count++;

							if(($table_container/$table_count) === 1){

								$table_container = $table_container + 10;

								$tag->closeTag('div');

								$tag->openTag('div','','container-home-admin2','');

									$tag->openTag('div','','line','');
										$tag->openTag('p','','','');
											$tag->output('Mesa '.$restaurant->getNameTableRestaurantById($value['id_table']).': '.$value['name'].'-'.$value['number_people'].' personas');
										$tag->closeTag('p');
									$tag->closeTag('div');

							}else if(($table_container/$table_count) != 0){

								$tag->openTag('div','','line','');	
									$tag->openTag('p','','','');
										$tag->output('Mesa '.$restaurant->getNameTableRestaurantById($value['id_table']).': '.$value['name'].'-'.$value['number_people'].'  personas');
									$tag->closeTag('p');
								$tag->closeTag('div');

							}else{

								$tag->closeTag('div');

							}

						}

						$tag->closeTag('div');

					}
					
					else{
						$tag->openTag('div','','line','');
							$tag->openTag('p','','','');
								$tag->output('No hay reservas actualmente.');
							$tag->closeTag('p');
						$tag->closeTag('div');
					$tag->closeTag('div');
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
		header('location: ../index.php');
	}
?>