<?
function getComboDelegaciones($nroseleccion,$admitevacio,$strnula){
	$link=conectarDB();
	if(empty($strnula)) $strnula="Ninguna";
	if($admitevacio==true){
		$min=-1;
		$minvalue=-1;
		$titulo=$strnula;
	}else{
		$min=0;
		$minvalue=0;
		$titulo="[Seleccionar]";
	}
	$consulta=mysql_query("SELECT nombre, id from delegaciones ORDER BY nombre") or die(mysql_error($link));
	if($nroseleccion==$min||$nroseleccion=="") {
		$primero="SELECTED";
	}
	else{
		$primero="";
	}	
	$result="<option ".$primero." value=$min>".$titulo."</option>";
	while($fila=mysql_fetch_array($consulta)){
		if($nroseleccion==$fila['id']) $selected="SELECTED";
		else $selected="";
		$result.="<option value=".$fila['id']." ".$selected.">".$fila['nombre']."</option>";
	}
	return($result);
}

function getNombreDelegacion($id){
	$link=conectarDB();
	if(!empty($id)&&$id>=0){
		$consulta=mysql_query("SELECT nombre from delegaciones where id=".$id) or die(mysql_error($link));
		return(mysql_result($consulta,0,'nombre'));
	}else{
		return "Ninguna";
	}
}
function getComboDia($nroseleccion){
	$i=1;
	while($i<32){
		if($nroseleccion==$i) $selected="SELECTED";
		else $selected="";
		$strout.="<option value=".$i." ".$selected." >".$i."</option>";
		$i++;
	}
	return $strout;
}
function getComboMes($nroseleccion){
	$i=1;
	while($i<13){
		if($nroseleccion==$i) $selected="SELECTED";
		else $selected="";
		$strout.="<option value=".$i." ".$selected." >".$i."</option>";
		$i++;
	}
	return $strout;
}
function getComboAno($nroseleccion){
	$i=date('Y');
	$min=1930;
	while($i>$min){
		if($nroseleccion==$i) $selected="SELECTED";
		else $selected="";
		$strout.="<option value=".$i." ".$selected." >".$i."</option>";
		$i--;
	}
	return $strout;
}
?>