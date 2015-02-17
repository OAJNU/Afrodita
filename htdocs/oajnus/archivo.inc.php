<?
function getMesesArchivo(){
		$consulta=mysql_query("SELECT date_format(mes_archivo,'%Y-%m') ma,
      CONCAT(
        CASE MONTH(mes_archivo)
            WHEN 1 THEN 'Enero'
            WHEN 2 THEN 'Febero'
            WHEN 3 THEN 'Marzo'
            WHEN 4 THEN 'Abril'
            WHEN 5 THEN 'Mayo'
            WHEN 6 THEN 'Junio'
            WHEN 7 THEN 'Julio'
            WHEN 8 THEN 'Agosto'
            WHEN 9 THEN 'Setiembre'
            WHEN 10 THEN 'Octubre'
            WHEN 11 THEN 'Noviembre'
            WHEN 12 THEN 'Diciembre'
        END,
        ' de ',
        YEAR(mes_archivo)) AS df
      FROM noticias WHERE activa=TRUE
    group by df, ma
    HAVING length(ma) > 0
    order by ma DESC") or die(mysql_error($GLOBALS['link']));
		while($fila=mysql_fetch_array($consulta)){
			$result.='<tr>
                  <td height="25" background="imgs/linea_menu.jpg"><a href="archivo.php?mes_archivo='.urlencode($fila['ma']).'" class="menu_link"><img src="imgs/flecha.jpg" width="12" height="8" />'.$fila['df'].'</a></td>
                </tr>';
		}
		return($result);
	}
?>