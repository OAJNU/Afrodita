<?
// SI VIENE DE PARTICIPE

$id_contenido=$HTTP_GET_VARS['id_contenido'];

extract($_GET);

// FORM DATA


// VARS
$recipiente="comisiondirectiva@oajnu.org";
$origen="website@oajnu.org";
$subject=strtoupper($procedencia);
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$headers .= "From: ".$origen."\r\n";
$message="

FORMULARIO ".strtoupper($procedencia)."\n
-----------------------------------\n
\n
Asunto:  ".$procedencia."\n\n";

if($_GET['id_contenido']==299){
	if($debito==1) $debito_value="Si";
	else $debito_value="No";

	/* Marca con una cruz lo que desees*/
	if($informacion==1) $informacion_value="Si";
	else $informacion_value="No";
	if($presupuestos==1) $presupuestos_value="Si";
	else $presupuestos_value="No";
	if($reuniones==1) $reuniones_value="Si";
	else $reuniones_value="No";

	$message.="Nombre:".$nombre."\n
Dni:".$dni."\n
Fecha de nacimiento: ".$fecha."\n
Ocupacion: ".$ocupacion."\n
Nacionalidad: ".$nacionalidad."\n
Telefono: ".$telefono."  Celular: ".$celular."\n
Email: ".$email."\n
Domicilio: ".$domicilio."\n
Ciudad: ".$ciudad."\n
Provincia: ".$provincia."\n
Pais: ".$pais."\n
Código Postal: ".$codpostal."\n
Donacion: ".$donacion."\n
Monto: ".$monto."\n
Otro monto: ".$otromonto."\n
Moneda: ".$moneda."\n
Prefiere donar mediante tarjeta de débito: ".$debito_value."\n
Como conoció a la organización: ".$como_conocio."\n
Qué lo motivo a participar con la organización: ".$motivacion."\n\n
Marca con una cruz lo que desees\n\n
Envío de información sobre OAJNU: ".$informacion_value."\n
Envío presupuesto de proyectos: ".$presupuestos_value."\n
Reuniones anuales para evaluación de Gestión: ".$reuniones_value."\n";

}else if($_GET['id_contenido']==300){

	$message.="Nombre:".$nombre."\n
Dni:".$dni."\n
Fecha de nacimiento: ".$fecha."\n
Ocupacion: ".$ocupacion."\n
Nacionalidad: ".$nacionalidad."\n
Telefono: ".$telefono."  Celular: ".$celular."\n
Email: ".$email."\n
Domicilio: ".$domicilio."\n
Ciudad: ".$ciudad."\n
Provincia: ".$provincia."\n
Pais: ".$pais."\n
Código Postal: ".$codpostal."\n";
	
}
else if($_GET['id_contenido']==323){
	if($destino==1) $recipiente="info@oajnu.org";
	else if($destino==2) $recipiente="info.cordoba@oajnu.org";
	else if($destino==3) $recipiente="info.buenosaires@oajnu.org";
	else if($destino==4) $recipiente="info.mendoza@oajnu.org";
	$message.="Nombre: ".$nombre."\n
Email: ".$email."\n
Organización: ".$organizacion."\n
Mensaje:\n\n ".$mensaje."\n";
	
}

$to=$recipiente;
$message.="\n-----------------------------\nFecha:".date('Y/m/d')." Hora: ".date('H:i:s');


mail("jesus_vilar@yahoo.com.ar",$subject,$message,$headers);
if(mail($to,$subject,$message,$headers)) header("Location: ../index.php?item_activo=".$id_contenido."&resultado=1");
?>"