<?php
include "../conexion.php";
header("Content-type: image/jpeg");
$id_imagen=$HTTP_GET_VARS['id_imagen'];
$width=$HTTP_GET_VARS['$width'];
if(!$height>0) $height=119;
$link=conectarDB();
$cnsimagen=mysql_query("SELECT path FROM fotos where id=".$id_imagen) or die(mysql_error($link));
$file="../oajnus/imagenes/".mysql_result($cnsimagen,0,'path');
//die($file);
mysql_close($link);
$origen = @imageCreateFromJpeg($file);
$size=getImageSize($file);
$ancho=$size[0];
$alto=$size[1];
$dalto=$height;
$dancho=$height/$alto*$ancho;
if($dancho>$ancho) $dancho=$ancho;
if($dalto>$alto) $dalto=$alto;

$destino = imageCreateTrueColor(100,$dalto);
imageCopyResized($destino,$origen,0,0,0,0,$dancho,$dalto,$ancho,$alto);
ImageJpeg($destino,'',80);
?>
