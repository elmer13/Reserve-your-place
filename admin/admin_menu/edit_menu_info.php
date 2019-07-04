<?php
	
	include_once '../../core/init.php';  // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 
	
	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Controlamos que la sesión sea la del restaurante
		if(isset($_POST['submit'])){ // Comprobamos que se haya recibido la variable POST del 'submit'
				$id_menu = htmlentities($_POST['id_menu']);
				$name 	 = trim($_POST["name_menu"]);
				$price	 = htmlentities(trim($_POST["price_menu"]));
				$description = trim($_POST["description"]);

				if(empty($errors) === true){  
					$restaurant->editMenu(array("id_menu"=>$id_menu, "name"=>$name,"price"=>$price, "description"=>$description));
					header("location:../menu_gourmet.php");
				}
			}
?>
<!DOCTYPE>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Aqui toda nuestra descripcion">
	<meta name="keywords" content="Aqui, Palabras, Clave">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="../../site_media/css/style.css"/>
	<script type="text/javascript" src="../../site_media/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="../../site_media/js/scrollTop.js"></script>
	<title>Editar Menu - Portal de Administración</title>
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
				$tag->output("Editar menú");
			$tag->closeTag("h2");
			$tag->openTag("div","","informacion_negocio","");
			if (isset($_GET['id_menu']) === true) {
				$id_menu=trim($_GET['id_menu']);
			}
			$restaurant->getMenuById($id_menu);
			if(isset($restaurant->consulta)!=null){
				foreach ($restaurant->consulta as $key => $value) {
					$form->startForm("","POST","", array('name'=>'frmempleado','class'=>'generic','enctype'=>'multipart/form-data', 'onsubmit'=>'')); // Abrimos el formulario 
						$tag->openTag("div","","none-line","");						
							$tag->openTag("label","","",array("for"=>"codigo")); 
								$tag->output("Id Menú: "); 
							$tag->closeTag("label");						
							$input->addInput("text","id_menu",$value['id_menu'],array("id"=>"id_menu","placeholder"=>"",'class'=>'infor','size'=>16, "readonly"=>"readonly","required"=>"required"));
						$tag->closeTag("div");
						$tag->openTag("div","","line","");						
							$tag->openTag("label","","",array("for"=>"name_table")); 
								$tag->output("Nombre Menú: "); 
							$tag->closeTag("label");						
							$input->addInput("text","name_menu",$value['name'],array("id"=>"name","placeholder"=>"Nombre del menú",'class'=>'infor','size'=>14, "readonly"=>"","required"=>"required"));
						$tag->closeTag("div");
						$tag->openTag("div","","line","");						
							$tag->openTag("label","","",array("for"=>"name_table")); 
								$tag->output("Precio Menú: "); 
							$tag->closeTag("label");						
							$input->addInput("text","price_menu",$value['price'],array("id"=>"name","placeholder"=>"Nombre del menú",'class'=>'infor','size'=>14, "readonly"=>"","required"=>"required"));
						$tag->closeTag("div");
						$tag->openTag("div","","line","");
							$tag->openTag("label","","",array("for"=>"description")); 
								$tag->output("Descripción: "); 
							$tag->closeTag("label");	
							$form->addTextarea("description",5,39,"",array("class"=>"textarea", "maxlength"=>100,"placeholder"=>"Añadir una descripción"));
								$tag->output($value['description']);
							$form->closeTextarea();
						$tag->closeTag("div");
						$tag->openTag("div","","button-align-left","");
							$input->addInput("submit","submit","Modificar",array('id'=>'submit','class'=>'btn'));
						$tag->closeTag("div");
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