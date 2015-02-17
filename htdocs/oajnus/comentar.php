<?
include "../conexion.php";
include "archivo.inc.php";

session_start();
$_userpower=$HTTP_SESSION_VARS['_userpower'];
if(!$HTTP_SESSION_VARS['_userpower']) {
	header('location: login.php'); 
}
$id_usuario=$HTTP_SESSION_VARS['id_usuario'];
$comentario=$HTTP_POST_VARS['comentario'];
$titulo=$HTTP_POST_VARS['titulo'];
$id_noticia=$HTTP_POST_VARS['id_noticia'];
$link=conectarDB();
if(!empty($titulo)&&!empty($comentario)){
	$strcns="INSERT INTO comentarios
		(id_usuario,id_noticia, fecha, titulo, cuerpo) VALUES
		($id_usuario,$id_noticia,NOW(),'$titulo','$comentario')
	";
	$consulta=mysql_query($strcns)or die(mysql_error($GLOBALS['link']));
	header("Location: entrada.php?id_noticia=".$id_noticia);
}else die("alguno de los dos esta vacio");
?>