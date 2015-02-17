<script type="text/javascript">
function versionimp(){
	var ancho=579;
	var alto=350;
	var posAncho=(screen.width-ancho)/2;
	var posAlto=(screen.height-alto)/2;
	var atributos='scrollbars=yes,resizable=no,statusbar=0,width='+ancho+',height='+alto+',left='+posAncho +',top='+posAlto;
	a=window.open('scripts/popupimprimible.php?id_contenido='+<?=$objeto_activo->id?>,'imprimible',atributos)
	a.focus();
}
</script>
<table border="0" cellpadding="0" cellspacing="0" align='center'>
  <!-- fwtable fwsrc="menu.png" fwbase="menu.png" fwstyle="Dreamweaver" fwdocid = "1443153241" fwnested="1" -->
  <tr>
    <td colspan="2"><table align="left" border="0" cellpadding="0" cellspacing="0" width="774">
        <tr>
          <td colspan="2">
            <table width="774"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="352"><img src="imgs/top_cvi.jpg" width="352" height="133" border="0"></td>
                <td width="276" background="imgs/top_cvi_r2_c10.jpg">&nbsp;</td>
                <td><img src="imgs/top_der_esq_cvi.jpg" width="146" height="133"></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td width="760" height="26" background="imgs/top_cvi_r3_c2.jpg">&nbsp;</td>
          <td width="15" background="imgs/sombra_der.jpg"></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="759"><table width="759" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
          <td height="100%" valign="top">
            <table width="<? echo $GLOBALS['ancho_menu'];?>" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#6A8192">
              <tr>
                <td background="imgs/menu_top_cvi.jpg" align='right'><img src='imgs/menu_top_cvi.jpg' width="100%" height=58></td>
              </tr>
              <?
				for($i=0;$i<count($arbol->lista_hijos);$i++){
						$arbol->lista_hijos[$i]->display($tipo);
				}
				?>
              <tr>
                <td background="imgs/menu_bottom_cvi.jpg" align='right'></td>
              </tr>
              <tr>
                <td height='100%' bgcolor="#A4ACB4"><img src='imgs/spacer.gif' height="100%" width="1"></td>
              </tr>
          </table></td>
          <td height="100%" valign="top"><table width="561" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9">
              <tr >
                <td width="35" height="44" background="imgs/pagina_top_fondo_cvi.jpg">&nbsp;</td>
                <td width="476" height="44" valign="middle" background="imgs/pagina_top_fondo_cvi.jpg"><span class="ruta"><? echo getRutaContenido($GLOBALS['objeto_activo'],"");?></span></td>
                <td width="50" height="44" background="imgs/pagina_top_fondo_cvi.jpg">&nbsp;</td>
                <td height="44" background="imgs/pagina_top_fondo.jpg">&nbsp;</td>
              </tr>
              <tr valign="top">
                <td height="100%" colspan="4"><? 
		    if(strlen($error)==0) {
		   		echo $contenido_html;
				 echo '<br><br><table width="561" border="0" cellpadding="0" cellspacing="0">
  <tr valign="bottom"> <td width=490 height="30" align="right"><a href="javascript:versionimp()"><img src="imgs/versionimp.gif" width="117" height="18" border=0></td></tr></table>';
			}
		   else echo mostrarError($error);
		   ?>&nbsp;</td>
              </tr>
              <tr background="imgs/pagina_bottom_fondo_cvi.jpg" >
                <td height="28" colspan="4">&nbsp; </td>
              </tr>
          </table></td>
        </tr>
    </table></td>
    <td width="15" background="imgs/sombra_der.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table align="left" border="0" cellpadding="0" cellspacing="0" width="759">
        <tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="37" height="69"><img src="imgs/bottom_izq_cvi.jpg" width="37" height="69"></td>
                <td width="678" valign="middle" background="imgs/bottom_fondo_cvi.jpg" align="center">
                  <div align="center"><img src="imgs/spacer.gif" width="678" height="1"> </div>
                  <span class="linkblanco"><a href="mapasitio.php" class="linkblanco"><?=$MAPA_SITIO;?></a> &nbsp;<a class="linkblanco">|</a>&nbsp;<a href="<?=$FILE?>?item_activo=118&lang=<?=$lang;?>" class="linkblanco"><?=$CONTACTANOS?></a></span><br>
                <br>                </td>
                <td width="59"><img src="imgs/bottom_der_cvi.jpg" width="59" height="69"></td>
              </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>
