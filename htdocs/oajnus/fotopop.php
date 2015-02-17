<?php
include "../conexion.php";
$id_imagen=$HTTP_GET_VARS['id_imagen'];
$width=$HTTP_GET_VARS['width'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Foto Ampliada</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body leftmargin="0" topmargin="0" bottommargin="0" rightmargin="0">
<table cellpadding="0" cellspacing="0"><tr><td><img src="foto_large.php?id_imagen=<?=$id_imagen;?>&height=400<" onLoad="window.resizeTo(document.images[0].width+10,document.images[0].height+35)" /></td></tr></table>
</body>