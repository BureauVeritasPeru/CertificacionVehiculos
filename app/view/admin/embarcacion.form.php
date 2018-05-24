<?php
  $userAdmin  =AdmLogin::getUserSession();
?>
<script type="text/javascript">
function on_submit(xform){
xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
xform.submit();
}
</script>
<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->nombrePlanta:$MODULE->moduleName; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
  </div>
  <div class="box-body">
    <div class="form-group">
      <label class="col-sm-2 control-label ">Numeral de Embarcacion</label>
      
      <div class="col-sm-10">
        <input name="numeralEmbarcacion" autocomplete="off" type="text" id="numeralEmbarcacion" class="form-control" value="<?php echo $oItem->numeralEmbarcacion; ?>" maxlength="10">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Nombre de Embarcacion</label>
      
      <div class="col-sm-10">
        <input name="nombreEmbarcacion" autocomplete="off" type="text" id="nombreEmbarcacion" class="form-control" value="<?php echo $oItem->nombreEmbarcacion; ?>" >
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Matricula de Embarcacion</label>
      <div class="col-sm-10">
        <input name="matriculaEmbarcacion" type="text" class="form-control" id="matriculaEmbarcacion" value="<?php echo $oItem->matriculaEmbarcacion; ?>" >
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-sm-2 control-label ">Casco</label>
      <div class="col-sm-10">
        <input name="casco" type="text" class="form-control" id="casco" value="<?php echo $oItem->casco; ?>" maxlength="50">
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-sm-2 control-label ">Regimen</label>  
      <div class="col-sm-10">
        <input name="regimen" type="text" class="form-control" id="regimen" value="<?php echo $oItem->regimen; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Regimen</label>  
      <div class="col-sm-10">
        <input name="regimen" type="text" class="form-control" id="regimen" value="<?php echo $oItem->regimen; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">tipo de Preservacion</label>  
      <div class="col-sm-10">
        <input name="tipoPreservacion" type="text" class="form-control" id="tipoPreservacion" value="<?php echo $oItem->tipoPreservacion; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Eslora</label>  
      <div class="col-sm-10">
        <input name="eslora" type="text" class="form-control" id="eslora" value="<?php echo $oItem->eslora; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Manga</label>  
      <div class="col-sm-10">
        <input name="manga" type="text" class="form-control" id="manga" value="<?php echo $oItem->manga; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Puntal</label>  
      <div class="col-sm-10">
        <input name="puntal" type="text" class="form-control" id="puntal" value="<?php echo $oItem->puntal; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Capacidad de Bodega (m3) </label>  
      <div class="col-sm-10">
        <input name="capbod_m3" type="text" class="form-control" id="capbod_m3" value="<?php echo $oItem->capbod_m3; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Capacidad de Bodega (tm) </label>  
      <div class="col-sm-10">
        <input name="capbod_tm" type="text" class="form-control" id="capbod_tm" value="<?php echo $oItem->capbod_tm; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Resolución</label>  
      <div class="col-sm-10">
        <input name="resolucion" type="text" class="form-control" id="resolucion" value="<?php echo $oItem->resolucion; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Permiso de Pesca</label>  
      <div class="col-sm-10">
        <input name="permisoPesca" type="text" class="form-control" id="permisoPesca" value="<?php echo $oItem->permisoPesca; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Permiso de Zarpe</label>  
      <div class="col-sm-10">
        <input name="permisoZarpe" type="text" class="form-control" id="permisoZarpe" value="<?php echo $oItem->permisoZarpe; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Codigo de Pago</label>  
      <div class="col-sm-10">
        <input name="codigoPago" type="text" class="form-control" id="codigoPago" value="<?php echo $oItem->codigoPago; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Transmisor</label>  
      <div class="col-sm-10">
        <input name="transmisor" type="text" class="form-control" id="transmisor" value="<?php echo $oItem->transmisor; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Armador </label>  
      <div class="col-sm-10">
        <input name="armador" type="text" class="form-control" id="armador" value="<?php echo $oItem->armador; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Precinto</label>  
      <div class="col-sm-10">
        <input name="precinto" type="text" class="form-control" id="precinto" value="<?php echo $oItem->precinto; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Aparejo</label>  
      <div class="col-sm-10">
        <input name="aparejo" type="text" class="form-control" id="aparejo" value="<?php echo $oItem->aparejo; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Especie CHI </label>  
      <div class="col-sm-10">
        <input name="especieChi" type="text" class="form-control" id="especieChi" value="<?php echo $oItem->especieChi; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Especie CHD</label>  
      <div class="col-sm-10">
        <input name="especieChd" type="text" class="form-control" id="especieChd" value="<?php echo $oItem->especieChd; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">PMCE Norte Centro</label>  
      <div class="col-sm-10">
        <input name="pmceNorteCentro" type="text" class="form-control" id="pmceNorteCentro" value="<?php echo $oItem->pmceNorteCentro; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">PMCE Sur</label>  
      <div class="col-sm-10">
        <input name="pmceSur" type="text" class="form-control" id="pmceSur" value="<?php echo $oItem->pmceSur; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Nominada Norte Centro</label>  
      <div class="col-sm-10">
        <input name="nominadaNorteCentro" type="text" class="form-control" id="nominadaNorteCentro" value="<?php echo $oItem->nominadaNorteCentro; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Nominada Sur</label>  
      <div class="col-sm-10">
        <input name="nominadaSur" type="text" class="form-control" id="nominadaSur" value="<?php echo $oItem->nominadaSur; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Convenio Norte Centro</label>  
      <div class="col-sm-10">
        <input name="convenioNorteCentro" type="text" class="form-control" id="convenioNorteCentro" value="<?php echo $oItem->convenioNorteCentro; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Convenio Sur</label>  
      <div class="col-sm-10">
        <input name="convenioSur" type="text" class="form-control" id="convenioSur" value="<?php echo $oItem->convenioSur; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Grupo Norte Centro</label>  
      <div class="col-sm-10">
        <input name="grupoNorteCentro" type="text" class="form-control" id="grupoNorteCentro" value="<?php echo $oItem->grupoNorteCentro; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Grupo Sur</label>  
      <div class="col-sm-10">
        <input name="grupoSur" type="text" class="form-control" id="grupoSur" value="<?php echo $oItem->grupoSur; ?>" maxlength="50">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Estado</label>
      <div class="col-sm-10">
        <label for="radio1">
          <input type="radio" class="flat-blue" id="radio1" name="state" value="1" <?php if($oItem->state==1) echo "checked";?>>
          
          Activo
        </label>
        <label for="radio2">
          <input type="radio" class="flat-blue" id="radio2" name="state" value="2" <?php if($oItem->state==2) echo "checked";?>>
          
          Bloqueado
        </label>
        
        <label for="radio3">
          <input type="radio" class="flat-blue" id="radio3" name="state" value="0" <?php if($oItem->state==0) echo "checked";?>>
          
          Inactivo
        </label>
        
      </div>
    </div>
  </div>
  <div class="box-footer">
    <input type="button" class="btn btn-primary" value="guardar" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);">
    <input type="button" class="btn btn-primary" name="btnCancel" value="cancelar" onClick="javascript:Back();">
  </div>
</div>