<?
//vemos si el usuario y contrase�a es v�ildo
if ($_POST["usuario"]=="oajnu" && $_POST["contrasena"]=="2008"){
	//usuario y contrase�a v�lidos
	//defino una sesion y guardo datos
	session_start();
	$_SESSION["autentificado"]= "SI";
	header ("Location: aplicacion.php");	
}else {
	//si no existe le mando otra vez a la portada
	header("Location: index.php?errorusuario=si");
}
?>