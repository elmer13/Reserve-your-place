<?php
    
    // Este fichero valida el cambio de contraseña mediante los datos de un formulario recogido desde la parte del administrador del restaurante

    if(isset($_POST["submit1"])){ // Comprobamos que se ha pulsado el submit
           
            if(empty($_POST['current_password']) || empty($_POST['password']) || empty($_POST['password_again'])){ // Verificamos que no esten vacios los campos recibidos

                $errors[] = 'Todos los campos son obligatorios';

            }else if($bcrypt->verify($_POST['current_password'], $restaurantData['password']) === true){ // Realizamos una llamada al método Verify para que nos compruebe la contraseña actual

                if(trim($_POST['password']) != trim($_POST['password_again'])){ // Las contraseñas tienen que coincidir 

                    $errors[] = 'Sus nuevas contraseñas no coinciden';

                } else if(strlen($_POST['password']) < 5){ // La contraseña nueva no puede tener menos de 5 carácteres

                    $errors[] = 'La contraseña debe tener como mínimo 5 caracteres';

                } else if(strlen($_POST['password']) >12){ // La contraseña nueva no puede tener más de 12 carácteres

                    $errors[] = 'La contraseña no puede contener más de 12 caracteres';
                } 

            } else { // Si el método Verify nos retorna falso lo hacemos saber

                $errors[] = 'Su contraseña actual es incorrecta';

            }

        if(empty($_POST) === false && empty($errors) === true){ // Siempre y cuando los datos enviados por POST no sean vacios y no haya errores hacemos el cambio de contraseña

                $restaurant->change_password($restaurantData['cif_restaurant'], $_POST['password']);
                $correct[] = 'Su contraseña ha sido cambiada!';

        }

    }

?>