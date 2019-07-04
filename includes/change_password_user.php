<?php

    include_once '../core/init.php'; // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 

    if($mi_sesion->getValor('id_user')==TRUE){ // // Verificamos que la sesión actual sea la del usuario

    require_once '../includes/validate_change_password_user.php'; // Este fichero contiene la validación del cambio de password

?>

<!DOCTYPE>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
    <meta name='description' content='Plataforma de reserva de mesas para restaurantes'>
    <meta name='keywords' content='plataforma, reserva, mesas, restaurante'>
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
    <link rel='stylesheet' type='text/css' href='../site_media/css/style.css'/>
    <title>Reserve your place</title>
</head>
<body>
<!--
/*******************************************************************************************************************/
/   '$tag'        = Objeto instanciado de la clase tags para crear elementos html como divs, label, echo, img, etc. /
/   '$menu'       = Objeto instanciado de la clase HtmlEnlace para crear menus                                      /
/   '$restaurant' = Objeto instanciado de la clase restaurant para realizar las diferentes consultas                /
/   '$mi_sesion'  = Objeto instanciado de la clase sesion para crear, verificar y borrar sesiones                   /
/********************************************************************************************************************
-->
    <?php
        // Cabecera
        $tag->openTag('div','header','','');    

            $tag->openTag('div','','logo',''); // Logo de la cabecera
                $tag->openTag('a','','',array('href'=>''));
                    $tag->openTag('img','','',array('src'=>'','width'=>'70','height'=>'50'));
                    $tag->closeTag('img');
                $tag->closeTag('a');
            $tag->closeTag('div');

            $tag->openTag('div','','title',''); // Titulo de la cabecera
                $tag->openTag('h2','','','');
                    $tag->openTag('a','','',array('href'=>'../user/profile.php'));
                        $tag->output('Portal del Usuario');
                    $tag->closeTag('a');
                $tag->closeTag('h2');
            $tag->closeTag('div');

        $tag->closeTag('div');

        // Sistema de navegación
        $tag->openTag('div','','menutop',''); 

			$menu->cargarEnlace('../user/profile.php','Información','','');
			$menu->cargarEnlace('../user/reserve.php','Mis reservas','','');
			$menu->cargarEnlace('../user/comments.php','Mis Comentarios','','');
			$menu->mostrarHorizontal();	

            include_once '../includes/menu_top.php';  // Incluimos diferentes enlaces dependiendo si el usuario ha iniciado sesión en el cliente, portal de usuario o portal de administración
        
        $tag->closeTag('div');

        $tag->openTag('div','contenedor','','');

        $tag->openTag('h2','','','');
        $tag->output('Cambiar Contraseña');
        $tag->closeTag('h2');

        // Mostramos el formulario de Cambio de contraseña con los campos requeridos
        
		$tag->openTag('div','','informacion_negocio','');

            $form->startForm('','POST','loginUser', array('name'=>'','class'=>'','enctype'=>'', 'onsubmit'=>'')); // Abrimos el formulario

				$tag->openTag('div','','line','');						
				$tag->openTag('label','','',array('for'=>'current_password')); 
				$tag->output('Contraseña actual: '); 
				$tag->closeTag('label');						
				 $input->addInput('password','current_password','',array('id'=>'current_password','placeholder'=>'','class'=>'infor','size'=>50, 'required'=>'required'));
				$tag->closeTag('div');
				
				$tag->openTag('div','','line','');						
				$tag->openTag('label','','',array('for'=>'password')); 
				$tag->output('Nueva Contraseña: '); 
				$tag->closeTag('label');						
				$input->addInput('password','password','',array('id'=>'password','placeholder'=>'','class'=>'infor','size'=>50, 'required'=>'required'));
				$tag->closeTag('div');
				
				$tag->openTag('div','','line','');						
				$tag->openTag('label','','',array('for'=>'password_again')); 
				$tag->output('Repetir Nueva Contraseña: '); 
				$tag->closeTag('label');						
				$input->addInput('password','password_again','',array('id'=>'password_again','placeholder'=>'','class'=>'infor','size'=>50, 'required'=>'required'));
				$tag->closeTag('div');

                $tag->openTag('div','','button-align-left','');
                $input->addInput('submit','submit1','Confirmar',array('class'=>'btn'));
                $tag->closeTag('div');

                if(empty($errors)===false){
                            
                    $tag->output('<p>' . implode('</p><p>', $errors) . '</p>'); // En caso que se haya realizado el proceso sin exito el array '$errors' nos mostrará el error correspondiente 
     
                }

                if(empty($correct)=== false){
                    
                    $tag->output('<p>' . implode('</p><p>', $correct) . '</p>');    // Si  se ha realizado el Cambio de contraseña satisfactoriamente lo hacemos saber
                    
                }

            $form->endForm(); // Cerramos el formulario

        
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
    }else{ // Si la sesión es diferente a la del administrador del restaurante le redireccionamos a su respectivo portal
        header('location: ../index.php');
    }
?>
