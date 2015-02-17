<?php

function conectarDB(){	
	$link=@mysql_connect("mysql.oajnu.org","oajnu","mLhrjVoB") or $GLOBALS['error'].='Imposible conectar con el servidor de datos.<br>';
	@mysql_select_db("oajnu") or $GLOBALS['error'].='Imposible seleccionar la base de datos.<br>';
	return($link);
}

?>