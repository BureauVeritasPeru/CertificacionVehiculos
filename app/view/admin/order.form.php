        <table CELLPADDING="0" CELLSPACING="0" width="500" align=center border="0">
          <tr>
            <td width="230"><strong>N&uacute;mero de Orden</strong></td>
            <td>: <?php echo str_pad($id_order, 6, "0", STR_PAD_LEFT); ?></td>
          </tr>
          <tr>
            <td>Cliente </td>
            <td>: <?php echo $customer; ?></td>
          </tr>
          <tr>
            <td>Fecha de Registro</td>
            <td>: <?php echo $registerDate; ?></td>
          </tr>
        </table>

        <br />

        <table width="500" align="center"class="tblContainer" cellpadding="0" cellspacing="0" border="1">
        <tr class="TRHead"> 
          <td width="200" align="center"><strong>Producto</strong></td>
          <td width="110" align="center"><strong>Precio Unitario</strong></td>
          <td width="80" align="center"><strong>Cantidad</strong></td>
          <td width="100" align="center"><strong>Subtotal</strong></td>
        </tr>
    <?php
	$result=ShopOrder::getDetail_List($id_order);
	while($rs=ShopOrder::fetchArray($result)){
	?>
            <tr class="TRList" height="20">
              <td><?php echo $rs["description"];?></td>
              <td align="right"><?php echo number_format($rs["price"],2,'.',',');?></td>
                                      <td align="center"><?php echo ($rs["quantity"]*$rs["stock"]);?></td>
              <td align="right">$<?php echo number_format($rs["subtotal"],2,'.',',');?></td>
            </tr>
	<?php } ?>
            <tr>
              <td align="right" colspan="3"><strong>Subtotal</strong></td>
              <td align="right"><strong>$<?php echo number_format($total,2,'.',',')?></strong></td>
            </tr>
            <tr>
              <td align="right" colspan="3"><strong>tax</strong></td>
              <td align="right"><strong>$<?php echo number_format($tax,2,'.',',')?></strong></td>
            </tr>
            <tr>
              <td align="right" colspan="3"><strong>total</strong></td>
              <td align="right"><strong>$<?php echo number_format($gtotal,2,'.',',')?></strong></td>
            </tr>
        </table>
        <table width="500" align="center" border="0" cellspacing="0" cellpadding="1">
            <tr>
            <td colspan="2" height="50"><input type="button" value="regresar" onClick="javascript:Back();"></td>
            </tr>
              <tr>
                <td width="50%" valign="top" class="border"><table width="100%" border="0" cellpadding="2" cellspacing="0" class="contente">
                    <tr>
                      <td colspan="2" align="left" class="t1"><strong>Datos de Env&iacute;o </strong></td>
                    </tr>
                <tr>
                  <td width="60">Nombre</td>
                  <td>: <?php echo $shipFirstName?></td>
                </tr>
                <tr>
                  <td nowrap>Empresa</td>
                  <td>: <?php echo $shipLastName?></td>
                </tr>
                <tr>
                  <td>Direcci&oacute;n</td>
                  <td>: <?php echo $shipAddress?></td>
                </tr>
                <tr>
                  <td>Ciudad</td>
                  <td>: <?php echo $shipCity?></td>
                </tr>
                <tr>
                  <td>Pa�s</td>
                  <td>: <?php echo $shipCountry?></td>
                </tr>
                <tr>
                  <td>C&oacute;digo Postal</td>
                  <td>: <?php echo $shipPostalCode?></td>
                </tr>
                <tr>
                  <td>Tel&eacute;fono</td>
                  <td>: <?php echo $shipPhone?></td>
                </tr>
                <tr>
                  <td colspan="2" align="center">&nbsp;</td>
                </tr>
                                            </table></td>
            <td>&nbsp;</td>
            <td width="50%" valign="top" class="border"><table width="100%" border="0" cellpadding="2" cellspacing="0" class="contente">
                <tr>
                  <td colspan="2" align="left" class="t1"><strong>Datos de Facturaci&oacute;n </strong></td>
                </tr>
                <tr>
                  <td width="60">Nombre</td>
                  <td>: <?php echo $billFirstName?></td>
                </tr>
                <tr>
                  <td>Empresa</td>
                  <td>: <?php echo $billLastName?></td>
                </tr>
                <tr>
                  <td>Direcci&oacute;n</td>
                  <td>: <?php echo $billAddress?></td>
                </tr>
                <tr>
                  <td>Ciudad</td>
                  <td>: <?php echo $billCity?></td>
                </tr>
                <tr>
                  <td>Pa�s</td>
                  <td>: <?php echo $billCountry?></td>
                </tr>
                <tr>
                  <td nowrap="nowrap">C&oacute;digo Postal</td>
                  <td>: <?php echo $billPostalCode?></td>
                </tr>
                <tr>
                  <td>Tel&eacute;fono</td>
                  <td>: <?php echo $billPhone?></td>
                </tr>
                <tr>
                  <td>E-mail</td>
                  <td>: <?php echo $billEmail?></td>
                </tr>
            </table></td>
          </tr>
        </table>
