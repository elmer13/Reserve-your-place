<?php
    
    include_once '../core/init.php'; // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 

    if(!$mi_sesion->getValor('id_user')==TRUE){ // Verificamos que el usuario haya iniciado sesion
    
    if(!$mi_sesion->getValor('id_restaurant')==TRUE){ // Verificamos que el usuario haya iniciado sesion

?>

<!DOCTYPE>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
    <meta name='description' content='Plataforma de reserva de mesas para restaurantes'>
    <meta name='keywords' content='plataforma, reserva, mesas, restaurante'>
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
    <link rel='shortcut icon' href='../site_media/img/favicon.ico'/>
    <link rel='stylesheet' type='text/css' href='../site_media/css/style.css'/>
    <script type='text/javascript' src='resources/js/timer.js'></script>
    <title>Recuperación - Portal de Administración</title>
</head>
<body>  
<!--
/*************************************************************************************************************************/
/   '$tag'              = Objeto instanciado de la clase tags para crear elementos html como divs, label, echo, img, etc. /
/   '$mi_sesion'        = Objeto instanciado de la clase sesion para crear, verificar y borrar sesiones                   /
/   '$restaurant'       = Objeto instanciado de la clase restaurant para realizar las diferentes consultas                /
/*************************************************************************************************************************/
-->
    <?php
        // Cuerpo de la página
        $tag->openTag('div','contenedor','','');

        $tag->openTag('h2','','','');
        $tag->output('Recuperación de tu Contraseña');
        $tag->closeTag('h2');

        if (isset ($_GET['email'], $_GET['generated_string']) === true) { // Cogemos los diferentes parametros recibidos por GET
            
            // Las almacenamos en sus respectivas variables  
            $email      = trim($_GET['email']);
            $string     = trim($_GET['generated_string']);   
            
            if ($restaurant->getRestaurantByEmail($email) === false || $restaurant->recover($email, $string) === false) {  // Si el email no pertenece a un administrador de restaurante previamente registrado o la recuperación de contraseña sale mal lo notificamos
                
                $errors[] = 'Lo siento, algo salió mal y no pudimos recuperar su contraseña.';

            }

            if(empty($errors) === false){  // Si ha surgido un imprevisto lo notificamos
            
                echo '<p>' . implode('</p><p>', $errors) . ' Usted sera redirigido al inicio de sesión, o si gusta presione directamente <a href="../restaurant_access.php">aquí</a>.</p>';  
        
            }else{ // Si hasta este momento todo sale como lo esperado hacemos lo siguiente

                global $bcrypt; // Declaramos la variable como global

                $restaurant->getRestaurantByEmail($email); // Obtenemos los datos relacionados con el email

                foreach($restaurant->consulta[2] as $key=>$values){

                    $propiedad[$key] = $values;

                }
                
                $id_restaurant= $propiedad['cif_restaurant']; // Guardamos el id del restaurante en una variable
                    
                $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // La variable '$charset' contiene todos los carácteres alfanuméricos para la posterior generación de contraseña aleatoria
                
                $generated_password = substr(str_shuffle($charset),0, 10); // Limitamos el número máximo de la contraseña que se generará y lo almacenamos en una variable

                $restaurant->change_password($id_restaurant, $generated_password);  // Llamamos al método con el que realizaremos el cambio de contraseña
                    
                $restaurant->updateRestaurantGeneratedString($id_restaurant); // Actualizamos el campo generated_string de la tabla restaurante como indicación de que ya se ha realizado la petición y lo volcamos a 0

                include_once '../includes/send_email_generated_password_restaurant.php'; // Enviamos el email al administrador del restaurante correspondiente

                 echo '<h3>Gracias, te hemos enviado una contraseña generada de forma aleatoria en tu correo. Usted sera redirigido al inicio de sesión, o si gusta presione directamente <a href="../restaurant_access.php">aquí</a>.</h3><br/>';
            
            }

            echo "<script type='text/javascript'>timer()</script>"; // Script para redireccionar en un tiempo determinado
            $tag->openTag('div','contador','','');
            $tag->closeTag('div');
        
        } else {
            header('Location: ../index.php'); // Si los parámetros necesarios no se encuentran en la Url redirigir al index.
            exit();
        }

        $tag->closeTag('div');
    ?>
</body>
</html>

<?php
    }else{ // Si el administrador ha iniciado sesión le redireccionamos al portal de administración del restaurante
        header('location: home.php');
    }
    }else{ // Si el usuario ha iniciado sesión le redireccionamos al portal de usuarios
        header('location: ../user/profile.php');
    }
?>