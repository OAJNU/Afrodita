<? $item_activo = $item_activo +0;
$ruta="http://oajnu.org/index.php?item_activo=" . $item_activo . "&lang=es";
if ($item_activo > 0){ header("Location: $ruta");}
?>
<? 

function vinny() 	{if (mysql_error()== "Duplicate entry '$_REQUEST[Email]' for key 1"){
							$resultado = "La direccion de E-mail ya existe en nuestra base de datos"; 
							die();
							} 
					else{
						die(mysql_error());
						}
					}
session_start();
	if ($_SESSION['tmptxt'] == $_REQUEST['verificacion']) {
		$conexion=mysql_connect("192.168.0.57","agregar","hola") 
  or die("Problemas en la conexion");
mysql_select_db("oajnu",$conexion) or
  die("Problemas en la seleccion de la base de datos");
mysql_query("insert into Mailing(Nombre,Apellido,Edad,Provincia,Email,Profesion) values 
   
   ('$_REQUEST[nombre]',
			   '$_REQUEST[Apellido]',
			   '$_REQUEST[Edad]',
			   '$_REQUEST[Provincia]',
			   '$_REQUEST[Email]',
			   '$_REQUEST[Profesion]'
			   )", 
   $conexion) or vinny(); 
mysql_close($conexion);
$resultado = "Te suscribiste de forma exitosa";
	} else {
		$resultado = "Código mal escrito. Intentelo nuevamente";
		
	}


?>
<?
include ("conexion.php"); //CONEXION A LA BASE DE DATOS
include ("rama.php"); //CLASE RAMA1
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
	if(!$obj->activo) $strout="<a href='index.php?item_activo=".$obj->id."' class='ruta'>".$obj->titulo." &gt; </a>".$strout;
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
	$strcns="SELECT * from contenidos2 WHERE id=".$item_activo;
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
	$strcns="SELECT id from contenidos2 WHERE padre=".$GLOBALS['objeto_activo']->id." ORDER BY orden LIMIT 0,1";
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
    $strcnshtml="SELECT min(orden), id FROM contenidos2 WHERE padre IS NULL GROUP BY orden";
    $conshtml=@mysql_query($strcnshtml) or $GLOBALS['error'].=@mysql_error($GLOBALS['link']);
    return @mysql_result($conshtml,0,'id');
}
function getIndent($profundidad){
	for($i=0;$i<$profundidad;$i++){
		$strout.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	return ($strout);
}
$error="";
$menu_img_preload=array();//array que contiene las imagenes del menu a precargar
$ancho_menu=198;
$link=conectarDB();
$strcns="SELECT * FROM contenidos2 WHERE padre IS NULL";
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
	$tipo=$objeto_activo->getTipoLink();
}
if($tipo==4) $sufijo="_cvi";
else $sufijo="_oajnu";
?>

<html>
<head>
<title>OAJNU</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilo<?=$sufijo?>.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
<? echo j_array($menu_img_preload);?>

</script>

<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style></head>

