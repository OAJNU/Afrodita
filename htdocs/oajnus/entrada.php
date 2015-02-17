<?
include "../conexion.php";
include "archivo.inc.php";

session_start();
$_userpower=$HTTP_SESSION_VARS['_userpower'];
if(!$HTTP_SESSION_VARS['_userpower']) {
	header('location: login.php'); 
}

$link=conectarDB();
function makeLinks($sourceText) {
  $destText = preg_replace( "/([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+)(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})/", '<a href="mailto:\\0">\\0</a>',$sourceText);
  $destText = preg_replace_callback('/\bhttp[^\s]+/',create_function('$matches', 'return "<a href=\"$matches[0]\" target=\"_blank\">" . preg_replace("#(\.|/)#", "&shy;$1", $matches[0]) . "</a>";'),$destText);
  return $destText;
}
$id_noticia=$HTTP_GET_VARS['id_noticia'];
function getData(){
	global $id_noticia;
	$strcns="SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') as sp_fecha FROM noticias WHERE id=".$id_noticia;
	$consulta=mysql_query($strcns)or die( mysql_error($GLOBALS['link']));
	return mysql_fetch_array($consulta);
}
function getImagenes(){
		global $id_noticia;
		$strcns="SELECT id FROM fotos WHERE id_noticia=".$id_noticia." AND ubicacion_articulo<>0";
		$consulta=mysql_query($strcns)or die(mysql_error($GLOBALS['link']));
		if(mysql_num_rows($consulta)>=1) {
			while($fila=mysql_fetch_array($consulta)){
					$foto='<div class="foto"><a href="javascript:fotopop('.$fila['id'].')"><img src="foto_resize.php?id_imagen='.$fila['id'].'" /></a></div>';
					$htmlstr.=$foto.'<br>';
					
			}
			$htmlstr.="<br>";
			return $htmlstr;
		}
		else return "";
}
function getComentarios(){
	global $id_noticia;
	$strcns="SELECT c.*, CONCAT(u.nombre,' ',u.apellido) as nombre_completo, date_format(c.fecha, '%d/%m/%Y') as sp_fecha, u.email FROM comentarios c, usuarios u WHERE u.id=c.id_usuario AND c.id_noticia=".$id_noticia." ORDER by id, fecha";
	$consulta=mysql_query($strcns)or die(mysql_error($GLOBALS['link']));
	if(mysql_num_rows($consulta)>=1) {
		$htmlstr='<tr>
                    <td height="25" colspan="2" background="imgs/linea_menu.jpg"><img src="imgs/comentarios.jpg" width="82" height="12" /></td>
                    </tr>';
		while($fila=mysql_fetch_array($consulta)){
			$htmlstr.='<tr>
         <td colspan="2"><br><div class="autor"> Por <strong>'.$fila['nombre_completo'].'</strong> [ <strong>'.$fila['email'].'</strong> ]. Publicado el <strong>'.$fila['sp_fecha'].'</strong>.</div>
                       <div class="titulo_entrada">'.$fila['titulo'].'</div>
                      <div class="texto_principal">'.$fila['cuerpo'].'</div></td>
                  </tr><tr>
                    <td colspan="2" height="25" background="imgs/linea_menu.jpg">&nbsp;</td>
                  </tr>';
		}
		return $htmlstr;
	}
}
$data=getData();

?>
<html>
<head>
<title>OAJNUS</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilo.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function fotopop(id){
	 a=window.open("fotopop.php?id_imagen="+id+"&width="+window.screen.width,"foto","scrollbars=no,status=no,width=300,height=200");     a.focus();
}
function doSubmit(){
	if(document.getElementById("titulo").value!=""){
		if(document.getElementById("comentario").value!=""){
			return true;
		}
		else{ 
			alert("Tenes que ingresar un comentario");
			return false;
		}
		
	}else{
		alert("Tenes que poner un título");
		return false;
	}
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
.Estilo1 {color: #09643A}
.caja {	background-image: url(imgs/fondo_caja.jpg);
background-color:#FAFAFA;
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
#guardar {
	width: 423px;
	text-align: right;
	float: none;
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
                  <td height="25" background="imgs/linea_menu.jpg"><img src="imgs/ultimas_entradas.jpg" width="113" height="12" /></td>
                </tr>

              </table>
                <br />
                <table width="490" border="0" cellpadding="0" cellspacing="0">
                
                  <tr>
                    <td width="115" height="25" valign="top"><?=getImagenes()?></td>
                    <td width="375"><div class="autor"> Por <strong><?=$data['autor'];?></strong>. Publicado el <strong><?=$data['sp_fecha'];?></strong>.</div>
                      <span class="titulo_entrada"><?=$data['titulo'];?></span><br />
                      <div class="texto_principal">
                        <?=makeLinks(stripslashes($data['cuerpo']));?>
                      </div></td>
                  </tr>
				    <tr>
				      <td height="45" colspan="2">&nbsp;</td>
			        </tr>
				    <tr>
				      <td height="15" colspan="2">&nbsp;</td>
			        </tr>
<?=getComentarios();?>					<tr>
					  <td height="25" colspan="2"><form name="form1" method="post" onSubmit="return doSubmit()" action="comentar.php">
					    <br>
					    <br>
					    <img src="imgs/comentar.jpg" width="73" height="12" /><br>
					    <br>
					    Titulo<br>
					    <input name="titulo" type="text" class="caja" id="titulo" size="80" />
					    <br>
					    <br>
					    Comentario<br>
					    
					    <textarea name="comentario" cols="80" rows="10" class="caja" id="comentario" style="height:auto"></textarea>
					    <br>
					    <br>
					    <br>
					    <div id="guardar">
					      <input type="hidden" name="id_noticia" value="<?=$id_noticia?>">
					      <input type="image" src="imgs/guardar.jpg" width="88" height="26" align="right"></div>
			              <br>
					    <br>
				      </form></td>
				      </tr>
					<tr>
				      <td height="25" colspan="2">&nbsp;</td>
			        </tr>
                </table></td>
              <td width="41">&nbsp;</td>
              <td width="155" valign="top"><table width="155" border="0" cellpadding="0" cellspacing="0" id="izquierda">
                <tr>
                  <td height="25" background="imgs/linea_menu.jpg"><img src="imgs/a_r9_c20.jpg" width="62" height="12" /></td>
                </tr>
                <tr>
                  <td height="25" valign="middle" background="imgs/linea_menu.jpg"><img src="imgs/flecha.jpg" width="12" height="8" /><span class="menu_link"><a href="personales.php">Mi ficha personal </a></span></td>
                </tr>
                <tr>
                  <td height="25" background="imgs/linea_menu.jpg"><img src="imgs/flecha.jpg" width="12" height="8" /><span class="menu_link"><a href="cerrarsesion.php">Cerrar sesi&oacute;n </a></span></td>
                </tr>
                <tr>
                  <td height="15" background="imgs/linea_menu.jpg">&nbsp;</td>
                </tr>
                <tr>
                  <td height="25" background="imgs/linea_menu.jpg"><img src="imgs/archivo.jpg" width="50" height="12" /></td>
                </tr>
                <?=getMesesArchivo()?>
                <tr>
                  <td height="15" background="imgs/linea_menu.jpg">&nbsp;</td>
                </tr>
                <tr>
                  <td height="25" background="imgs/linea_menu.jpg"><a href="index.php"><img src="imgs/ultimas_entradas.jpg" width="113" height="12" border="0" /></a></td>
                </tr>
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