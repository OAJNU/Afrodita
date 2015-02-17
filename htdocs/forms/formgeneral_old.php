<?
// SI VIENE DE PARTICIPE

$id_contenido=$HTTP_GET_VARS['id_contenido'];

extract($_GET);
//$to=$_GET['mail_recipient'];
// FORM DATA


// VARS

$to="comisiondirectiva@oajnu.org";
$origen="website@oajnu.org";
$subject="Formulario ".strtoupper($procedencia);
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: ".$origen."\r\n";
$message="

FORMULARIO ".strtoupper($procedencia)."<br>
-----------------------------------<br>
<br>
Asunto: <strong>".$procedencia."</strong><br>";

if($_GET['id_contenido']==114){
	if($debito==1) $debito_value="Si";
	else $debito_value="No";
	$message.="Nombre:<strong>".$nombre."</strong><br>
	Dni:<strong>".$dni."</strong><br>
	Fecha de nacimiento:<strong>".$fecha."</strong><br>
	Ocupacion:<strong>".$ocupacion."</strong><br>
	Nacionalidad:<strong>".$nacionalidad."</strong><br>
	Telefono:<strong>".$telefono."</strong>  Celular:<strong>".$celular."</strong><br>
	Email:<strong>".$email."</strong><br>
	Domicilio:<strong>".$domicilio."</strong><br>
	Ciudad:<strong>".$ciudad."</strong><br>
	Provincia:<strong>".$provincia."</strong><br>
	Pais:<strong>".$pais."</strong><br>
	Código Postal:<strong>".$codpostal."</strong><br>
	Donacion:<strong>".$donacion."</strong><br>
	Monto:<strong>".$monto."</strong><br>
	Otro monto:<strong>".$otromonto."</strong><br>
	Moneda:<strong>".$moneda."</strong><br>
	Prefiere donar mediante tarjeta de débito:<strong>".$debito_value."</strong><br>
	Como conoció a la organización:<strong>".$como_conocio."</strong><br>
	Qué lo motivo a participar con la organización:<strong>".$motivacion."</strong><br>";

}else if($_GET['id_contenido']==118){

	$message.="Nombre:<strong>".$nombre."</strong><br>
	Email:<strong>".$email."</strong><br>
	Organización:<strong>".$organizacion."</strong><br>
	Mensaje:<br><br><strong>".$mensaje."</strong><br>";
	
}
$message.="<br>-----------------------------<br>Fecha:".date('Y/m/d')." Hora: ".date('H:i:s');

if(mail($to,$subject,$message,$headers)) header("Location: ../index.php?item_activo=".$id_contenido."&resultado=1");

?>