<?
include "conexion.php";
$link=conectarDB();
echo mysql_result(mysql_query("select NOW() as fecha from contenidos2"),0,"fecha");
?>