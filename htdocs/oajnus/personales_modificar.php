<?
include ("../conexion.php");
	include ("../admin_login.php");
	include ("../combo.inc.php");
	include "archivo.inc.php";
	session_start();
	if(!$HTTP_SESSION_VARS['_userpower']) {
		header('location: login.php'); 
	}
	$id_usuario=$HTTP_SESSION_VARS['id_usuario'];
	$link=conectarDB();

	/* insercion de datos*/
	function getDatos(){
		global $id_usuario;
		$strcns="select *, date_format(fecha_nacimiento,'%Y') as ano_nac, date_format(fecha_nacimiento,'%m') as mes_nac, date_format(fecha_nacimiento,'%d') as dia_nac from usuarios where id=".$id_usuario;
		$consulta=mysql_query($strcns) or die(mysql_error($GLOBALS['link']));
		return mysql_fetch_array($consulta);
	}
	function validar_datos(){
		global $nombre, $apellido, $email;
		if(empty($nombre)) return 1;
  		if(empty($apellido)) return 2;	
		if(empty($email)) return 3;	
		return 0;
	}
	function guardar_datos(){
		global $id_usuario, $nombre, $apellido, $direccion, $localidad, $telefono, $celular, $fecha_nacimiento, $delegacion, $email, $cargo, $carrera;
		$strcns="UPDATE usuarios SET ";
		$strcns.="username='$username', ";
		$strcns.="nombre='$nombre', ";
		$strcns.="apellido='$apellido', ";
		$strcns.="direccion='$direccion', ";
		$strcns.="localidad='$localidad', ";
		$strcns.="telefono='$telefono', ";
		$strcns.=" celular='$celular', ";
		$strcns.="fecha_nacimiento='$fecha_nacimiento', ";
		$strcns.="delegacion='$delegacion', ";
		$strcns.="email='$email', ";
		$strcns.="cargo='$cargo', ";
		$strcns.=" carrera='$carrera'";
		$strcns.=" WHERE id=".$id_usuario;
		$consulta=mysql_query($strcns) or die(mysql_error($GLOBALS['link']));
	}
	/* fin insercion de datos */
	
	$error="<a class='form_error'><br>Este campo es obligatorio</a><br>";
	if($HTTP_POST_VARS['intento']=="true"){
		$username=$HTTP_POST_VARS['username'];
        $nombre=$HTTP_POST_VARS['nombre'];
      	$apellido=$HTTP_POST_VARS['apellido'];
		$direccion=$HTTP_POST_VARS['direccion'];
		$localidad=$HTTP_POST_VARS['localidad'];
		$telefono=$HTTP_POST_VARS['telefono'];
		$celular=$HTTP_POST_VARS['celular'];
		$dia_nac=$HTTP_POST_VARS['dia_nac'];
		$mes_nac=$HTTP_POST_VARS['mes_nac'];
		$ano_nac=$HTTP_POST_VARS['ano_nac'];
		$delegacion=$HTTP_POST_VARS['delegacion'];
		$email=$HTTP_POST_VARS['email'];
		$cargo=$HTTP_POST_VARS['cargo'];
		$carrera=$HTTP_POST_VARS['carrera'];
		$fecha_nacimiento=$ano_nac."-".$mes_nac."-".$dia_nac;
		$errno=validar_datos();
		if($errno==0){
			guardar_datos();
			header("location: personales.php");
		}else{
			if($errno==5) $error="<a class='form_error'><br>Ingrese al menos 6 caracteres</a><br>";
			if($errno==6) $error="<a class='form_error'><br>El nombre elegido conteiene carcteres no validos</a><br>";
			if($errno==7) $error="<a class='form_error'><br>El nombre de usuario ya existe.</a><br>";
		}
	}else{
		$data=getDatos();
		$username=$data['username'];
        $nombre=$data['nombre'];
      	$apellido=$data['apellido'];
		$direccion=$data['direccion'];
		$localidad=$data['localidad'];
		$telefono=$data['telefono'];
		$celular=$data['celular'];
		$dia_nac=$data['dia_nac'];
		$mes_nac=$data['mes_nac'];
		$ano_nac=$data['ano_nac'];
		$delegacion=$data['delegacion'];
		$email=$data['email'];
		$cargo=$data['cargo'];
		$carrera=$data['carrera'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>OAJNUS</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function popupfoto(urlfoto){
	var posAncho=(screen.width-200)/2;
	var posAlto=(screen.height-200)/2;
	var atributos='resizable=no,statusbar=0,scrolling=no,width=200,height=200,left='+posAncho +',top='+posAlto;
	a=window.open('scripts/popupfoto.php?urlfoto='+urlfoto,'urlfoto',atributos)
	a.focus();
}
</script>
<style type="text/css">
<!--
body,td,th {
	margin-left: 5px;
	margin-bottom: 5px;
	font-family: Tahoma;
	font-size: 11px;
	color: #09643A;
}
.caja {
	background-image: url(imgs/fondo_caja.jpg);
	background-repeat: repeat-x;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #BDD6CF;
	border-right-color: #E7F0EE;
	border-bottom-color: #E7F0EE;
	border-left-color: #BDD6CF;
	font-family: tahoma;
	font-size: 11px;
	color: #09643A;
	height: 21px;
}
.tit {
	font-family: tahoma;
	font-size: 9px;
	color: #09643A;
}
-->
</style></head>

<body leftmargin="0" topmargin="0" bottommargin="0">
<table width="777" border="0" align='center' cellpadding="0" cellspacing="0">
<!-- fwtable fwsrc="menu.png" fwbase="menu.png" fwstyle="Dreamweaver" fwdocid = "1443153241" fwnested="1" -->
  <tr>
    <td><table width="777"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="187" valign="top" background="imgs/top_oajnu_r1_c5.jpg"><img src="imgs/esi.jpg" width="187" height="129" border="0" /></td>
        <td width="450" background="imgs/fsv.jpg">&nbsp;</td>
        <td width="140" valign="top"><img src="imgs/esd.jpg" width="140" height="129" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="777" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td background="imgs/fsi.jpg">&nbsp;</td>
        <td height="65" background="imgs/fsb.jpg" bgcolor="#FAFAFA">&nbsp;</td>
        <td background="imgs/fsd.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td background="imgs/fsi.jpg">&nbsp;</td>
        <td valign="top" bgcolor="#FAFAFA"><table width="759" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="41">&nbsp;</td>
              <td width="490" valign="top"><table width="490" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="25" background="imgs/linea_menu.jpg"><img src="imgs/personales.jpg" width="63" height="12" /><a href="personales.php"><img src="imgs/flecha.jpg" width="12" height="8" /><?=$HTTP_SESSION_VARS['nombre_completo']?>
                    <br />
                    <br />
                  </a></td>
                </tr>
             </table><form method="post">
                <table width="450" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td width="185" height="30" align="right" valign="middle">Nombre/s: </td>
                    <td width="250" valign="middle"><input name="nombre" type="text" class="caja" id="nombre" value="<?=$nombre;?>" size="30" />
                      <? if($errno==1) echo $error;?></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" valign="middle"> Apellido:</td>
                    <td valign="middle"><input name="apellido" type="text" class="caja" id="apellido" value="<?=$apellido;?>" size="30" />
                      <? if($errno==2) echo $error;?></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" valign="middle"> Fecha de nacimiento </td>
                    <td valign="middle">D&iacute;a
                      <select name="dia_nac" class="caja">
                        <?=getComboDia($dia_nac)?>
                      </select>
Mes
<select name="mes_nac" class="caja">
  <?=getComboMes($mes_nac)?>
</select>
A&ntilde;o
<select name="ano_nac" class="caja">
  <?=getComboAno($ano_nac)?>
</select></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" valign="middle">Direccion: </td>
                    <td valign="middle"><input name="direccion" type="text" class="caja" id="direccion" value="<?=$direccion;?>" size="40" /></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" valign="middle">Localidad: </td>
                    <td valign="middle"><input name="localidad" type="text" class="caja" id="localidad" value="<?=$localidad;?>" size="30" /></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" valign="middle"> Telefono: </td>
                    <td valign="middle"><input name="telefono" type="text" class="caja" id="telefono" value="<?=$telefono;?>" size="20" /></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" valign="middle">Celular: </td>
                    <td valign="middle"><input name="celular" type="text" class="caja" id="celular" value="<?=$celular;?>" size="40" /></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" valign="middle">Email: </td>
                    <td valign="middle"><input name="email" type="text" class="caja" id="email" value="<?=$email;?>" size="40" />
                      <? if($errno==3) echo $error;?></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" valign="middle"> Carrera: </td>
                    <td valign="middle"><input name="carrera" type="text" class="caja" id="carrera" value="<?=$carrera;?>" size="40" /></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" valign="middle"> Cargo en OAJNU
:</td>
                    <td valign="middle"><input name="cargo" type="text" class="caja" id="cargo" value="<?=$cargo;?>" size="35" /></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" valign="middle">Delegaci&oacute;n</td>
                    <td valign="middle"><select name="delegacion" class="caja" id="select">
                      <?=getComboDelegaciones($delegacion,true);?>
                    </select></td>
                  </tr>
                  <tr>
                    <td valign="top"><br />                      <br /></td>
                    <td align="right" valign="top"><br />
                      <a href="personales.php"><br />
                      <input type="hidden" name="intento" value="true" />
                      <img src="imgs/cancelar.jpg" width="88" height="26" border="0" /></a> <a href="personales_pass_modificar.php">
                      <input type="image" src="imgs/continuar.jpg" width="88" height="26" border="0" /></a></td>
                  </tr>
                </table></form>
                <br /></td>
              <td width="41">&nbsp;</td>
              <td width="155" valign="top"><table width="155" border="0" cellpadding="0" cellspacing="0" id="izquierda">
                <tr>
                  <td height="25" background="imgs/linea_menu.jpg"><img src="imgs/a_r9_c20.jpg" width="62" height="12" /></td>
                </tr>
                <tr>
                  <td height="25" valign="middle" background="imgs/linea_menu.jpg"><a href="personales.php"><img src="imgs/flecha.jpg" width="12" height="8" /><span class="menu_link">Mi ficha personal </span></a></td>
                </tr>
                <tr>
                  <td height="25" background="imgs/linea_menu.jpg"><a href="cerrarsesion.php"><img src="imgs/flecha.jpg" width="12" height="8" /><span class="menu_link">Cerrar sesi&oacute;n </span></a></td>
                </tr>
                <tr>
                  <td height="15" background="imgs/linea_menu.jpg">&nbsp;</td>
                </tr>
			    <tr>
			      <td height="25" background="imgs/linea_menu.jpg"><img src="imgs/archivo.jpg" width="50" height="12" /></td>
			      </tr>
			    <?=getMesesArchivo()?>
				</table>
              </td>
              <td width="32">&nbsp;</td>
            </tr>
          </table>
          </td>
        <td background="imgs/fsd.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td width="9" background="imgs/fsi.jpg">&nbsp;</td>
        <td width="759" height="32" background="imgs/fib.jpg" bgcolor="#FAFAFA"><br /></td>
        <td width="9" background="imgs/fsd.jpg">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table align="left" border="0" cellpadding="0" cellspacing="0" width="759">
	  <tr>
	   <td><table width="777"  border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td width="37" height="69"><img src="imgs/eii.jpg" width="39" height="71"></td>
           <td width="698" valign="middle" background="imgs/fiv.jpg" align="center">             
                 <div align="center"><img src="imgs/spacer.gif" width="678" height="1">                  </div>
				     <span class="linkblanco"><a href="mapasitio.php" class="linkblanco">Mapa del sitio</a> &nbsp;<a class="linkblanco">|</a>&nbsp;<a href="index.php?item_activo=118" class="linkblanco">Contactanos</a></span> <br>
                    <br>			    
                </div></td>
           <td width="40"><img src="imgs/eid.jpg" width="40" height="71"></td>
         </tr>
       </table></td>
	   </tr>
	</table></td>
  </tr>
</table>
<br>
</body>
</html>