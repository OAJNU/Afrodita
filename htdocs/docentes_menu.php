<?

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

function menu(){
	global $arbol;
	echo '<table width="'.$GLOBALS['ancho_menu'].'" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#4D7493">
				<tr><td background="imgs/menu_top_oajnu.jpg" align="center"><img src="imgs/menu_top_oajnu.jpg" width="100%" height=58></td>
				</tr>';

				  for($i=0;$i<count($arbol->lista_hijos);$i++){
				$arbol->lista_hijos[$i]->display($tipo);
			}
	
			echo '<tr><td background="imgs/menu_bottom_oajnu.jpg" align="center"></td>
				</tr>
				<tr><td height="100%" bgcolor="#94A5B5"><img src="imgs/spacer.gif" height=100% width=1></td>
				</tr>
</table>';
		
}
?>
