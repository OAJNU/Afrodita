<?
function generarImagenesMenu($titulo){
		$texto=strtoupper($titulo);
		// IMAGEN INACTIVA //
		$patharchivo="imgs/it_princ_inac_".strtolower(str_replace(" ","",$titulo)).".jpg";
		if(!file_exists($patharchivo)){
			@unlink($patharchivo);
		}
		$im=imagecreatefromjpeg("imgs/base_inactivo.jpg"); 
		$blanco = imagecolorallocate($im, 255, 255, 255); // BLANCO
		$fuente = realpath('fuentes/helconbold.ttf');
		// Creacion de la imagen
		imagettftext($im, 10.2, 0, 8, 16, $blanco, $fuente, $texto);
		imagejpeg($im,$patharchivo);
		imagedestroy($im);
		
		// IMAGEN ACTIVA //
		
		$patharchivo="imgs/it_princ_ac_".strtolower(str_replace(" ","",$titulo)).".jpg";
		if(!file_exists($patharchivo)){
			@unlink($patharchivo);
		}
		$im=imagecreatefromjpeg("imgs/base_activo.jpg"); 
		$blanco = imagecolorallocate($im, 255, 255, 255); // BLANCO
		$fuente = realpath('fuentes/helconbold.ttf');
		
		// Creacion de la imagen
		imagettftext($im, 10.2, 0, 8, 16, $blanco, $fuente, $texto);
		imagejpeg($im,$patharchivo);
		imagedestroy($im);
	}
	generarImagenesMenu($HTTP_GET_VARS['titulo']);
	echo "ok";
?>