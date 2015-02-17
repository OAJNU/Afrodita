<?
class rama{

	//PROPIEDADES
	var $id;
	var $titulo;
	var $html_contenido;
	var $hijos;
	var $profundidad;
	var $padre;
	var $orden;
	var $expandido;
	var $activo;
	var $ultimo_item;

	//CONSTRUCTOR
	function rama($_id,$_titulo,$_hijos,$_padre,$_profundidad,$id_activo){
	
		//PROPIEDADES
		$this->id=$_id;
		$this->titulo=$_titulo;
		$this->hijos=$_hijos;
		$this->padre=&$_padre;
		$this->profundidad=$_profundidad;
		$this->orden=$_orden;
		$this->expandido=0;
		$this->ultimo_item;
		
		//IMG PRELOAD
		if($this->padre->titulo=='Nodo Padre'){
			array_push($GLOBALS['menu_img_preload'],"imgs/it_pr_inac_".eliminarEspacios($this->titulo)."jpg");
		}
		//HIJOS
		if($this->hijos>0){
			$this->lista_hijos=array();
			if($this->id==NULL) {
				$strcns="SELECT id,titulo,hijos FROM contenidos2 WHERE padre IS NULL ORDER BY orden ASC";
			}
			else $strcns="SELECT id,titulo,hijos FROM contenidos2 WHERE padre=".$this->id." ORDER BY orden ASC";
			$consulta=@mysql_query($strcns) or $GLOBALS['error'].=@mysql_error($GLOBALS['link']);
			while($fila=@mysql_fetch_array($consulta)){
				$this->lista_hijos[count($this->lista_hijos)]=new rama($fila['id'],$fila['titulo'],$fila['hijos'],&$this,$this->profundidad+1,$id_activo);
				if($fila['id']==$id_activo){
					$this->lista_hijos[count($this->lista_hijos)-1]->activo=true;
					$this->lista_hijos[count($this->lista_hijos)-1]->expandirAscendientes();
					$GLOBALS['objeto_activo']=&$this->lista_hijos[count($this->lista_hijos)-1];
				}
			}	
		}
	}
	function displayMapaSitio(){
		//MOSTRARSE A SI MISMO
		$indent=getIndent($this->profundidad);
		if($this->titulo!="Nodo Padre"){
			echo "<tr><td class='texto_base' height=20>".$indent." · ";	
			//si es seccion principal
			if($this->padre->padre==NULL) echo "<a href='index.php?item_activo=".$this->id."' class='subtitulo1'><span  style='text-transform:uppercase;'><strong>".$this->titulo."</strong></span></a></td></tr>";
			//si no es seccion principal
			else echo "<a href='index.php?item_activo=".$this->id."' class='texto_base'>".$this->titulo."</a></td></tr>";
		}
		$this->mostrarHijosMapaSitio();
	}
	function mostrarHijosMapaSitio(){
		if($this->hijos>0){
			for($i=0;$i<count($this->lista_hijos);$i++){
				$this->lista_hijos[$i]->displayMapaSitio($tipo_contenido);
			}
		}
	}	
	function display($tipo_contenido=0){
		//MOSTRARSE A SI MISMO
		if($this->titulo!='Nodo Padre'){
			echo $this->getHTMLOutput($tipo_contenido);
			if($this->expandido==true){
				if($this->hijos>0){
					$this->mostrarHijos($tipo_contenido);
				}	
			}
		}
	}
	function mostrarHijos($tipo_contenido){
		if($this->hijos>0){
			for($i=0;$i<count($this->lista_hijos);$i++){
				if(count($this->lista_hijos)-1>$i) $this->lista_hijos[$i]->display($tipo_contenido);
				else {
					//ULTIMO ITEM, sacar la linea: se infecta al ultimo hijo de cada nodo principal con ultimo_item.
					if($this->padre->padre==NULL) {
						$this->lista_hijos[$i]->ultimo_item=true;//no pone la ultima linea
					}
					// y este contagia a sus descendientes.
					else if($this->ultimo_item){
						$this->lista_hijos[$i]->ultimo_item=true;
					}
					//luego en la funcion getHTMLOutput se pregunta si es ultimo_item, si esta expandido y si no tiene hijos para poner o no poner la linea inferior
					$this->lista_hijos[$i]->display($tipo_contenido);
				}
			}
		}
	}	
	function &GetPadre(){
		return $this->padre;
	}
	function &expandirAscendientes(){
		$this->expandido=true;
		if($this->padre!=NULL){
			$_padre=&$this->GetPadre();
			$_padre->expandirAscendientes();
		}
	}
	function getHTMLOutput($tipo_contenido){
		if($tipo_contenido==2) $sufijo="";
		if($tipo_contenido==4) $sufijo="_cvi";
		$link="<a href='index.php?item_activo=".$this->id."' class='menu_item'>";
		if($this->id==116) $link="<a href='oajnus/' target='_blank' class='menu_item'>";
		if($this->padre->padre==NULL){
			$celda="<tr><td><table width='".$GLOBALS['ancho_menu']."' border='0' cellpadding='0' cellspacing='0'><tr><td width=".$GLOBALS['ancho_menu']." height='23' class='menu".$sufijo."'>";
			if(!$this->expandido) {
				if($this->hijos>0)$img_out="<img src='imgs/it_princ_inact_f".$sufijo.".jpg' border=0>";
				else $img_out="<img src='imgs/it_princ_inact_no_f".$sufijo.".jpg' border=0>";
				$img_out.="<img src='imgs/it_pr_inac_".eliminarEspacios($this->titulo).$sufijo.".jpg' border=0>";
			}
			else{
				if($this->hijos>0)$img_out="<img src='imgs/it_princ_act_f".$sufijo.".jpg' border=0>";
				else $img_out="<img src='imgs/it_princ_act_no_f".$sufijo.".jpg' border=0>";
				$img_out.="<img src='imgs/it_pr_ac_".eliminarEspacios($this->titulo).$sufijo.".jpg' border=0>";
				if($this->hijos>0) $img_out.="<br><img src='imgs/item_principal_activo_barba".$sufijo.".jpg' border=0>";
			}
			$cierre="</a></td></tr></table></td></tr>";
			$strout=$celda.$link.$img_out.$cierre;
		}else{
			$ancho_margen=$this->profundidad*10+10;
			$altomargen=25;
			$ancho_celda=$GLOBALS['ancho_menu']-$ancho_margen;
			$ancho_margen_derecho=10;
			
			//FLECHA
			if($this->hijos>0){
				if($this->expandido){
					if($this->activo){
						$flecha="<img src='imgs/flecha_hijos_expandida_activa".$sufijo.".jpg' border=0>";
					}
					else{
						$flecha="<img src='imgs/flecha_hijos_expandida".$sufijo.".jpg' border=0>";
					}
				}
				else{
					$flecha="<img src='imgs/flecha_hijos_no_expandida".$sufijo.".jpg' border=0>";
				}
			}
			else{
				$flecha="<img src='imgs/spacer.gif' height=1>";
			}
			
			$celda="<tr><td><table width='".$GLOBALS['ancho_menu']."' border='0' cellpadding='0' cellspacing='0'>";
			$celda.="<tr><td width=".$ancho_margen." align='right'>".$flecha."</td><td height='".$altomargen."' class='menu'>";
			$cierre.="</a></td><td width=".$ancho_margen_derecho.">&nbsp;</td></tr>";
			if(($this->ultimo_item&&$this->expandido==false)||($this->ultimo_item&&$this->expandido&&$this->hijos==0))$cierre.="<tr><td colspan=2 height=6><img src='imgs/spacer.gif' height=6><br></td></tr>";
			else $cierre.="<tr><td width=".$ancho_margen." height=1 ><img src='imgs/spacer.gif' height=1></td><td colspan=2 width=".$ancho_celda." height=1 background='imgs/menu_linea_puntos".$sufijo.".jpg'><img src='imgs/spacer.gif' height=1></td></tr>";
			$cierre.="</table></td></tr>";
			if($this->activo){
				$link="<span class='item_activo'>";
				$l_cierre="</span>";
			}
			$strout=$celda.$link.$this->titulo.$l_cierre.$cierre;
		}
		return ($strout);
	}
	function getTipoLink(){
			$strcnshtml="SELECT tipo_contenido as tipo FROM contenidos_html WHERE id_contenido=".$this->id;
			$conshtml=@mysql_query($strcnshtml) or $GLOBALS['error'].=@mysql_error($GLOBALS['link']);
			return(@mysql_result($conshtml,0,'tipo'));
	}
	function getDescripcionLink(){
			$strcnshtml="SELECT descripcion FROM contenidos_html WHERE id_contenido=".$this->id;
			$conshtml=@mysql_query($strcnshtml) or $GLOBALS['error'].=@mysql_error($GLOBALS['link']);
			return(@mysql_result($conshtml,0,'descripcion'));
	}
	function getIndent($profundidad){
	for($i=0;$i<$profundidad;$i++){
		$strout.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	return ($strout);
}
}

?>