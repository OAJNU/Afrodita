<?
	include ("admin_login.php");
	session_start();
	$_adminpower=$HTTP_SESSION_VARS['_adminpower'];
	$mensaje=$HTTP_POST_VARS['mensaje'];
	if(!$_adminpower) header('location: admin_.php');		
	function mostrar_mensaje($msg){
		if($msg!=""){
			if($msg=="datos_modificados"){
				 $result="Los datos han sido modificados con exito";
			}
			if($msg=="pass_modificada"){
				 $result="La contraseña ha sido modificada";
				 
			}
			$htmlstr="<table width='450' border='0' cellspacing='0' cellpadding='0' class='oferta_laboral' align='center'>
					  <tr height='100'>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td align='center'><strong>".$result."</strong></strong></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
					  </tr>
					</table><br>";
			return($htmlstr);
		}
	}	
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Panel de control</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilo.css" rel="stylesheet" type="text/css">

</head>
<body leftmargin=0 topmargin=0>
<form action="<?=$PHP_SELF?>" method='post'><table width=100% height="100%"><tr valign='middle'><td>
<table width="355" height="100%" align='center' class="oferta_laboral" >
<tr height=100 class='of_tr_titulo'>
  <td align='center' height=60><span class="titulo">Herramientas de administracion</span></td>
</tr>
  <tr height="100">
  <td>
		<?=mostrar_mensaje($mensaje)?>
        <br>     	
        <div align="center">		    <a href="gestion_contenidos/arbol_principal.php">Editar menu principal </a><br>
            <br>
                <a href="blog_admin/index.php">OAJNUS - Administracion de entradas</a> <br>
                <br>
                <a href="users_admin/index.php">OAJNUS - Administracion de usuarios </a><br>
                <br>
                <a href="docentes_admin/arbol_principal.php">Editar menu principal DOCENTES </a><br>
<a href="admin_data.php">
          <br>
          Modificar datos del administrador</a><br>
		    <br>
			<a href="admin_sess_close.php">Cerrar la sesion</a><br>
		    <br>
     	</div></td>
    </tr>
  <tr height="50%"><td>&nbsp;</td></tr>
</table>
</td></tr></table>
</form>
</body>
</html>
