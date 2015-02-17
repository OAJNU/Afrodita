<?
	include ("conexion.php");
	include ("admin_login.php");
	session_start();
	$intento=$HTTP_POST_VARS['intento'];
	$_adminpower=$HTTP_SESSION_VARS['_adminpower'];
	$nombre=$HTTP_POST_VARS['nombre'];
	$email=$HTTP_POST_VARS['email'];
	$id_admin=$HTTP_SESSION_VARS['id_admin'];
	if(!$_adminpower) header('location: admin_.php');
	function getData($id_admin){
		$link=conectarDB();
		$consulta=mysql_query("SELECT * FROM _admin where id=".$id_admin);
		if(mysql_num_rows($consulta)>0) return($fila=mysql_fetch_array($consulta));
		else return(false);
	}
	function mostrar_error($nroerror){
		switch($nroerror){
			case 1:
				$result="El campo nombre es obligatorio";
				break;
			case 2:
				$result="El campo email es obligatorio";
				break;
			}
			return("<a class='form_error'>".$result."</a>");
		}	
	function validar_datos(){
		global /*%%*/$nombre,/*%%*/$email;
		if(empty($nombre)) return 1;
		if(empty($email)) return 2;
		return 0;
	}
	function modificar_datos($id_admin){
		global $nombre,/*%%*/$email;
		//conexion
		$link=conectarDB();
		$strcns.="UPDATE _admin SET nombre='".$nombre."',";
		$strcns.=" email='".$email."'";
		$strcns.=" where id=".$id_admin;
		//actualizacion
		$consulta=mysql_query($strcns)or die(mysql_error($link));
		if(!$consulta) return(false);
		return(true);
	}
	if($intento=="true"){
		$error=validar_datos();
		if($error==0) {
			modificar_datos($id_admin);
			header('location: admin_pgs.php?mensaje=datos_modificados');
		}
	}
	else{
		$data=getData($id_admin);
		$nombre=$data['nombre'];
		$email=$data['email'];
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Modificar de datos del administrador</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="form1" method="post" action="<?=$PHP_SELF?>">
<br><table width=400 align='center' class='oferta_laboral'>
<tr><td colspan="3"><p align="center" class="titulo Estilo1"><br>
  Modificacion de datos del administrador<br>
  <br>
</p>
  </td>
  </tr>
<tr>
  <td width="88">&nbsp;</td>
  <td width="202">Nombre de usuario<br>
    <input name="nombre" type="text" id="titulo" size="40" value="<?=$nombre;?>">
    <? if($error==1)echo mostrar_error($error);?>
    <br>
Email<br>
<input name="email" type="text" id="empresa" size="40" value="<?=$email;?>">
<? if($error==2) echo mostrar_error($error);?>
<br>
<br>
<a href="admin_pwd_mod.php">Modificar contrase&ntilde;a...</a><br>
<input name='intento' type='hidden' id="intento" value='true'></td>
  <td width="88">&nbsp;</td>
</tr>
<tr height='10' ><td colspan="3" align='right'>
    <input type="Button" name="Cancelar" value="Cancelar" onClick="window.location='admin_pgs.php'"><input type="Submit" name="Submit" value="Guardar">     
</td>
</tr>
</table>
<br>
</form>
</body>
</html>

