<?
include "../conexion.php";
include "archivo.inc.php";
session_start();
if(!$HTTP_SESSION_VARS['_userpower']) {
	header('location: login.php'); 
}
$id_usuario=$HTTP_SESSION_VARS['id_usuario'];
$link=conectarDB();
function getDatos(){
		global $id_usuario;
		$strcns="select d.nombre as n_delegacion, u.*, date_format(u.fecha_nacimiento,'%d/%m/%Y') as sp_fecha from usuarios u, delegaciones d where d.id=u.delegacion AND u.id=".$id_usuario;
		$consulta=mysql_query($strcns) or die(mysql_error($GLOBALS['link']));
		return mysql_fetch_array($consulta);
	}
$data=getDatos();
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
body {
	background-color: #FFFFFF;
	margin-left: 5px;
	margin-bottom: 5px;
}
body,td,th {
	font-family: Tahoma;
	font-size: 11px;
	color: #09643A;
}
a:link {
	text-decoration: none;
	color: #09643A;
}
a:visited {
	text-decoration: none;
	color: #09643A;
}
a:hover {
	text-decoration: none;
	color: #09643A;
}
a:active {
	text-decoration: none;
	color: #09643A;
}
-->
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
                  <td height="25" background="imgs/linea_menu.jpg"><img src="imgs/personales.jpg" width="63" height="12" /><a href="personales.php"><img src="imgs/flecha.jpg" width="12" height="8" /><?=$HTTP_SESSION_VARS['nombre_completo']?></a></td>
                </tr>
             </table>
                <br />
                <br />
                Nombre de usuario: <strong><?=$HTTP_SESSION_VARS['username']?></strong>
                <br />
                <br />
                Nombre: <strong><?=$HTTP_SESSION_VARS['nombre_completo']?></strong><br />
                <br />
                Direccion: <strong><?=$data['direccion']?></strong><br />
                <br />
Localidad: <strong><?=$data['localidad']?></strong><br />
<br />
Telefono: <strong><?=$data['telefono']?></strong><br />
<br />
Celular: <strong><?=$data['celular']?></strong><br />
<br />
Fecha de Nacimiento: <strong><?=$data['sp_fecha']?></strong><br />
<br />
Delegacion: <strong><?=$data['n_delegacion']?></strong><br />
<br /> 
email: <strong><?=$data['email']?></strong><br />
<br />
Cargo: <strong><?=$data['cargo']?></strong><br />
<br />
Carrera: <strong><?=$data['carrera']?></strong><br />
<br />
<br />
<a href="personales_modificar.php"><img src="imgs/mod_datos.jpg" width="198" height="26" border="0" /></a> <a href="personales_pass_modificar.php"><img src="imgs/mod_pas.jpg" width="158" height="26" border="0" /></a><br />
<br /></td>
              <td width="41">&nbsp;</td>
              <td width="155" valign="top"><table width="155" border="0" cellpadding="0" cellspacing="0">
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
				</table></td>
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