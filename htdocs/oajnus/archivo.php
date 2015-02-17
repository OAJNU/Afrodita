<?
include "../conexion.php";
include "archivo.inc.php";

session_start();
$_userpower=$HTTP_SESSION_VARS['_userpower'];
if(!$HTTP_SESSION_VARS['_userpower']) {
	header('location: login.php'); 
}

$link=conectarDB();
$mes_archivo=urldecode($HTTP_GET_VARS['mes_archivo']);
function generarHTML($consulta){
		while($fila=mysql_fetch_array($consulta)){
			$strimg="SELECT max(id) as id, ubicacion_portada FROM fotos WHERE id_noticia=".$fila['id']." AND ubicacion_portada <> 0 GROUP BY ubicacion_portada";
			$posicion_foto=0;
			$id_foto="";
			$cnsimg=mysql_query($strimg)or die(mysql_error($GLOBALS['link']));
			if(mysql_num_rows($cnsimg)>0) {
				$id_foto=mysql_result($cnsimg,0,'id');
				$foto='<div class="foto"><a href="javascript:fotopop('.$id_foto.')"><img src="foto_resize.php?id_imagen='.$id_foto.'" /></a></div>';
			}else{
				$id_foto="";
				$foto="";
			}
			/*$img_min_tag='<img src="foto_porcentual.php?id_imagen='.$id_foto.'">';
			$imagen_arriba="";
			$imagen_abajo="";
			$imagen_izquierda="";
			switch($posicion_foto){
				case 1: 
					$imagen_arriba='<br><div align="center">'.$img_min_tag.'</div>';//arriba;
					break;
				case 2:
					$imagen_abajo='<br><div align="center">'.$img_min_tag.'</div>';
					break;
				case 3:
					$imagen_izquierda=$img_min_tag;
					break;	
			}
			// LINK
			$_link='<a href="noticia.php?id_noticia='.$fila['id'].'">';
			if(substr($fila['cuerpo'],0,5)=="http:") $_link='<a href="'.nl2br($fila['cuerpo']).'">';
			
			// FIN LINK
			if($posicion_foto!=3){
				$htmlstr.='
				<span class="titulotematiconivel1" height="50">'.$fila['titulo'].'</span>
				<br>
				'.$imagen_arriba.'
				<br>
				<span class="textoprincipal">'.stripslashes(nl2br($fila['prevista'])).$_link.'Ver detalle</a>
				<br>
				'.$imagen_abajo.'
				</span>';
			}else{
				$htmlstr.='
				<table cellpadding=0 cellspacing=0>
					<tr><td colspan="3"><span class="titulotematiconivel1">'.$fila['titulo'].'</span></td></tr>
					<tr valign="bottom">
					<td valign="bottom">'.$imagen_izquierda.'</td>
					<td width=12>&nbsp;</td>
					<td valing="bottom" class="textoprincipal"><br><br>
					'.stripslashes(nl2br($fila['prevista'])).$_link.'Ver detalle</a></td>
					</tr>
				</table>
				';
			}*/
		$htmlstr.=' <tr>
         <td>'.$foto.'<div class="autor"> Por <strong>'.$fila['autor'].'</strong>. Publicado el <strong>'.$fila['sp_fecha'].'</strong>.</div>
                       <div class="titulo_entrada">'.$fila['titulo'].'</div>
                      <div class="texto_principal">'.stripslashes($fila['prevista']).'<a href="entrada.php?id_noticia='.$fila['id'].'"><img src="imgs/mas.jpg" width="27" height="8" class="mas" /></a></div></td>
                  </tr><tr>
                    <td height="25" background="imgs/linea_menu.jpg">&nbsp;</td>
                  </tr>';
		$htmlstr.="<br>";
		}
		return $htmlstr;
}
function getPortada(){
	global $mes_archivo;
		$strcns="select DATE_FORMAT(n.fecha,'%d-%m-%Y') as sp_fecha, n.* from noticias n, secciones s, ordenes o 
		WHERE o.id_noticia=n.id AND o.id_seccion=s.id AND n.activa=1 AND n.mes_archivo LIKE ('".$mes_archivo."%') order by o.orden desc, n.fecha desc";
		$consulta=mysql_query($strcns) or die(mysql_error($GLOBALS['link']));
		return generarHTML($consulta);
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
function fotopop(id){
	 a=window.open("fotopop.php?id_imagen="+id+"&width="+window.screen.width,"foto","scrollbars=no,status=no,width=300,height=200");     a.focus();
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

-->
</style></head>

<body topmargin="0">
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
                  <td height="25" background="imgs/linea_menu.jpg"><img src="imgs/archivo.jpg" width="50" height="12" /></td>
                </tr>
             </table>
                 <table width="490" border="0" cellpadding="0" cellspacing="0">
				<?=getPortada();?>
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
                  <td height="25" background="imgs/linea_menu.jpg"><img src="imgs/flecha.jpg" width="12" height="8" /><span class="menu_link"><a href="cerrar_sesion.php">Cerrar sesi&oacute;n </a></span></td>
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