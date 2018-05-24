<?php
$oItem = new eCrmEmbarcacion();

$oItem->embarcacionID	= $kID;
$oItem->numeralEmbarcacion	= OWASP::RequestString('numeralEmbarcacion');
$oItem->nombreEmbarcacion	= OWASP::RequestString('nombreEmbarcacion');
$oItem->matriculaEmbarcacion	= OWASP::RequestString('matriculaEmbarcacion');
$oItem->casco	= OWASP::RequestString('casco');
$oItem->regimen	= OWASP::RequestString('regimen');
$oItem->tipoPreservacion	= OWASP::RequestString('tipoPreservacion');
$oItem->eslora	= OWASP::RequestString('eslora');
$oItem->manga	= OWASP::RequestString('manga');
$oItem->puntal	= OWASP::RequestString('puntal');
$oItem->capbod_m3	= OWASP::RequestString('capbod_m3');
$oItem->capbod_tm	= OWASP::RequestString('capbod_tm');
$oItem->resolucion	= OWASP::RequestString('resolucion');
$oItem->permisoPesca	= OWASP::RequestString('permisoPesca');
$oItem->permisoZarpe	= OWASP::RequestString('permisoZarpe');
$oItem->codigoPago	= OWASP::RequestString('codigoPago');
$oItem->transmisor	= OWASP::RequestString('transmisor');
$oItem->armador	= OWASP::RequestString('armador');
$oItem->precinto	= OWASP::RequestString('precinto');
$oItem->aparejo	= OWASP::RequestString('aparejo');
$oItem->especieChi	= OWASP::RequestString('especieChi');
$oItem->especieChd	= OWASP::RequestString('especieChd');
$oItem->pmceNorteCentro	= OWASP::RequestString('pmceNorteCentro');
$oItem->pmceSur	= OWASP::RequestString('pmceSur');
$oItem->nominadaNorteCentro	= OWASP::RequestString('nominadaNorteCentro');
$oItem->nominadaSur	= OWASP::RequestString('nominadaSur');
$oItem->convenioNorteCentro	= OWASP::RequestString('convenioNorteCentro');
$oItem->convenioSur	= OWASP::RequestString('convenioSur');
$oItem->grupoNorteCentro	= OWASP::RequestString('grupoNorteCentro');
$oItem->grupoSur	= OWASP::RequestString('grupoSur');
$oItem->fechaRegistro	= OWASP::RequestString('fechaRegistro');
$oItem->fechaActualizacion	= OWASP::RequestString('fechaActualizacion');
$oItem->state	= OWASP::RequestString('state');

$MODULE->processFormAction(new CrmEmbarcacion(), $oItem);

if($MODULE->FormView=="edit"){
	$obj=CrmEmbarcacion::getItem($kID);
	if($obj!=null){
		if(empty($oItem->numeralEmbarcacion))  $oItem->numeralEmbarcacion  = $obj->numeralEmbarcacion;
		if(empty($oItem->nombreEmbarcacion))  $oItem->nombreEmbarcacion  = $obj->nombreEmbarcacion;
		if(empty($oItem->matriculaEmbarcacion))  $oItem->matriculaEmbarcacion  = $obj->matriculaEmbarcacion;
		if(empty($oItem->casco))  $oItem->casco  = $obj->casco;
		if(empty($oItem->regimen))  $oItem->regimen  = $obj->regimen;
		if(empty($oItem->tipoPreservacion))  $oItem->tipoPreservacion  = $obj->tipoPreservacion;
		if(empty($oItem->eslora))  $oItem->eslora  = $obj->eslora;
		if(empty($oItem->manga))  $oItem->manga  = $obj->manga;
		if(empty($oItem->puntal))  $oItem->puntal  = $obj->puntal;
		if(empty($oItem->capbod_m3))  $oItem->capbod_m3  = $obj->capbod_m3;
		if(empty($oItem->capbod_tm))  $oItem->capbod_tm  = $obj->capbod_tm;
		if(empty($oItem->resolucion))  $oItem->resolucion  = $obj->resolucion;
		if(empty($oItem->permisoPesca))  $oItem->permisoPesca  = $obj->permisoPesca;
		if(empty($oItem->permisoZarpe))  $oItem->permisoZarpe  = $obj->permisoZarpe;
		if(empty($oItem->codigoPago))  $oItem->codigoPago  = $obj->codigoPago;
		if(empty($oItem->transmisor))  $oItem->transmisor  = $obj->transmisor;
		if(empty($oItem->armador))  $oItem->armador  = $obj->armador;
		if(empty($oItem->precinto))  $oItem->precinto  = $obj->precinto;
		if(empty($oItem->aparejo))  $oItem->aparejo  = $obj->aparejo;
		if(empty($oItem->especieChi))  $oItem->especieChi  = $obj->especieChi;
		if(empty($oItem->especieChd))  $oItem->especieChd  = $obj->especieChd;
		if(empty($oItem->pmceNorteCentro))  $oItem->pmceNorteCentro  = $obj->pmceNorteCentro;
		if(empty($oItem->pmceSur))  $oItem->pmceSur  = $obj->pmceSur;
		if(empty($oItem->nominadaNorteCentro))  $oItem->nominadaNorteCentro  = $obj->nominadaNorteCentro;
		if(empty($oItem->nominadaSur))  $oItem->nominadaSur  = $obj->nominadaSur;
		if(empty($oItem->convenioNorteCentro))  $oItem->convenioNorteCentro  = $obj->convenioNorteCentro;
		if(empty($oItem->convenioSur))  $oItem->convenioSur  = $obj->convenioSur;
		if(empty($oItem->grupoNorteCentro))  $oItem->grupoNorteCentro  = $obj->grupoNorteCentro;
		if(empty($oItem->grupoSur))  $oItem->grupoSur  = $obj->grupoSur;
		if(empty($oItem->fechaRegistro))  $oItem->fechaRegistro  = $obj->fechaRegistro;
		if(empty($oItem->fechaActualizacion))  $oItem->fechaActualizacion  = $obj->fechaActualizacion;
		if(empty($oItem->state))  $oItem->state  = $obj->state;
	}
	else
		$MODULE->addError(CrmEmbarcacion::GetErrorMsg());

	$MODULE->ItemTitle=$oItem->nombreEmbarcacion;
}

$MODULE->FormTitle="Planta";
?>



