<?php
/*-------------------------------------------------------------------
AUTOR: Paco Naranjo.
descargado de: http://www.neurona.org.
Fecha de creación: Domingo 27 de Marzo de 2005

Puede usar y distribuir este código de manera gratuita, pero por favor, respete el texto 
que me nombra como autor y mis datos de contacto.
Si lo usa en algún proyecto o le es de utilidad, puede plantearse poner un enlace a: 
http://www.neurona.org
Si lo hace le estaré muy agradecido.

Si quiere contactar conmigo, use cualquiera de estas direcciones: 
paco@naranjo.org
admin@neurona.org
admin@usabilidad.info

Espero que este código le sirva.
Un saludo.

*/



/*
Este script no hace ninguna validación sobre los datos que se envian desde el formulario,
queda de su parte implementar esta validación si lo cree necesario.
*/
/*
las variables que flash ha enviado usando el metodo post, estan dentro del array asociativo $_POST,
este array guarda todas las variables que se han enviado por post.
$_POST al ser una variable global, esta disponible en todo momento dentro del a ejecución de un script.
para acceder al valor especifico de una variable : $POST['nombre del a variable']
Si quiere mas información sobre $_POST visite: http://es2.php.net/reserved.variables#reserved.variables.post
*/

//estas variables las usaremos en el comando 'mail()' para costruir el email.

	//DEBE CAMBIAR EL VALOR DE $destinatario por la dirección de correo que va a recibir el email:
	$destinatario="info@oajnu.org";
	
	//estos datos se usaran como cabecera del email.
	$cabeceras="MIME-Version: 1.0\r\n";
	$cabeceras .= "Content-type: text/html; charset=utf-8\r\n";
	$cabeceras.="From: {$_POST['nombre']}<{$de}>\r\n";
	$cabeceras.="Reply-To: {$_POST['email']}\r\n";
	//el asunto del mensaje:
	$asunto="Incluir a Bases de datos del Boletín";
	//El cuerpo del mensaje:
	$cuerpo=' Ha recibido un email de '.$_POST['nombre'].' ( '.$_POST['email'].' ) con el siguiente contenido:';
	$cuerpo.='<br>'.$_POST['texto'].'<br>';
	//la persona wue envia el email.
	$de=$_POST['email'];

/*
el comando 'mail(destinatario,asunto,cuerpo del mensaje, [parametros adicionales])'
 envia un email y devuelve true si el email fue aceptado para su envio, 
 encaso contrario devuenve false.
Para mas información sobre 'mail()' visite: http://es2.php.net/manual/es/function.mail.php
*/

	if(mail($destinatario, $asunto, $cuerpo,$cabeceras)){
		echo utf8_encode('&estado=enviado');	 
	 }else{
	 	echo utf8_encode('&estado=no_enviado');	
	 } 
/*TEN CUIDADO DE NO ESCRIBIR NINGUN CARACTER DESPUES DE LA ETIQUETA '?>' NI ANTES DE '<?php'  si hay
un espacio en blanco, un retorno de carro o cualquier otro caracter puede que el script 
no funcione correctamente.
*/
?>