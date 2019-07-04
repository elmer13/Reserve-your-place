<?php
	
	include_once '../../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante
	
		if(isset($_POST['view-type-gourmet'])){
			header ("Location: gourmet_home.php?type=".$_POST['type_gourmet']);
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
	<title>Reserve your place</title>
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
		$tag->openTag("div","contenedor","margen",""); 
				$tag->openTag("div","contenedor-table","","");
					$form->startForm("","POST","", array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 
						$tag->openTag("div","","title-menu","");
							$tag->openTag("h2","","","");
								$tag->output("Zona Gourmet");
							$tag->closeTag("h2");
						$tag->closeTag("div");
						$tag->openTag("div","","line","");						
							$tag->output("Tipo de Platos: ");		
							$restaurant->getTypeGourmet();
							foreach ($restaurant->consulta as $key => $value) {
								$array[0]= "Mostrar todos";
								$array[]=$value["name"];		
							}
							if(isset($_POST['type_gourmet'])){
								$form->addSelect("type_gourmet", $array,$_POST['type_gourmet']);
							}
							else{
								$form->addSelect("type_gourmet", $array, 0);
							}
							$input->addInput("submit","view-type-gourmet","Mostrar",array('id'=>'submit','class'=>'btn4'));
						$tag->closeTag("div");
						$tag->openTag("table","","board-table",array('border'=>'2'));
							$tag->openTag("tr","","board-table-tr","");
								$tag->openTag("td","","","");
									$tag->output("Categoría");
								$tag->closeTag("td");
								$tag->openTag("td","","","");
									$tag->output("Gourmet");
								$tag->closeTag("td");
								$tag->openTag("td","","","");
									$tag->output("Precio");
								$tag->closeTag("td");
								$tag->openTag("td","","","");
									$tag->output("Descripción");
								$tag->closeTag("td");
								$tag->openTag("td","","","");
									$tag->output("Editar");
								$tag->closeTag("td");
								$tag->openTag("td","","","");
									$tag->output("Eliminar");
								$tag->closeTag("td");
							$tag->closeTag("tr");
							if(isset($_GET['type']) != 0){
								$restaurant->getGourmetsByIdTypeGourmet($restaurant_id,$_GET['type']);
							}
							else{
								$restaurant->getGourmetByCif($restaurant_id);
							}
							if(isset($restaurant->consulta)!=null){
								foreach ($restaurant->consulta as $key => $values) {
									$tag->openTag("tr","","","");
										$tag->openTag("td","","","");
											$tag->output($restaurant->getNameByIdTypeGourmet($values['type_gourmet']));
										$tag->closeTag("td");
										$tag->openTag("td","","","");
											$tag->output($values['name_gourmet']);
										$tag->closeTag("td");
										$tag->openTag("td","","","");
											$tag->output($values['price']);
										$tag->closeTag("td");
										$tag->openTag("td","","","");
											$tag->output($values['description']);
										$tag->closeTag("td");
										$tag->openTag("td","","","");
											$tag->openTag("a","","",array('href'=>'edit_gourmet_info.php?id_gourmet='.$values['id_gourmet']));
												$tag->openTag("img","","",array('src'=>'../../site_media/img/edit.png','width'=>'30','height'=>'30'));
												$tag->closeTag("img");
											$tag->closeTag("a");
										$tag->closeTag("td");
										$tag->openTag("td","","","");
											$tag->openTag("a","","",array('href'=>'delete_gourmet_info.php?id_gourmet='.$values['id_gourmet']));
												$tag->openTag("img","","",array('src'=>'../../site_media/img/delete.png','width'=>'30','height'=>'30'));
												$tag->closeTag("img");
											$tag->closeTag("a");
										$tag->closeTag("td");
									$tag->closeTag("tr");
								}
							}
						$tag->closeTag("table");
					$form->endForm();
			$tag->closeTag("div");
		$tag->closeTag("div");	
		$tag->openTag("div","footer","","");
			$tag->openTag("a","","","");
				$tag->output("&copy;  2014 - 2015 Reserveyourplace.com - Todos los derechos reservados");
			$tag->closeTag("a");
		$tag->closeTag("div");
	?>
</body>
</html>

<?php
	}else{ // Si el administrador del restaurante no ha iniciado sesión le redireccionamos a la Página Principal
		header('location: ../../index.php');
	}
?>