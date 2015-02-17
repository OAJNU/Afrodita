<?
	include ("conexion.php");
	include ("admin_login.php");
	session_start();
	$old=$HTTP_POST_VARS['old'];
	$new=$HTTP_POST_VARS['new'];
	$renew=$HTTP_POST_VARS['renew'];
	$intento=$HTTP_POST_VARS['intento'];
	$id_admin=$HTTP_SESSION_VARS['id_admin'];
	if(!$HTTP_SESSION_VARS['_adminpower']) header('location: admin_.php');
	function comparar(){
		$link=conectarDB();
		$consulta=mysql_query("SELECT id FROM _admin where password='".md5($GLOBALS['old'])."'");
		if(mysql_num_rows($consulta)>0&&mysql_result($consulta,0,'id')==$GLOBALS['id_admin']) return(true);
		else return(false);
	}
	function mostrar_error($nroerror){
		switch($nroerror){
			case 1:
				$result="Debe completar los tres campos.<br>";
				break;
			case 2:
				$result="La contraseña proporcionada no es correcta.<br>";
				break;
			case 3:
				$result="La nueva contraseña no coincide con la retipeada.<br>";
				break;
			}
			return("<a class='form_error'>".$result."</a>");
	}
	function validar_datos(){
		if(empty($GLOBALS['old'])||empty($GLOBALS['new'])||empty($GLOBALS['renew'])) return 1;
		if(!comparar()) return 2;
		if($GLOBALS['new']!=$GLOBALS['renew']) return 3;
		return 0;
	}
	function modificar_datos($id_admin){
		//conexion
		$link=conectarDB();
		$strcns.="UPDATE _admin SET password='".md5($GLOBALS['new']);
		$strcns.="' where id=".$id_admin;
		//actualizacion
		$consulta=mysql_query($strcns)or die(mysql_error($link));
		if(!$consulta) return(false);
		return(true);
	}
	if($intento=="true"){
		$error=validar_datos();
		if($error==0) {
			modificar_datos($id_admin);
			header('location: admin_pgs.php?mensaje=pass_modificada');
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Modificacion de contrase&ntilde;a del administrador</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="form1" method="post" action="<?=$PHP_SELF?>">
<br><table width=320 align='center' class='oferta_laboral'>
<tr><td>
  <p align="center" class="titulo Estilo1">Modificacion de contrase&ntilde;a del administrador </p>
	<p align="center">Vieja contrase&ntilde;a<br>
          <input name="old" type="password" id="old" size="30">
          <br>
          <? if($error==2)echo mostrar_error($error);?>
          Nueva contrase&ntilde;a <br>
          <input name="new" type="password" id="new" size="30">
          <br>
          Repita nueva contrase&ntilde;a <br>
          <input name="renew" type="password" id="renew" size="30">
          <br>
          <? if($error==3) echo mostrar_error($error);?>
          <input name='intento' type='hidden' id="intento" value='true'><br>
		  <br>
		  <? if($error==1) echo mostrar_error($error);?>
</p>
	</td></tr>
<tr height='10' ><td align='right'>
    <input type="Button" name="Cancelar" value="Cancelar" onClick="window.location='admin_data.php'"><input type="Submit" name="Submit" value="Guardar">     
</td>
</tr>
</table><br>
</form>
</body>
</html>

