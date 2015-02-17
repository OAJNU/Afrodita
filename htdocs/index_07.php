<?
include ("conexion.php"); //CONEXION A LA BASE DE DATOS
include ("rama.php"); //CLASE RAMA1

$FILE="index_07.php";

$lang=$HTTP_GET_VARS['lang'];
if(empty($lang)) $lang="es";

switch($lang){
	case "es":
		$MAPA_SITIO="Mapa del sitio";
		$CONTACTANOS="Contactanos";
		break;
	case "en":
		$MAPA_SITIO="Site map";
		$CONTACTANOS="Contact us";
}

//Cadena entre para parsear los templates
function cadenaEntre($cadena, $strinicio, $strfin){
		$inicio=strpos($cadena,$strinicio)+strlen($strinicio);
		$fin=strpos($cadena,$strfin);
		$cadena = substr($cadena,$inicio, $fin-$inicio);
		return $cadena;
}
//substring de espacios para las imagenes del menu principal
function eliminarEspacios($content) { 
	$content = preg_replace("/ +/", " ", trim($content)); 
	$content = str_replace(" ", "", $content); 
	$content = strtolower($content); 
	return $content; 

}
//Ruta del contenido
function getRutaContenido($obj,$strout){
	if(!$obj->activo) $strout="<a href='".$FILE."?item_activo=".$obj->id."' class='ruta'>".$obj->titulo." &gt; </a>".$strout;
	else $strout="<span class='ruta'><strong>".$obj->titulo."</strong> &gt;</span>";
	if($obj->padre->titulo!='Nodo Padre') $strout=getRutaContenido($obj->padre,$strout);
	return($strout);
}

