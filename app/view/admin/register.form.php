<?php
//Actualizar estado a Revisado
if($oItem->state==2){
	$oItem->state=1; //Revisado
	CrmRegisterForm::Update_State($oItem);
}

//Obtener Pais
$oCountry=UbgCountry::getItem($oItem->countryID);
//Obtener Asunto de Contacto
$oContact= CmsParameterLang::getItem($oItem->contactID, 1);
//Obtener Lista de Datos Adicionales
$lRegFields=CrmRegisterField::getList($kID);
?>
<script type="text/javascript" src="../assets/plugins/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
// Notice: The simple theme does not use all options some of them are limited to the advanced theme
tinyMCE.init({
	mode : "textareas",
	theme : "simple"
});

function on_submit(xform){

	xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"";?>";
	xform.submit();
}
</script>

<div class="modalContent" style="height:335px; width:530px;">
    <strong>Datos Comunes:</strong><br>
    <div>
	<table cellspacing="0" cellpadding="4" border="0" width="500" class="tblView">
        <?php if($oItem->name!=''){ ?>
          <tr>
            <td width="150">Nombres</td>
            <td><?php echo $oItem->name;?></td>
          </tr>
        <?php } ?>
        <?php if($oItem->lastname!=''){ ?>
          <tr>
            <td>Apellido Paterno</td>
            <td><?php echo $oItem->lastname;?></td>
          </tr>
        <?php } ?>
        <?php if($oItem->surname!=''){ ?>
          <tr>
            <td>Apellido Materno</td>
            <td><?php echo $oItem->surname;?></td>
          </tr>
        <?php } ?>
        <?php if($oItem->phone!=''){ ?>
          <tr>
            <td>Tel&eacute;fono</td>
            <td><?php echo $oItem->phone;?></td>
          </tr>
        <?php } ?>
        <?php if($oCountry!=NULL){ ?>
          <tr>
            <td>Pa&iacute;s</td>
            <td><?php echo ($oCountry!=NULL)? $oCountry->countryName: '';?></td>
          </tr>
        <?php } ?>
        <?php if($oItem->city!=''){ ?>
          <tr>
            <td>Ciudad</td>
            <td><?php echo $oItem->city;?></td>
          </tr>
        <?php } ?>
        <?php if($oItem->district!=''){ ?>
          <tr>
            <td>Distrito</td>
            <td><?php echo $oItem->district;?></td>
          </tr>
        <?php } ?>
        <?php if($oItem->email!=''){ ?>
          <tr>
            <td>E-mail</td>
            <td><?php echo $oItem->email;?></td>
          </tr>
        <?php } ?>
        <?php if($oContact!=NULL){ ?>
          <tr>
            <td>Tipo o asunto</td>
            <td><?php if($oContact!=NULL) echo $oContact->parameterName;?></td>
          </tr>
        <?php } ?>
        <?php if($oItem->comment!=''){ ?>
          <tr>
            <td>Comentario</td>
            <td><?php echo $oItem->comment;?></td>
          </tr>
        <?php } ?>
          <tr>
            <td>Fecha de Registro</td>
            <td><?php echo $oItem->registerDate;?></td>
          </tr>
          <tr>
            <td>Estado</td>
            <td><?php echo $DAO::getState($oItem->state);?></td>
          </tr>
	</table>
	</div>
    <br>
    <strong>Datos Adicionales: </strong>
    <br>
    <div>
	<table cellspacing="0" cellpadding="4" border="0" width="500" class="tblView">
    <?php
	foreach($lRegFields as $obj){ ?>
            <tr>
                    <td width="150"><?php echo $obj->fieldName;?></td><td><?php echo CrmRegisterField::getValue($obj, $oItem->formID);?></td>
            </tr>
    <?php } ?>
	</table>
	</div>
</div>
<div style="padding-top:8px;">
<input type="button" name="btnCancel" value="cerrar" onClick="javascript:Back();">
</div>
