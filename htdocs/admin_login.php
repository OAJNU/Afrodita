<?
function admin_login($usuario,$password){
		if(!empty($usuario)&&!empty($password)){
		$link=conectarDB();
		$strcns='SELECT nombre, id FROM _admin where nombre="'.$usuario.'" and password="'.md5($password).'"';
		$consulta=mysql_query($strcns)or die(mysql_error($link)." 1 ");
		if(mysql_num_rows($consulta)>0) {
			session_start();
			global $HTTP_SESSION_VARS;
			$HTTP_SESSION_VARS['id_admin']=mysql_result($consulta,0,'id');
			$HTTP_SESSION_VARS['nombre_usuario']=mysql_result($consulta,0,'nombre');
			$HTTP_SESSION_VARS['_adminpower']=true;
			//session_register('_adminpower','nombre_usuario','id_admin');
			return (true);
		}
		else{
			return(false);
		}
	}
}
function cerrarSesion(){
	session_destroy();
	header('Location: admin_.php');
}
?>
