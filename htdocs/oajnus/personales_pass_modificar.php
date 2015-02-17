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

	function comparar(){
		global $old, $id_usuario;
		$link=conectarDB();
		$consulta=mysql_query("SELECT password FROM usuarios where id=".$id_usuario);
		if(mysql_num_rows($consulta)>0&&mysql_result($consulta,0,'password')==md5($old)) return(true);
		else return(false);
	}
	function mostrar_error($nroerror){
		switch($nroerror){
			case 1:
				$result="<br>Debe completar los tres campos.<br>";
				break;
			case 2:
				$result="<br>La contraseña proporcionada no es correcta.<br>";
				break;
			case 3:
				$result="<br>La nueva contraseña no coincide con la retipeada.<br>";
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
	function modificar_datos(){
		global $id_usuario;
		//conexion		
		$link=conectarDB();
		$strcns.="UPDATE usuarios SET password='".md5($GLOBALS['new']);
		$strcns.="' where id=".$id_usuario;
		//actualizacion
		$consulta=mysql_query($strcns)or die(mysql_error($link));
		if(!$consulta) return(false);
		return(true);
	}
	$old=$HTTP_POST_VARS['old'];
	$new=$HTTP_POST_VARS['new'];
	$renew=$HTTP_POST_VARS['renew'];
	$intento=$HTTP_POST_VARS['intento'];
	if($intento=="true"){
		$error=validar_datos();
		if($error==0) {
			modificar_datos();
			header('location: personales.php');
		}
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
                    <td height="30" align="right" valign="middle">Anterior contrase&ntilde;a </td>
                    <td valign="middle"><input name="old" type="text" class="caja" id="old" value="<?=$nombre;?>" size="30" />
                         <? if($error==2)echo mostrar_error($error);?></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" valign="middle">Nueva contrase&ntilde;a </td>
                    <td valign="middle"><input name="new" type="text" class="caja" id="new" value="<?=$nombre;?>" size="30" /></td>
                  </tr>
                  <tr>
                    <td width="185" height="30" align="right" valign="middle">Repetir contrasea&ntilde;a </td>
                    <td width="250" valign="middle"><input name="renew" type="text" class="caja" id="renew" value="<?=$nombre;?>" size="30" />
                      <? if($error==3) echo mostrar_error($error);?>
                      <? if($error==1) echo mostrar_error($error);?></td>
                  </tr>
                  <tr>
                    <td valign="top"><br />                      <br /></td>
                    <td align="right" valign="top"><br />
                      <a href="personales.php"><br />
                      <input type="hidden" name="intento" value="true" />
                      <img src="imgs/cancelar.jpg" width="88" height="26" border="0" /></a> <a href="personales_pass_modificar.php">
                      <input type="image" src="imgs/continuar.jpg" width="88" height="26" border="0" /></a></td>
                  </tr>
                </table>
             </form>
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