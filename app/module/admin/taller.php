<?php
$oItem = new eCrmTaller();
$fecha = date('Y/m/d H:m:s');
$userAdmin  =AdmLogin::getUserSession();

$oItem->tallerID       =$kID;
$oItem->ruc            =OWASP::RequestString('ruc');
$oItem->razonSocial    =OWASP::RequestString('razonSocial');
$oItem->per            =OWASP::RequestString('per');
$oItem->costo          =OWASP::RequestString('costo');
$oItem->fechaCreacion  =$fecha;
$oItem->userID         =$userAdmin->userID;
$oItem->glpAut         =OWASP::RequestInt('glpAut');
$oItem->gnvAut         =OWASP::RequestInt('gnvAut');
$oItem->estado         =OWASP::RequestInt('estado');
$oItem->valid         =OWASP::RequestInt('valid');

$oItem->descripcion =OWASP::RequestArray('descripcion');
$oItem->direccion   =OWASP::RequestArray('direccion');
$oItem->telefono    =OWASP::RequestArray('telefono');
$oItem->ubigeo      =OWASP::RequestArray('ubigeo');
$oItem->estadoSede  =OWASP::RequestArray('estadoSede');
$oItem->sedeID      =OWASP::RequestArray('sedeID');

$oItem->nombreCompleto  =OWASP::RequestArray('nombreCompleto');
$oItem->direccionCont   =OWASP::RequestArray('direccionCont');
$oItem->telefonoCont    =OWASP::RequestArray('telefonoCont');
$oItem->estadoCont      =OWASP::RequestArray('estadoCont');
$oItem->contactoID      =OWASP::RequestArray('contactoID');

$oItem->tipoServicio        =OWASP::RequestArray('tipoServicio');
$oItem->tipoCertificado     =OWASP::RequestArray('tipoCertificado');
$oItem->costo               =OWASP::RequestArray('costo');
$oItem->precioID            =OWASP::RequestArray('precioID');

$MODULE->processFormAction(new CrmTaller(), $oItem);

if($MODULE->Command=="insert" || $MODULE->Command=="update" ){
    $descripcion    =$oItem->descripcion;
    $direccion      =$oItem->direccion;
    $telefono       =$oItem->telefono;
    $ubigeo         =$oItem->ubigeo;
    $estado         =$oItem->estadoSede;
    $sedeID         =$oItem->sedeID;

    $nombreCompleto    =$oItem->nombreCompleto;
    $direccionCont     =$oItem->direccionCont;
    $telefonoCont      =$oItem->telefonoCont;
    $estadoCont        =$oItem->estadoCont;
    $contactoID        =$oItem->contactoID;

    $tipoServicio       =$oItem->tipoServicio;
    $tipoCertificado    =$oItem->tipoCertificado;
    $costo              =$oItem->costo;
    $precioID           =$oItem->precioID;
    
    //CrmSede::DeleteByTaller($oItem->tallerID);
    
    for ($i=0; $i<count($descripcion); $i++){
        if ( ($descripcion[$i]!="") || ($direccion[$i]!="") ) {
            $oSede = new eCrmSede();
            $oSede->sedeID       =$sedeID[$i];
            $oSede->tallerID     =$oItem->tallerID;
            $oSede->descripcion  =$descripcion[$i];
            $oSede->direccion    =$direccion[$i];
            $oSede->telefono     =$telefono[$i];
            $oSede->ubigeo       =$ubigeo[$i];
            $oSede->estado       = ($estado[$i]!=1)?0:1;

            if($oSede->sedeID != null)
                CrmSede::Update($oSede);
            else
                CrmSede::AddNew($oSede);
        }
    }

    for ($i=0; $i<count($nombreCompleto); $i++){
        if ( ($nombreCompleto[$i]!="") || ($direccionCont[$i]!="") ) {
            $oContacto = new eCrmContacto();
            $oContacto->contactoID       =$contactoID[$i];
            $oContacto->tallerID         =$oItem->tallerID;
            $oContacto->nombreCompleto   =$nombreCompleto[$i];
            $oContacto->direccion        =$direccionCont[$i];
            $oContacto->telefono         =$telefonoCont[$i];
            $oContacto->estado           = ($estadoCont[$i]!=1)?0:1;

            if($oContacto->contactoID != null)
                CrmContacto::Update($oContacto);
            else
                CrmContacto::AddNew($oContacto);
        }
    }
    CrmPrecioTaller::DeleteByTaller($oItem->tallerID);
    for ($i=0; $i<count($tipoServicio); $i++){
        if ( ($tipoServicio[$i]!="") || ($tipoCertificado[$i]!="") ) {
            if($i != 0 || $costo[$i] != ''){
                $oPrecioTaller = new eCrmPrecioTaller();
                $oPrecioTaller->precioID            =$precioID[$i];
                $oPrecioTaller->tallerID            =$oItem->tallerID;
                $oPrecioTaller->tipoServicio        =$tipoServicio[$i];
                $oPrecioTaller->tipoCertificado     =$tipoCertificado[$i];
                $oPrecioTaller->costo               =$costo[$i];
                CrmPrecioTaller::AddNew($oPrecioTaller);
            }
        }
    }
}

if($MODULE->FormView=="edit"){
    $obj=CrmTaller::getItem($kID);
    if($obj!=null){
        if (empty($oItem->ruc)) 	        $oItem->ruc            =$obj->ruc;
        if (empty($oItem->razonSocial))     $oItem->razonSocial    =$obj->razonSocial;
        if (empty($oItem->per))             $oItem->per            =$obj->per;
        if (empty($oItem->costo))           $oItem->costo          =$obj->costo;
        if (empty($oItem->userID))          $oItem->userID         =$obj->userID;
        if (empty($oItem->fechaCreacion))   $oItem->fechaCreacion  =$obj->fechaCreacion;
        if (empty($oItem->glpAut))          $oItem->glpAut         =$obj->glpAut;
        if (empty($oItem->gnvAut))          $oItem->gnvAut         =$obj->gnvAut;
        if (empty($oItem->estado))          $oItem->estado         =$obj->estado;
        if (empty($oItem->valid))           $oItem->valid          =$obj->valid;
    }
    else
        $MODULE->addError(CrmTaller::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->razonSocial;
}

$MODULE->FormTitle="Taller";
?>
