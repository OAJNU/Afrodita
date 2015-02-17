<?
include ("../conexion.php");
include ("user_login.php");
$intento=$HTTP_POST_VARS['intento'];
if($intento=="true"){
	$usuario=$HTTP_POST_VARS['usuario'];
	$pass=$HTTP_POST_VARS['pass'];
	if(!user_login($usuario,$pass)==true) {
		$error="<a class='form_error'>El nombre de usuario y la contraseña son incorrectos</a>";
		//setcookie("intentos",$HTTP_COOKIE_VARS['intentos']."a",3600);
	}
}
?><html>
<head>
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
</style>
</head>

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
        <td height="65" background="imgs/fsb.jpg" bgcolor="#FAFAFA"><br /></td>
        <td background="imgs/fsd.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td background="imgs/fsi.jpg">&nbsp;</td>
        <td valign="top" bgcolor="#FAFAFA"><br />
          <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><img src="imgs/toplogin.jpg" width="400" height="29" /></td>
            </tr>
            <tr>
              <td background="imgs/fondo_login.jpg">&nbsp;</td>
            </tr>
            <tr>
              <td height="60"><form id="form1" name="form1" method="post">
                <table width="316" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="144" class="tit">Usuario</td>
                                <td width="144" class="tit">Contrase&ntilde;a</td>
                                <td width="28" class="autor">&nbsp;</td>
                              </tr>
                              <tr>
                                <td><input name="usuario" type="text" class="caja" /></td>
                                <td><input name="pass" type="password" class="caja" "caja"/></td>
                                <td><input type="image" src="imgs/ok.jpg" width="26" height="12" /></td>
                              </tr>
                            </table>
							<input type="hidden" name="intento" value="true" />
              </form>
                <div align="center" class="autor"><?=$error?>
                  <strong>
                  
                  </strong><br />
                  <br />
                  
                    El contenido de esta secci&oacute;n es <strong>s&oacute;lo para usuarios registrados. </strong><br />
                Si olvidaste tu contrase&ntilde;a, hac&eacute; clic ac&aacute;. </div></td>
              </tr>
          </table>
            <br />
            <br />
          <br /></td>
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