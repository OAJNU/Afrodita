<?
$ancho_pedido=$HTTP_GET_VARS['ancho_pedido'];
$alto_pedido=$HTTP_GET_VARS['alto_pedido'];
if($ancho_pedido=="") $ancho_pedido=100;
if($alto_pedido=="") $alto_pedido=100;
if($nombre_foto=="") img_error("Imagen no especificada");
$nombre_foto=$HTTP_GET_VARS['nombre_foto'];
$path="fotos/";
$path_archivo=$path.$nombre_foto;
function img_error($texto){
	$azul = imagecolorallocate($im, 88, 119, 149); // AZUL
	$fuente = realpath('../fuentes/helconbold.ttf');
	// Creacion de la imagen
	imagettftext($im, 11, 0, 8, 17, $azul, $fuente, $texto);
	imagejpeg($im);
	imagedestroy($im);
}
function generar_miniatura(){
		global $tipo, $nombre_nomenclado;
		$width=$GLOBALS['ancho_pedido'];
		$height=$GLOBALS['alto_pedido'];
		$patharchivo=$GLOBALS['patharchivo'];
		if(!file_exists($patharchivo)){
			//header('Location: error.php');
			img_error("Imposible encontrar");
			return;
		}
		$origen = imageCreateFromJpeg($patharchivo);
		$size=getImageSize($patharchivo);
		$ancho=$size[0];
		$alto=$size[1];
		$medida=min($ancho,$alto);
		if($width>$ancho) $width=$ancho;
		if($height>$alto) $height=$alto;
		if($width/$height!=$ancho/$alto){
			$width=$ancho*$height/$alto;
			$height=$alto*$width/$ancho;
		}
		//@mkdir("miniaturas",0777);
		$destino = imageCreateTrueColor($width,$height);
		imageCopyResized($destino,$origen,0,0,0,0,$width,$height,$medida,$medida);
		return(ImageJpeg($destino));
	}
?>