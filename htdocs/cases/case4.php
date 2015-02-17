<table border="0" cellpadding="0" cellspacing="0" align='center'>
<!-- fwtable fwsrc="menu.png" fwbase="menu.png" fwstyle="Dreamweaver" fwdocid = "1443153241" fwnested="1" -->
  <tr>
    <td colspan="2"><table align="left" border="0" cellpadding="0" cellspacing="0" width="774">
      <tr>
        <td colspan="2">
          <table width="774"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="352" background="imgs/top_oajnu_r1_c5.jpg"><img src="imgs/top_oajnu.jpg" width="352" height="133" border="0"></td>
              <td width="367" background="imgs/top_oajnu_r1_c5.jpg">&nbsp;</td>
              <td><img src="imgs/top_der_esq.jpg" width="55" height="133"></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td width="760" height="26" background="imgs/barra_inf_fondo.jpg">&nbsp;</td>
        <td width="15" background="imgs/sombra_der.jpg"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="759"><table width="759" border="0" align="left" cellpadding="0" cellspacing="0">
	  <tr>
		<td height="100%" valign="top">
			<table width="<? echo $GLOBALS['ancho_menu'];?>" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#4D7493">
				<tr><td background="imgs/menu_top_oajnu.jpg" align='center'><img src='imgs/menu_top_oajnu.jpg' width="100%" height=58></td>
				</tr>
				<?
					for($i=0;$i<count($arbol->lista_hijos);$i++){
						$arbol->lista_hijos[$i]->display($tipo);
					}
				?>
				<tr><td background="imgs/menu_bottom_oajnu.jpg" align='right'><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="197" height="105">
                  <param name="movie" value="banners/banner_participe.swf?ranstr=quuasdasda">
                  <param name="quality" value="high">
                  <embed src="banners/banner_participe.swf?ranstr=quuasdasda" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="197" height="105"></embed>
				  </object></td>
				</tr>
				<tr><td bgcolor="#94A5B5" align='center'><a href="http://www.peacechild.org/" target="_blank"><img src="imgs/bannerpeace.jpg" width="192" height="93" border="0"></a></td>
				</tr>
				<tr><td height='100%' bgcolor="#94A5B5"><img src='imgs/spacer.gif' height=100% width=1></td>
				</tr>
		  </table>		</td>
	   <td height="100%" valign="top"><table width="561" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9">
         <tr >
           <td width="35" height="20" background="imgs/pagina_top_fondo.jpg">&nbsp;</td>
           <td width="476" height="20" valign="middle" background="imgs/pagina_top_fondo.jpg">&nbsp;</td>
           <td width="50" height="20" background="imgs/pagina_top_fondo.jpg">&nbsp;</td>
           <td height="20" background="imgs/pagina_top_fondo.jpg">&nbsp;</td>
         </tr>
         <tr valign="top">
           <td height="100%" colspan="4"> <? 
		   if(strlen($error)==0) {
		   		echo $contenido_html;
			}
		   else{
				 echo mostrarError($error);
		};?></td>
         </tr>
		 <tr valign="top">
           <td height="100%" colspan="4"><img src="imgs/spacer.gif" width="100%" height="9"></td>
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
           <td width="37" height="69"><img src="imgs/bottom_izq.jpg" width="37" height="69"></td>
           <td width="678" valign="middle" background="imgs/bottom_fondo.jpg" align="center">             

                 <div align="center"><img src="imgs/spacer.gif" width="678" height="1">
                  </div>
				     <span class="linkblanco"><a href="mapasitio.php" class="linkblanco">Mapa del sitio</a> &nbsp;<a class="linkblanco">|</a>&nbsp;<a href="index.php?item_activo=118" class="linkblanco">Contactanos</a></span><br>
                    <br>			    
                </div></td>
           <td width="59"><img src="imgs/bottom_der.jpg" width="59" height="69"></td>
         </tr>
       </table></td>
	   </tr>
	</table></td>
  </tr>
</table>
<br>
