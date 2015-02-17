<?php

function conectarDB(){	
	$link=@mysql_connect("mysql.oajnu.org","oajnu","mLhrjVoB") or $GLOBALS['error'].='Imposible conectar con el servidor de datos.<br>';
	@mysql_select_db("oajnu") or $GLOBALS['error'].='Imposible seleccionar la base de datos.<br>';
	return($link);
}
function lang_table(){
	$lang=strtolower($GLOBALS['lang']);
	switch($lang){
		case "es":
			return "contenidos2";
			break;
		case "en":
			return "contenidos_en";
			break;
		case "fr":
			return "contenidos_fr";
			break;
		default:
			return "contenidos2";
			break;
	}
}
?>