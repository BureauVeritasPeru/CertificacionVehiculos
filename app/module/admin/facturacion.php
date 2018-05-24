<?php
$oItem = new eCrmFacturacion();
$fecha = date('Y/m/d H:m:s');

$fechaIni	=OWASP::RequestString('fechaIni');
$fechaFin	=OWASP::RequestString('fechaFin');
$tallerID   =OWASP::RequestInt('tallerID');
/*$tipocertID =OWASP::RequestInt('tipocertID');*/

$oItem->facturacionID  	=$kID;
$oItem->fechaRegistro  	=$fecha;
$oItem->fechaInicio  	=$fechaIni;
$oItem->fechaFin  		=$fechaFin;
$oItem->tallerID		=$tallerID;

$oItem->tipoServicio		=OWASP::RequestArray('tipoServicio');
$oItem->tipoCertificadoID	=OWASP::RequestArray('tipoCertificadoID');
$oItem->certificadoID		=OWASP::RequestArray('certificadoID');
$oItem->fechaEmision		=OWASP::RequestArray('fechaEmision');
$oItem->placa   			=OWASP::RequestArray('placa');
$oItem->vin    				=OWASP::RequestArray('vin');
$oItem->motor      			=OWASP::RequestArray('motor');
$oItem->estado  			=OWASP::RequestArray('estado');
$oItem->costo  				=OWASP::RequestArray('costo');
//$oItem->facturacionDetID  =OWASP::RequestArray('facturacionDetID');

$MODULE->processFormAction(new CrmFacturacion(), $oItem);

if($MODULE->Command=="insert"){
	$tipoServicio = $oItem->tipoServicio;
	$tipoCertificadoID = $oItem->tipoCertificadoID;
	$certificadoID = $oItem->certificadoID;
	$fechaEmision = $oItem->fechaEmision;
	$placa 		  = $oItem->placa;
	$vin		  = $oItem->vin;
	$motor	 	  = $oItem->motor;
	$estado		  = $oItem->estado;
	$costo		  = $oItem->costo;	
    //$facturacionDetID         =$oItem->facturacionDetID;
    $costoTotal=0;
	for ($i=0; $i<count($fechaEmision); $i++){
        if ( ($fechaEmision[$i]!="") || ($placa[$i]!="") ) {
            $oFacturacionDet = new eCrmFacturacionDet();
            //$oFacturacionDet->facturacionDetID       =$facturacionDetID[$i];
            $oFacturacionDet->facturacionID =$oItem->facturacionID;
            $oFacturacionDet->tipoServicio  =$tipoServicio[$i];            
            $oFacturacionDet->tipoCertificadoID  =$tipoCertificadoID[$i];
            $oFacturacionDet->certificadoID  =$certificadoID[$i];
            $oFacturacionDet->fechaEmision  =$fechaEmision[$i];
            $oFacturacionDet->placa    		=$placa[$i];
            $oFacturacionDet->vin    		=$vin[$i];
            $oFacturacionDet->motor       	=$motor[$i];
            $oFacturacionDet->estado       	= ($estado[$i]!=1)?0:1;
            $oFacturacionDet->costo       	=$costo[$i];           
            $costoTotal += $costo[$i];
            CrmFacturacionDet::AddNew($oFacturacionDet);

            if($oFacturacionDet->tipoServicio == 70)
            	GlpCertificado::UpdateFact($oFacturacionDet->certificadoID);
            else if($oFacturacionDet->tipoServicio == 71)
				GnvCertificado::UpdateFact($oFacturacionDet->certificadoID);
        }
    }
    // CrmFacturacion:UpdateCosto($oItem->facturacionID,$costoTotal);
}

$DAO=$MODULE->StaticDAO;

$MODULE->FormTitle="Registro";
?>
