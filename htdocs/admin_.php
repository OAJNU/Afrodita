<?
include "conexion.php";
include ("admin_login.php");
$intento=$HTTP_POST_VARS['intento'];
$usuario=$HTTP_POST_VARS['usuario'];
$psw=$HTTP_POST_VARS['psw'];
if($intento=="true"){
	if(admin_login($usuario,$psw)) header('location: admin_pgs.php');
	else{
		$error.="<a class='form_error'>El nombre de usuario y la contraseña son incorrectos</a>";
		setcookie("intentos",$_COOKIE['intentos']."a",3600);
	}
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administracion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function iniciarSesion(){
	ef=document.forms[0];
	if(ef.usuario.value.length>0&&ef.psw.value.length>0){
		ef.submit();
	}
	else{
		alert("Debe completar ambos campos");
	}
}
</script>
</head>
<body leftmargin=0 topmargin=0>
<form action="<?=$PHP_SELF?>" method="post"><table width=100% height="100%"><tr valign='middle'><td>
<table width="355" height="100%" align='center'>
<tr height="50%"><td colspan="3">&nbsp;</td></tr>
  <tr height="100">
  <td width='92'>&nbsp;</td>
    <td width=150>
	
      <p class="titulo">Iniciar sesi&oacute;n</p>
      Nombre de usuario <br>
      <input name="usuario" type="text" id="titulo" size="30">
      <br>
      Contrase&ntilde;a<br>
      <input name="psw" type="password" id="autor" size="30">
      <br>
      <? echo $error;?>
    </td>
 	<td width='97'>&nbsp;</td>
  </tr>
  <tr height='10'>
    <td align='right' colspan=2>
      <input type="button" name="Submit" value="Iniciar" onClick='iniciarSesion()'>
	  <input type="hidden" name="intento" value="true">
    </td>
	<td>&nbsp;</td>
  </tr>
  <tr height="50%"><td colspan="3">&nbsp;</td></tr>
</table>
</td></tr></table>
</form>
</body>
</html>
