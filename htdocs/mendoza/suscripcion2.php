<html>
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<body>
<p>OAJNU</p>
<p>
<font color="#990000"><strong>
  <?php

function vinny() 	{if (mysql_error()== "Duplicate entry '$_REQUEST[Email]' for key 1"){
							echo "La direccion de E-mail ya existe en nuestra base de datos"; 
							die();
							} 
					else{
						die(mysql_error());
						}
					}

	if ($_SESSION['tmptxt'] == $_REQUEST['verificacion']) {
		$conexion=mysql_connect("192.168.0.57","agregar","hola") 
  or die("Problemas en la conexion");
mysql_select_db("oajnu",$conexion) or
  die("Problemas en la seleccion de la base de datos");
mysql_query("insert into Mailing(Nombre,Apellido,Edad,Provincia,Email,Profesion) values 
   
   ('$_REQUEST[nombre]',
			   '$_REQUEST[Apellido]',
			   '$_REQUEST[Edad]',
			   '$_REQUEST[Provincia]',
			   '$_REQUEST[Email]',
			   '$_REQUEST[Profesion]'
			   )", 
   $conexion) or vinny(); 
mysql_close($conexion);
echo "Te suscribiste de forma exitosa";
	} else {
		echo "Código mal escrito. Intentelo nuevamente";
		
	}
	

?>
</strong></font>
</p>
<p>
  <input type="submit" onclick="MM_goToURL('parent','http://oajnu.org/index.php?item_activo=530&amp;lang=es');return document.MM_returnValue" value="Volver"/>
</p>
</body>
</html>

