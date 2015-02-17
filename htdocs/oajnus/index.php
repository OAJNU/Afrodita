<?
include "../conexion.php";
include "archivo.inc.php";
session_start();
$_userpower=$HTTP_SESSION_VARS['_userpower'];
if(!$HTTP_SESSION_VARS['_userpower']) {
	header('location: login.php'); 
}
$link=conectarDB();
function generarHTML($consulta){
		while($fila=mysql_fetch_array($consulta)){
			$strcom="SELECT count(*) as conteo FROM comentarios WHERE id_noticia=".$fila['id'];
			$cnscom=mysql_query($strcom)or die(mysql_error($GLOBALS['link']));
			$totcom=mysql_result($cnscom,0,'conteo');
			if($totcom>0){
				if($totcom==1) $strcoment="1 comentario.";
				else $strcoment=$totcom." comentarios.";
			}else{
				$strcoment="Ningún comentario.";
			}
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
		$htmlstr.='<tr>
         <td><br>'.$foto.'<div class="autor"> Por <strong>'.$fila['autor'].'</strong>. Publicado el <strong>'.$fila['sp_fecha'].'</strong>. '.$strcoment.'</div>
                       <div class="titulo_entrada">'.$fila['titulo'].'</div>
                      <div class="texto_principal">'.$fila['prevista'].'<a href="entrada.php?id_noticia='.$fila['id'].'"><img src="imgs/mas.jpg" width="27" height="8" class="mas" /></a></div></td>
                  </tr><tr>
                    <td height="25" background="imgs/linea_menu.jpg">&nbsp;</td>
                  </tr>';
		}
		return $htmlstr;
}
function getPortada(){
		$strcns="select DATE_FORMAT(n.fecha,'%d/%m/%Y') as sp_fecha, n.* from noticias n, secciones s, ordenes o 
		WHERE o.id_noticia=n.id AND o.id_seccion=s.id AND (s.id=1 OR s.id=0) AND n.activa=1 AND n.mes_archivo IS NULL order by o.orden desc, n.fecha desc";
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
                  <td height="25" background="imgs/linea_menu.jpg"><img src="imgs/ultimas_entradas.jpg" width="113" height="12" /></td>
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