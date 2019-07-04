<?php
	
	include_once '../../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante
		$error = '';
		if(isset($_GET['error'])){
			$error = '<h3>Ya existe 5 Gourmets recomendados.</h3><br/><h3>Recuerda que tienes un máximo de 5 recomendaciones</h3>';
		}
		if(isset($_POST['submit'])){ // Comprobamos que se haya recibido la variable POST del 'submit'
				$cif_restaurante = htmlentities(trim($restaurant_id));
				$type_gourmet = htmlentities(trim($_POST['type_gourmet']));
				$name 	 = trim($_POST['name_gourmet']);
				$price	 = htmlentities(trim($_POST['price_gourmet']));
				$description = trim($_POST['description']);
				
				if(isset($_POST['recomendation_ok']) && !isset($_POST['recomendation_nok'])){
					$recomendation = htmlentities(trim(1));
				}
				if(isset($_POST['recomendation_nok']) && !isset($_POST['recomendation_ok'])){
					$recomendation = htmlentities(trim(0));
				}

				if(empty($errors) === true){  
					if($restaurant->getCountsRecomendationGourmetByCif($restaurant_id) == 5 && isset($_POST['recomendation_ok'])){
						$error = '<h3>Ya existe 5 Gourmets recomendados.</h3><br/><h3>Recuerda que tienes un máximo de 5 recomendaciones</h3>';
						header('location:add_gourmet.php?error='.$error);
					}
					else{
						$restaurant->addGourmet(array('cif_restaurant'=>$cif_restaurante,'type_gourmet'=>$type_gourmet, 'name'=>$name,'price'=>$price, 'description'=>$description,'recomendation'=>$recomendation));
						header('location:../menu_gourmet.php');
					}
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
	<title>Añadir Gourmet - Portal de Administración</title>
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
			$tag->openTag("h2","","","");
				$tag->output("Añadir nuevo gourmet");
			$tag->closeTag("h2");
			$tag->openTag("div","","informacion_negocio","");
				$form->startForm("","POST","", array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 
					$tag->openTag("div","","line","");						
						$tag->openTag("label","","",array("for"=>"type_gourmet"));	
							$tag->output("Tipo de Platos: ");
						$tag->closeTag("label");			

						$restaurant->getTypeGourmet();

						foreach ($restaurant->consulta as $key => $value) {
							$array[0]= "Seleccione una opción";
							$array[]=$value["name"];		
						}
						$form->addSelect("type_gourmet", $array,0);
					$tag->closeTag("div");
					$tag->openTag("div","","line","");						
						$tag->openTag("label","","",array("for"=>"name_gourmet")); 
							$tag->output("Nombre Gourmet: "); 
						$tag->closeTag("label");						
						$input->addInput("text","name_gourmet","",array("id"=>"name_gourmet","placeholder"=>"Nombre menú",'class'=>'infor','size'=>14, "readonly"=>"","required"=>"required"));
					$tag->closeTag("div");
					$tag->openTag("div","","line","");						
						$tag->openTag("label","","",array("for"=>"price_gourmet")); 
							$tag->output("Precio Gourmet: "); 
						$tag->closeTag("label");						
						$input->addInput("text","price_gourmet","",array("id"=>"price_gourmet","placeholder"=>"Precio menú",'class'=>'infor','size'=>14, "readonly"=>"","required"=>"required"));
					$tag->closeTag("div");
					$tag->openTag("div","","line","");
						$tag->openTag("label","","",array("for"=>"description")); 
							$tag->output("Descripción: "); 
						$tag->closeTag("label");	
						$form->addTextarea("description",5,39,"",array("class"=>"textarea", "maxlength"=>100,"placeholder"=>"Añadir una descripción"));
						$form->closeTextarea();
					$tag->closeTag("div");
					$tag->openTag("div","","line","");
						$tag->openTag("label","","",array("for"=>"description")); 
							$tag->output("Recomendarías este plato en tu perfil?: "); 
						$tag->closeTag("label");
						$tag->openTag("div","","","");
							$form->addInput("checkbox","recomendation_ok","Sí",array("id"=>"check_ok","placeholder"=>"",'size'=>16));
								$tag->output("Sí");
							$form->addInput("checkbox","recomendation_nok","No",array("id"=>"check_nok","placeholder"=>"",'size'=>16));
								$tag->output("No");
						$tag->closeTag("div");
					$tag->closeTag("div");
				$tag->openTag("div","","button-align-left","");
					$input->addInput("submit","submit","Añadir Gourmet",array('id'=>'submit','class'=>'btn'));
				$tag->closeTag("div");
				if($error != ''){
					$tag->openTag("div","","","");
						$tag->output($error);
					$tag->closeTag("div");
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