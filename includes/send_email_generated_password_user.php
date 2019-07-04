<?php

	$mail->From = 'reserveyourplace@hotmail.com'; // Email desde donde se envia el mensaje

	$mail->FromName = 'Reserve Your Place'; // Nombre de quien envia el mensaje

	$mail->AddAddress($email); // Destinatario del mensaje

	$mail->IsHTML(true); // 'true' en caso de enviar un mensaje HTML

	$mail->Subject = utf8_encode('=?UTF-8?B?' . base64_encode('Generación de contraseña para el usuario') .  '?='); // Asunto del mensaje

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
	              <p style="font-family: Helvetica LT Condensed; color: #008895; font-weight: bold; font-size: 22px; text-align: center;">GENERACI&Oacute;N DE CONTRASEÑA</p>
	            </td>
	          </tr>
	          <tr>
	            <td>&nbsp;</td>
	          </tr>
	          <tr>
	            <td style="font-family: Helvetica LT Condensed; font-size: 18px;">
	            <spanHelvetica LT Condensed"; font-size: 18px;"><p>Estimado cliente,</p></span>
	            <span>Como previamente ha solicitado, su contraseña para su cuenta ha sido reiniciada. sus nuevos detalles de sesión son:</span>
	            </td>
	          </tr>
	          <tr>
	            <td>&nbsp;</td>
	          </tr>	         
	          <tr>
	            <td style="font-family: Helvetica LT Condensed; font-size: 18px;"><span>Usuario:</span>&nbsp;'.$username.'</td>
	          </tr>
	          <tr>
	            <td style="font-family: Helvetica LT Condensed; font-size: 18px;"><span>Password:</span>&nbsp;'.$generated_password .'</td>
	          </tr>
	          <tr>
	            <td style="font-family: Helvetica LT Condensed; font-size: 18px;"><span>Email:</span>&nbsp;'.$email.'</td>
	          </tr>
	          <tr>
	            <td>&nbsp;</td>
	          </tr>
	          <tr>
	            <td style="font-family: Helvetica LT Condensed; font-size: 18px;">
	            <span>Para cambiar tu contraseña a algo más fácil de recordar, luego de iniciar sesión ingresa en Mi Perfil > Cambiar Contraseña.</span>
	            </td>
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

	$mail->Body = $cuerpo;  // Asignamos al atributo Body, la variable $cuerpo.

	$mail->AltBody = 'Usted esta viendo este mensaje simple debido a que su servidor de correo no admite formato HTML.';
				
	$exito = $mail->Send(); // Enviamos el email y el resultado lo almacenamos en una variable

?>