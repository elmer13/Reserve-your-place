<?php 

	include_once('../core/init.php'); // Incluimos el archivo init.php que contiene las instancias de las diferentes clases 

	$mi_sesion->eliminarSesion(); // Eliminamos la sesión

	header('location: ../index.php'); // Redireccionamos al index.php

?>