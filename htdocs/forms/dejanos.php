<?
include "../conexion.php";
//ITEM EXITO
$item_exito=323;

// FORM DATA
$email=$HTTP_POST_VARS['email'];

$link=conectarDB();
if(!empty($email)){
	$strcns="INSERT INTO suscriptos (email) VALUES ('$email')";
	$consulta=mysql_query($strcns) or die(mysql_error($link));
};
// VARS
header("Location: ../index.php?item_activo=".$item_exito."&resultado=1");

?>