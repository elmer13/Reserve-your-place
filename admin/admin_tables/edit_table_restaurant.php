<?php
	
	include_once '../../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante
	
		if(isset($_POST['submit'])){ // Comprobamos que se haya recibido la variable POST del 'submit'
			
				$table_id = $_POST['id_table'];
				$number_table   = htmlentities(trim($_POST['number_table']));
				$number_people = htmlentities(trim($_POST['number_people']));

				if(empty($errors) === true){  // Si no hay errores, llamamos a un método para editar la mesa del restaurante

					$restaurant->editTableRestaurant(array('number_table'=>$number_table,'number_people'=>$number_people,'id_table'=>$table_id));
					$correct[] = 'Los datos han sido modificados correctamente.';
					header('location:../table_restaurant.php');
				}
			}else if(isset($_POST['cancel'])){ // Si se cancela la edición redireccionamos a la página de mesas

			header("location:../table_restaurant.php");

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
	<title>Editar Mesa - Portal de Administración</title>
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
		$tag->output('Editar información de mesa');
		$tag->closeTag('h2');
		
			$tag->openTag('div','','informacion_negocio','');
			
			if (isset($_GET['id_table']) === true) { // Si recibimos un parámetro por GET lo guardamos en la variable '$id_table' y seguimos
			
				$id_table=trim($_GET['id_table']);
				
			}else{ // En caso contrario redireccionamos a la Página Principal
			
				header('location: ../../index.php');
				
			}
			
			$restaurant->getTableRestaurantById($id_table); // Obtenemos las mesas del restaurante cuya id la pasamos por parámetro
			
			if(isset($restaurant->consulta)!=null){ // Siempre y cuando la consulta sea diferente de nulo hacemos lo siguiente
			
				foreach ($restaurant->consulta as $key => $value) { // Recorremos el array y lo almacenamos en '$value'
				
					$form->startForm('','POST','', array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 
					
						// Mostramos el formulario con los datos de la mesa, por supuesto también los puede modificar
						
						$tag->openTag('div','','none-line','');						
							$tag->openTag('label','','',array('for'=>'codigo')); 
								$tag->output('Id Transporte: '); 
							$tag->closeTag('label');						
							$input->addInput('text','id_table',$value['id_table'],array('id'=>'cif_restaurant','placeholder'=>'','class'=>'infor','size'=>16, 'readonly'=>'readonly','required'=>'required'));
						$tag->closeTag('div');
						$tag->openTag('div','','line','');						
							$tag->openTag('label','','',array('for'=>'name_table')); 
								$tag->output('Número mesa: '); 
							$tag->closeTag('label');						
							$input->addInput('text','number_table',$value['name'],array('id'=>'number_table','placeholder'=>'Número mesa','class'=>'infor','size'=>14, 'readonly'=>'','required'=>'required'));
						$tag->closeTag('div');
						$tag->openTag('div','','line','');						
							$tag->openTag('label','','',array('for'=>'number_people')); 
								$tag->output('Número personas: '); 
							$tag->closeTag('label');						
							$input->addInput('text','number_people',$value['number_people'],array('id'=>'number_person','placeholder'=>'Número personas','class'=>'infor','size'=>14, 'readonly'=>'','required'=>'required'));
						$tag->closeTag('div');
						$tag->openTag('div','','button-align-left','');
							$input->addInput("submit","cancel","Cancelar",array('id'=>'reset','class'=>'btn'));
							$input->addInput('submit','submit','Guardar',array('id'=>'submit','class'=>'btn'));
						$tag->closeTag('div');
					$form->endForm();
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