//PARA CREAR UN ARRAY javascript CON PHP - para precarga de images
function j_array($var){
	$javastr .= "var d = new Array();";
	$diro="img/";
	while(list($key, $val) = each($var)){
		$javastr .= "d[$key] = new Image();"; 
		$javastr .= "d[$key].src = '$diro$val';";
	}
	return $javastr;
}
function esContenido($item_activo){
	$strcns="SELECT * from ".lang_table()." WHERE id=".$item_activo;
	if(@mysql_num_rows(@mysql_query($strcns))>0) return true;
	else return false;
}
function paginaNoEncontrada(){
	$GLOBALS['error'].="Imposible encontrar el contenido en el servidor. Esto puede deberse a que el contenido ha sido movido o que ha ocurrido un error interno en el sistema.";
};
function mostrarError($error){
	$htmlbase='<table width="561" border="0" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9"><tr><td colspan="7"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="561" height="100">
  <param name="movie" value="banners/banner_error.swf"><param name="quality" value="high"><embed src="banners/banner_error.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="561" height="100"></embed></object></td></tr><tr><td colspan="7">
  <tr> 
    <td height="50" class="titulo">&nbsp;</td> 
    <td height="50" class="titulo">&nbsp;</td>
    <td height="50" class="titulo">&nbsp;</td>
    <td height="50" class="titulo">&nbsp;</td>
    <td height="50" class="titulo">&nbsp;</td>
    <td height="80" class="titulo"> Ha ocurrido un error.</td>
    <td height="50" class="titulo">&nbsp;</td>
</tr></td>
  </tr>
  <tr><td width="20">&nbsp;</td><td width="50" valign="top">&nbsp;</td><td width="10">&nbsp;</td><td width="16" background="imgs/contenido_lineapuntvert_cvi.gif"></td><td width="10" class="texto_base">&nbsp;</td>
    <td width="315" class="texto_base">
      <br>
      Hubieron problemas procesando la petici&oacute;n. <br>
      <br>      <span class="cita_textual"> 
      '.$error.' <br>
      <br> </span>Disculpe las molestias ocasionadas.</td>
    <td width="60">&nbsp;</td></tr></table>';
	return $htmlbase;
};
function getIdPrimerHijo(){
	$strcns="SELECT id from ".lang_table()." WHERE padre=".$GLOBALS['objeto_activo']->id." ORDER BY orden LIMIT 0,1";
	$cns=@mysql_query($strcns) or $GLOBALS['error'].=@mysql_error($GLOBALS['link']);
    $fila=mysql_fetch_array($cns);
	return $fila['id']; //or $GLOBALS['error'].=@mysql_error($GLOBALS['link']);
}
function generarForm($archivo){
	if(@filesize($archivo)>0){
		$fh=fopen($archivo,'r');
		while($linea=fgets($fh,4096)){
			$htmlstring.=$linea;
		}
		$titulo='<tr> 
    <td height="50" class="titulo">&nbsp;</td> 
    <td height="50" class="titulo">&nbsp;</td>
    <td height="50" class="titulo">&nbsp;</td>
    <td height="50" class="titulo">&nbsp;</td>
    <td height="50" class="titulo">&nbsp;</td>
    <td height="80" class="titulo">'.$GLOBALS['objeto_activo']->titulo.'</td>
    <td height="50" class="titulo">&nbsp;</td>
</tr>';
		$htmlstring=cadenaEntre($htmlstring,"<!--inicio-->","<!--fin-->");
		$strout=str_replace("<!--titulo_subseccion-->",$titulo,$htmlstring);
		$strout=str_replace('<td width="395" class="texto_base">','<td width="395" class="texto_base" id="celda_contenido">',$strout);
		$strout=str_replace('<td width="315" class="texto_base">','<td width="315" class="texto_base" id="celda_contenido">',$strout);
		//agregamos las etiquetas de form y un hidden field
		$strout="<form action='forms/formgeneral.php'>".$strout;
		$strout.="<input type=hidden name='id_contenido' value=".$GLOBALS['objeto_activo']->id."></form>";
	}
	else{
		paginaNoEncontrada();
	}
	return $strout;
}
function leerContenidoHtml($archivo){
	if(@filesize($archivo)>0){
		$fh=fopen($archivo,'r');
		while($linea=fgets($fh,4096)){
			$htmlstring.=$linea;
		}
		$titulo='<tr>
    <td height="50" class="titulo">&nbsp;</td>
    <td height="50" class="titulo">&nbsp;</td>
    <td height="50" class="titulo">&nbsp;</td>
    <td height="50" class="titulo">&nbsp;</td>
    <td height="50" class="titulo">&nbsp;</td>
    <td height="80" class="titulo">'.$GLOBALS['objeto_activo']->titulo.'</td>
    <td height="50" class="titulo">&nbsp;</td>
</tr>';
		$htmlstring=cadenaEntre($htmlstring,"<!--inicio-->","<!--fin-->");
		$strout=str_replace("<!--titulo_subseccion-->",$titulo,$htmlstring);
		$strout=str_replace('<td width="395" class="texto_base">','<td width="395" class="texto_base" id="celda_contenido">',$strout);
		$strout=str_replace('<td width="315" class="texto_base">','<td width="315" class="texto_base" id="celda_contenido">',$strout);
	}
	else{
		paginaNoEncontrada();
	}
	return $strout;
}
function selectItemPrincipal(){
    $strcnshtml="SELECT min(orden), id FROM ".lang_table()." WHERE padre IS NULL GROUP BY orden";
    $conshtml=@mysql_query($strcnshtml) or $GLOBALS['error'].=@mysql_error($GLOBALS['link']);
    return @mysql_result($conshtml,0,'id');
}
function mostrarContenido(){
	//CONTENIDO HTML
	$tipo=$GLOBALS['objeto_activo']->getTipoLink();
	$descripcion=$GLOBALS['objeto_activo']->getDescripcionLink();

	if(empty($tipo)||empty($descripcion)) return paginaNoEncontrada();
	switch($tipo){
	/*  1. link
		2. html
		3. padre_vacio
		4. cvi
		5. cvi padre vacio*/
		case 1: //TIPO LINK
			header('Location: '.$descripcion);
			break;
		case 2: //TIPO HTML
			return leerContenidoHtml($descripcion);
			break;
		case 3: //TIPO PADRE VACIO
			header('Location: '.$FILE.'?item_activo='.getIdPrimerHijo());
			break;
		case 4: //TIPO CVI
			return leerContenidoHtml($descripcion);
			break;
		case 5: //TIPO CVI PADRE VACIO
			header('Location: '.$FILE.'?item_activo='.getIdPrimerHijo());
			break;
		case 6: //TIPO FORM
			// RESULTADO... espera una respuesta de form
			if($_GET['resultado']!="1") return(generarForm($descripcion));
			if($_GET['resultado']=="1") return(leerContenidoHtml("forms/exito.htm"));//todo salio bien
			break;
		case 7: //TIPO En construccion
			return leerContenidoHtml($descripcion);
			break;
		default:
			die("default");//return paginaNoEncontrada();
			break;
		}
}
// ERROR
$error="";
$menu_img_preload=array();//array que contiene las imagenes del menu a precargar
$ancho_menu=198;
$link=conectarDB();
$strcns="SELECT * FROM ".lang_table()." WHERE padre IS NULL";
$consulta=@mysql_query($strcns) or $GLOBALS['error'].=@mysql_error($GLOBALS['link']);
$item_activo=$HTTP_GET_VARS['item_activo'];
if(empty($item_activo)) $item_activo=selectItemPrincipal();
if(esContenido($item_activo)==false){
	$error.="El contenido al que intenta acceder no se encuentra disponible.";
	$arbol=new rama(0,"Nodo Padre",6,NULL,0,0);
}else{
	if(!isset($item_activo)) $item_activo=selectItemPrincipal();
	// LA VARIABLE ITEM ACTIVO TRAE EL ID del contenido activo DE LA BASE DE DATOS
	$arbol=new rama(0,"Nodo Padre",6,NULL,0,$item_activo);
	$contenido_html=mostrarContenido();
	$tipo=$objeto_activo->getTipoLink();

}
if($tipo==4) $sufijo="_cvi";
else $sufijo="_oajnu";
?>
<html>
<head>
<title>OAJNU<?=" | ".$objeto_activo->titulo?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilo<?=$sufijo?>.css?ranstr=asdasda" rel="stylesheet" type="text/css">
<script type="text/javascript">
function popupfoto(urlfoto){
	var posAncho=(screen.width-200)/2;
	var posAlto=(screen.height-200)/2;
	var atributos='resizable=no,statusbar=0,scrolling=no,width=200,height=200,left='+posAncho +',top='+posAlto;
	a=window.open('scripts/popupfoto.php?urlfoto='+urlfoto,'urlfoto',atributos)
	a.focus();
}
<? echo j_array($menu_img_preload);?>

</script>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style></head>

<body leftmargin="0" topmargin="0" bottommargin="0">
<?
if($objeto_activo->id!=291){
	switch($tipo){
		case 2: // HTML
			include "cases/case1.php";
			break;
		case 4: // CVI
			include "cases/case2.php";
			break;
		case 6: // FORM
			include "cases/case1.php";
			break;
		default:
			include "cases/case1.php";
			break;
	
	}
}else{
	include "cases/case1.php";
}
?>
</body>
</html>