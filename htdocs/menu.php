<?
include ("conexion.php");

//------------DISEÑO DE OBJETO
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
				$strcns_u="UPDATE contenidos2 SET orden=".$i." where id=".$fila['id'];
				$consulta_u=mysql_query($strcns_u) or die(mysql_error($GLOBALS['link']));
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
		echo $indent.$this->id." / ";
		
		if($this->hijos>0){
			echo "<a href=''>".$this->titulo."</a><br>";
		}else{
			echo $this->titulo."<br>";
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
	$strcns_u="UPDATE contenidos2 SET orden=".$i." where id=".$fila['id'];
	$consulta_u=mysql_query($strcns_u);
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
$arbol->activar();
$arbol->display();

?>