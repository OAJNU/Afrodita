<?
	include ("conexion.php");
	include ("admin_login.php");
	session_start();
	$_adminpower=$HTTP_SESSION_VARS['_adminpower'];
	if(!$_adminpower){
		session_destroy();
		header('location: admin_.php');
	}
		
	class rama{

	//PROPIEDADES
	var $id;
	var $titulo;
	var $html_link;
	var $hijos;
	var $img;
	var $rollover;
	var $profundidad;
	var $padre;
	var $orden;
	var $ascendencia;
	var $expandido;
	var $activo;

	//CONSTRUCTOR
	function rama($_id,$_titulo,$_html_link,$_hijos,$_img,$_rollover,$_padre,$_profundidad,$_orden){
	
		//PROPIEDADES
		$this->id=$_id;
		$this->titulo=$_titulo;
		$this->html_link=$_html_link;
		$this->img=$_img;
		$this->hijos=$_hijos;
		$this->rollover=$_rollover;
		$this->padre=&$_padre;
		$this->profundidad=$_profundidad;
		$this->orden=$_orden;
		$this->expandido=0;

		//HIJOS
		if($this->hijos>0){
			$this->lista_hijos=array();
			$strcns="SELECT * FROM contenidos2 WHERE padre=".$this->id;
			$consulta=mysql_query($strcns) or die(mysql_error($GLOBALS['link']));
			$i=0;
			while($fila=mysql_fetch_array($consulta)){
				$this->lista_hijos[count($this->lista_hijos)]=new rama($fila['id'],$fila['titulo'],$fila['contenido_html'],$fila['hijos'],$fila['menu_img'],$fila['menu_roll'],&$this,$this->profundidad+1,$i);
				$i++;
			}	
		}
	}
	function expandir(){
		$this->expandido=true;
	}
	function mostrarHijos(){
		if($this->hijos>0){
			for($i=0;$i<count($this->lista_hijos);$i++){
				$this->lista_hijos[$i]->display();
			}
		}
	}	
	function activar(){
			$this->activarAscendientes();
	}
	function display(){
		//MOSTRARSE A SI MISMO
		$indent=getIndent($this->profundidad);
		if($this->titulo!="Nodo Padre"){
			echo "<tr><td class='menu_item' height=30>".$indent.$this->id." / ";	
			if($this->padre->padre==NULL) echo "<a href='admin_modificar_item.php?contId=".$this->id."' class='menu_item'><span  style='text-transform:uppercase;color:#FFFFFF;'><strong>".$this->titulo."</strong></span></a></td></tr>";
			else echo "<a href='admin_modificar_item.php?contId=".$this->id."' class='menu_item'>".$this->titulo."</a></td></tr>";
		}
		$this->mostrarHijos();
	}
	
	function activarAscendientes(){
		if($this->padre!=NULL){
			$this->padre->expandido=true;
			$this->padre->activarAscendientes();
		}
	}

}
function getIndent($profundidad){
	for($i=0;$i<$profundidad;$i++){
		$strout.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	return ($strout);
}
$link=conectarDB();
$strcns="SELECT * FROM contenidos2 WHERE padre IS NULL";
$consulta=mysql_query($strcns) or die(mysql_error($GLOBALS['link']));

$arbol=new rama(0,"Nodo Padre","",6,"","",NULL,0,0);
$arbol->lista_hijos=array();

$i=0;
while($fila=mysql_fetch_array($consulta)){
	$arbol->lista_hijos[count($arbol->lista_hijos)]=new rama($fila['id'],$fila['titulo'],$fila['contenido_html'],$fila['hijos'],$fila['menu_img'],$fila['menu_roll'],&$arbol,$arbol->profundidad+1,$i);
	$i++;
}

// MENU INICIAL
function activarInicial($id,$obj){
	if($obj->id==$id){
		$obj->activar();
		return;
	}
	else{
		for($i=0;$i<count($obj->lista_hijos);$i++){
			activarInicial($id,$obj->lista_hijos[$i]);
		}
	}
}

activarInicial(0,$arbol);
?>
<html>
<head>
<title>OAJNU</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" bottommargin="0">
<table width="444" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#4D7493">
<?
for($i=0;$i<count($arbol->lista_hijos);$i++){
	$arbol->lista_hijos[$i]->display();
	
}
?>
<tr><td class='menu_item' height=60>&nbsp;</td></tr>
</table>
</body>
</html>