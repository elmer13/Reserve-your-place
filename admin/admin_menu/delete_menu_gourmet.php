<?php
	
	include_once '../../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante
	
		if(isset($_POST['delete_ok'])){ // Comprobamos que se haya recibido la variable POST del 'submit'
			
				$menu_id = $_POST["id_menu"];
				$gourmet_id = $_POST["id_gourmet"];

				if(empty($errors) === true){  // Si no hay errores, llamamos a un método 'setArticle' enviando las diferentes variables recibidas por POST

					$restaurant->deleteMenuComplete($menu_id,$gourmet_id);
					$correct[] = 'Se ha borrado correctamente.';
					header("location: configure_menu.php?menu_id=".$_POST['id_menu']);
				}
		}else if(isset($_POST['delete_nok'])){
			header("location: configure_menu.php");
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
	<title>Eliminar Menu - Portal de Administración</title>
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
	$tag->openTag("div","contenedor","margen",""); // '$tag' es el objeto instanciado de la clase que nos permite crear elementos html como divs, label, echo, etc
		$tag->openTag("h2","","","");
			$tag->output("Eliminar gourmet");
		$tag->closeTag("h2");
		$tag->openTag("br/","","","");
		$tag->openTag("div","","add-content-info","");
			if (isset($_GET['id_gourmet']) === true && isset($_GET['id_menu']) === true) {
				$id_menu=trim($_GET['id_menu']);
				$id_gourmet=trim($_GET['id_gourmet']);
			}
			$restaurant->getMenuCompleteByIdGourmet($id_menu,$id_gourmet);
			if(isset($restaurant->consulta)!=null){
				foreach ($restaurant->consulta as $key => $value) {
					$form->startForm("","POST","", array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 
						$tag->openTag("div","","none-line","");						
							$tag->openTag("label","","",array("for"=>"codigo")); 
								$tag->output("Id Menu: "); 
							$tag->closeTag("label");						
							$input->addInput("text","id_menu",$value['id_menu'],array("id"=>"id_menu","placeholder"=>"",'class'=>'infor','size'=>16, "readonly"=>"readonly","required"=>"required"));
						$tag->closeTag("div");
						$tag->openTag("div","","none-line","");						
							$tag->openTag("label","","",array("for"=>"codigo")); 
								$tag->output("Id Gourmet: "); 
							$tag->closeTag("label");						
							$input->addInput("text","id_gourmet",$value['id_gourmet'],array("id"=>"id_gourmet","placeholder"=>"",'class'=>'infor','size'=>16, "readonly"=>"readonly","required"=>"required"));
						$tag->closeTag("div");
						$tag->openTag("p","","","");
							$tag->output("Vas a eliminar la siguiente información del menú <strong>'".$value['name']."'</strong>.");
						$tag->closeTag("p");
						$tag->openTag("br/","","","");
						$tag->openTag("p","","","");
							$tag->output("Gourmet: ".$value['name_gourmet']);
						$tag->closeTag("p");
						$tag->openTag("br/","","","");
						$tag->openTag("p","","","");
							$tag->output("Estas seguro de querer eliminar esta información");
						$tag->closeTag("p");
						$tag->openTag("br/","","","");
						$tag->openTag("div","","button-align-left","");
							
							$input->addInput("submit","delete_ok","Confirmar",array("id"=>"delete_ok","placeholder"=>"",'class'=>'btn_left btn','size'=>16));
							$input->addInput("submit","delete_nok","Cancelar",array("id"=>"delete_nok","placeholder"=>"",'class'=>'btn_left btn','size'=>16));
						$tag->closeTag("div");
					$form->endForm();// Cerramos el formulario
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