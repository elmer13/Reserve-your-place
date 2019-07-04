<?php
	
	$email_code=$restaurant->getRestaurantEmailCode($email); // Obtenemos el 'email_code' del restaurante teniendo en cuenta el email

	foreach($restaurant->consulta as $key=>$values){ // Recorremos con un foreach los resultados
	}

	$email_code=$values['email_code']; // Guardamos el 'email_code' en una variable

	$mail->From = 'reserveyourplace@hotmail.com'; // Email desde donde se envia el mensaje

	$mail->FromName = 'Reserve Your Place'; // Nombre de quien envia el mensaje

	$mail->AddAddress($email); // Destinatario del mensaje

	$mail->IsHTML(true); // 'true' en caso de enviar un mensaje HTML

	$mail->Subject = utf8_encode('=?UTF-8?B?' . base64_encode('Activación de cuenta de administración del restaurante') .  '?='); // Asunto del mensaje

	// Aquí es donde incluiremos el correo el html
	$cuerpo='

	<html>
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Envio de Sugerencias</title>
	<style type="text/css">

	#content{
	  padding: 10px 10px;
	}
	#td{
	 float:left;
	}

	span, p{
	  margin-top: 10px;
	  margin-bottom: 10px;
	  text-align:left;
	  padding: 10px 10px;
	}

	</style>
	</head>

	<body>
	  <div id="content">
	    <table width="70%" align="center" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="margin: 30px auto;">
	      <tr>
	        <td><table width="100%" border="0">
	          <tr>
	            <td style="width: 500px;height: 200px;text-align: center;vertical-align: middle;">
	              <img src="http://vps62618.ovh.net/site_media/img/icon-reserveyourplace.png" width="284" height="140">
	            </td>
	          </tr>
	          <tr>
	            <td>
	              <p style="font-family: Helvetica LT Condensed; color: #008895; font-weight: bold; font-size: 22px; text-align: center;">ACTIVACI&Oacute;N DE CUENTA</p>
	            </td>
	          </tr>
	          <tr>
	            <td>&nbsp;</td>
	          </tr>
	          <tr>
	            <td style="font-family: Helvetica LT Condensed; font-size: 18px;">
	            <spanHelvetica LT Condensed"; font-size: 18px;"><p>Estimado cliente,</p></span>
	            <span>Gracias por confiar en nosotros. Por favor visite el siguiente enlace para que podamos activar su cuenta:</span>
	            </td>
	          </tr>
	          <tr>
	            <td style="font-family: Helvetica LT Condensed; font-size: 18px;">
	            <span><a href="http://vps62618.ovh.net/admin/activate.php?email='.$email.'&email_code='.$email_code.'">http://vps62618.ovh.net/admin/activate.php?'.$email.'&email_code='.$email_code.'</a></span>
	            </td>
	          </tr>
	          <tr>
	            <td>&nbsp;</td>
	          </tr>
	          <tr>
	            <td style="font-family: Helvetica LT Condensed; font-size: 18px;"><span style="font-weight: bold">Informaci&oacute;n de su cuenta para la administración del restaurante:</span>&nbsp;</td>
	          </tr>
	          <tr>
	            <td style="font-family: Helvetica LT Condensed; font-size: 18px;"><span>CIF restaurante:</span>&nbsp;'.$cif_restaurant.'</td>
	          </tr>
	          <tr>
	            <td style="font-family: Helvetica LT Condensed; font-size: 18px;"><span>Password:</span>&nbsp;*****</td>
	          </tr>
	          <tr>
	            <td style="font-family: Helvetica LT Condensed; font-size: 18px;"><span>Email:</span>&nbsp;'.$email.'</td>
	          </tr>
	          <tr>
	            <td>&nbsp;</td>
	          </tr>
	          <tr>
	            <td style="font-family: Helvetica LT Condensed; font-size: 18px;"><span>Reserve your place</span></td>
	          </tr>
	          <tr>
	            <td style="font-family: Helvetica LT Condensed; font-size: 18px;"><span><a href="http://vps62618.ovh.net">http://vps62618.ovh.net</a></span></td>
	          </tr>
	          <tr>
	          <td>&nbsp;</td>
	        </tr>
	        </table></td>
	       </tr>
	    </table>
	  </div>
	</body>
	</html>


	'; // Cerramos la comilla simple. Con la comilla simple y el punto y coma se finaliza el cuerpo del mensaje html.  

	$mail->Body = $cuerpo; 	// Asignamos al atributo Body, la variable $cuerpo.

	$mail->AltBody = 'Usted esta viendo este mensaje simple debido a que su servidor de correo no admite formato HTML.'; 
				
	$exito = $mail->Send(); // Enviamos el email y el resultado lo almacenamos en una variable

?>