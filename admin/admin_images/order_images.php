<?php
	
	include_once '../../core/init.php';

	if($mi_sesion->getValor('id_restaurant')==TRUE){ // Verificamos que el usuario haya iniciado sesion
	
		if(isset($_POST['position'])!=null){

		foreach ($_POST['position'] as $numero=>$id_image){
		
			$restaurant->updatePositionImages(array('position'=>$numero , 'id_image'=>$id_image));

		}

		header('location: add_image.php');
		
		}else{
			header('location: ../home.php');			
		}
	}else{
		header('location: ../../index.php');
	}	

?>