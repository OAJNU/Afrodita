<?
function user_login($usuario,$password){
		if(!empty($usuario)&&!empty($password)){
			$link=conectarDB();
			$strcns='SELECT CONCAT(nombre," ",apellido) as nombre_completo, 
			id FROM usuarios where username="'.$usuario.'" and password="'.md5($password).'"';
			$consulta=mysql_query($strcns)or die(mysql_error($link)." 1 ");
			if(mysql_num_rows($consulta)>0) {
				session_start();
				global $HTTP_SESSION_VARS;
				$HTTP_SESSION_VARS['id_usuario']=mysql_result($consulta,0,'id');
				$HTTP_SESSION_VARS['nombre_completo']=mysql_result($consulta,0,'nombre_completo');
				$HTTP_SESSION_VARS['username']=$usuario;
				$HTTP_SESSION_VARS['_userpower']=true;
				header("Location: index.php");
				return true;
			}
			else{
				return(false);
			}
		}
}
function cerrarSesion(){
	session_destroy();
	header('Location: login.php');
}
?>