<body leftmargin="0" topmargin="0" bottommargin="0">
<table border="0" cellpadding="0" cellspacing="0" align='center'>
<!-- fwtable fwsrc="menu.png" fwbase="menu.png" fwstyle="Dreamweaver" fwdocid = "1443153241" fwnested="1" -->
  <tr>
    <td colspan="2"><table align="left" border="0" cellpadding="0" cellspacing="0" width="774">
      <tr>
        <td colspan="2">
          <table width="774"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="352" background="imgs/top_oajnu_r1_c5.jpg"><img src="imgs/top_oajnu.jpg" width="352" height="133" border="0"></td>
              <td width="367" background="imgs/top_oajnu_r1_c5.jpg">&nbsp;</td>
              <td><img src="imgs/top_der_esq.jpg" width="55" height="133"></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td width="760" height="26" background="imgs/barra_inf_fondo.jpg">&nbsp;</td>
        <td width="15" background="imgs/sombra_der.jpg"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="759"><table width="759" border="0" align="left" cellpadding="0" cellspacing="0">
	  <tr>
		<td height="100%" valign="top">
			<table width="<? echo $GLOBALS['ancho_menu'];?>" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#4D7493">
				<tr><td background="imgs/menu_top_oajnu.jpg" align='center'><img src='imgs/menu_top_oajnu.jpg' width="100%" height=58></td>
				</tr>
				<?
					for($i=0;$i<count($arbol->lista_hijos);$i++){
						$arbol->lista_hijos[$i]->display($tipo);
					}
				?>
				<tr><td background="imgs/menu_bottom_oajnu.jpg" align='right'><img src='imgs/menu_bottom_oajnu.jpg' width="1" height=162></td>
				</tr>
				<tr><td height='100%' bgcolor="#94A5B5"><img src='imgs/spacer.gif' height=100% width=1></td>
				</tr>
		  </table>		</td>
	   <td height="100%" valign="top"><table width="561" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9">
         <tr >
           <td width="134" height="44">&nbsp;</td>
           <td width="17" height="44" valign="middle"></td>
           <td height="44" colspan="7" class="titulo">  <p>&nbsp;</p>
             <p>&nbsp;&nbsp;  Suscribite al Bolet&iacute;n</p>
             <p>&nbsp; </p></td>
           <td width="49" height="44">&nbsp;</td>
         </tr>
		 <tr> 
			<tr>
			<td height="50" class="titulo">&nbsp;</td>
			<td height="50" width="16" class="titulo" align="right" background="imgs/contenido_lineapuntvert.gif">&nbsp;</td>
			<td width="341" height="315" class="texto_base"><form name="formulario"method="post" action="suscripcion2.php"> 
 					  <p><center>*campos obligatorios</center><br />
		       *Nombre:  
		       <input name="nombre" type="text" id="nombre" size="20" maxlength="20"> 
             </p>
 					  <p>Apellido:
                        <input name="Apellido" type="text" id="Apellido" size="25" maxlength="25" />
             </p>
 					  <p>Edad: <input name="Edad" type="text" id="Edad" size="4" maxlength="2" /></p>
 					  <p>*Provincia: 
 					    <select name="Provincia">
 					    <option value="Buenos Aires">Buenos Aires</option>
 					    <option value="Catamarca">Catamarca</option>
 					    <option value="Chaco">Chaco</option>
 					    <option value="Chubut">Chubut</option>
 					    <option value="C&oacute;rdoba">C&oacute;rdoba</option>
 					    <option value="Corrientes">Corrientes</option>
 					    <option value="Entre R&iacute;os">Entre R&iacute;os</option>
 					    <option value="Formosa">Formosa</option>
 					    <option value="Jujuy">Jujuy</option>
 					    <option value="La Pampa">La Pampa</option>
 					    <option value="La Rioja">La Rioja</option>
 					    <option value="Mendoza" selected="selected">Mendoza</option>
 					    <option value="Misiones">Misiones</option>
 					    <option value="Neuqu&eacute;n">Neuqu&eacute;n</option>
 					    <option value="R&iacute;o Negro">R&iacute;o Negro</option>
 					    <option value="Salta">Salta</option>
 					    <option value="San Luis">San Luis</option>
 					    <option value="Santa Cruz">Santa Cruz</option>
 					    <option value="Santa Fe">Santa Fe</option>
 					    <option value="Santiado del Estero">Santiado del Estero</option>
 					    <option value="Tierra del Fuego">Tierra del Fuego</option>
 					    <option value="Tucum&aacute;n">Tucum&aacute;n</option>
                        <option value="OTRO">OTRO</option>
                      </select>

                        
 					  </p>
				    <p>*E-mail:
                        <input name="Email" type="text" id="Email" size="40" maxlength="60" />
 					  </p>
			        <p>Ocupaci&oacute;n:
                        <input name="Profesion" type="text" id="Profesion" size="40" maxlength="50" />
			        </p>
			        <center> 
                         <p>Imagen de verificacion:<br>
                           <img src="contenidos/suscripcion/captcha.php" width="193" height="97" vspace="3" /><br> <!-- IFRAME QE MUESTRA LA IMAGEN -->
                           Verificacion: <input name="verificacion" type="text" id="verificacion" size="9" maxlength="8">
                      </p>
                         <p><font color="#FF0000"><strong><? echo $resultado; $resultado=" "; ?></strong></font>                         
                         <font color="#FF0000"></font></p>
                         <input type="submit" onClick="MM_validateForm('nombre','','R','Edad','','NinRange5:99','Email','','RisEmail','verificacion','','R');return document.MM_returnValue" value="confirmar"/>
                    </center>
</form></td>
			<td width="6" height="80" class="titulo">&nbsp;</td>
			<td width="4" height="50" class="titulo">&nbsp;</td>
		</tr>
         <tr valign="top">
           <td height="100%" colspan="4"><table width="444" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			
		</table></td>
         </tr>
         <tr >
           <td height="28" colspan="4" background="imgs/pagina_bottom_fondo.jpg">&nbsp;             </td>
         </tr>
       </table></td>
	  </tr>
	</table></td>
   <td width="15" background="imgs/sombra_der.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table align="left" border="0" cellpadding="0" cellspacing="0" width="759">
	  <tr>
	   <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td width="37" height="69"><img src="imgs/bottom_izq.jpg" width="37" height="69"></td>
           <td width="678" valign="middle" background="imgs/bottom_fondo.jpg" align="center">             
                 <div align="center"><img src="imgs/spacer.gif" width="678" height="1">
                  </div>
				     
                  <span class="linkblanco"><a href="mapasitio.php" class="linkblanco">Mapa 
                  del sitio</a> &nbsp;<a class="linkblanco">|</a>&nbsp;<a href="index.php?item_activo=118" class="linkblanco">Contactanos</a></span><br>
                    <br>			    
                </div></td>
           <td width="59"><img src="imgs/bottom_der.jpg" width="59" height="69"></td>
         </tr>
       </table></td>
	   </tr>
	</table></td>
  </tr>
</table>
</body>
</html>