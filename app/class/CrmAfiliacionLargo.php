<?php
require_once("base/Database.php");

class CrmAfiliacionLargo extends Database
{

    public static function  getItem($afiliacionID){
        $query = "SELECT * FROM crm_afiliacion_largo 
        WHERE afiliacionID='$afiliacionID'";
        
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getItemRUC($ruc){
        $query = "SELECT * FROM crm_afiliacion_largo 
        WHERE ruc='$ruc'";
        
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList_Paging($criterio, $fechaIni, $fechaFin, $estado){
        $criterio=str_replace("", "%", $criterio);
        $fIni=date("Y-m-d", $fechaIni)." 00:00:00";
        $fFin=date("Y-m-d", $fechaFin)." 23:59:59";

        $query = "SELECT * FROM crm_afiliacion_largo
            WHERE
                nombreComercial LIKE '%$criterio%' AND
                (fechaRegistro>='$fIni' AND fechaFin<='$fFin') AND
                estado='$estado'
            ORDER BY afiliadoID";
        
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getWebList(){
        $query = "SELECT * FROM crm_afiliacion_largo
        ORDER BY afiliadoID";
        
        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  addNew($oAfiliaLargo){
        $oAfiliaLargo->afiliadoID = CrmAfiliacion::generateNewID(); //Generate new ID
        //Insert data to table
        $query = "INSERT INTO crm_afiliacion_largo(`afiliadoID`, `ruc`, `solicitud`, `codigo`, `producto`, `periodo`, `fechaInicio`, `fechaFin`, `razonSocial`, `nombreComercial`, `telefonoComercial`, `direccionComercial`, `ubigeoComercial`, `giroNegocioID`, `giroNegocioNombre`, `moneda`, `promedioVentas`, `cantidadVentas`, `tieneLineaTelf`, `tipoLineaTelf`, `numeroLineaTelf`, `proveedorLineaTelf`, `direccionIP`, `cuentaBancaria`, `tipoCuenta`, `entidadBancaria`, `rlegalNombres`, `rlegalApellidos`, `rlegalTipoDocumento`, `rlegalNroDocumento`, `rlegalFechaNacimiento`, `rlegalSexo`, `rlegalTelefono`, `rlegalCelular`, `emailComercio`, `horarioAtencion`, `deseaCalveWeb`, `esContactoRLegal`, `contacto1Nombres`, `contacto1Apellidos`, `contacto1Cargo`, `contacto1Telefono1`, `contacto1Telefono2`, `contacto1Email`, `contacto2Nombres`, `contacto2Apellidos`, `contacto2Cargo`, `contacto2Telefono1`, `contacto2Telefono2`, `contacto2Email`)
                VALUES('$oAfiliaLargo->afiliadoID', '$oAfiliaLargo->ruc', '$oAfiliaLargo->solicitud', '$oAfiliaLargo->codigo', '$oAfiliaLargo->producto', '$oAfiliaLargo->periodo', '$oAfiliaLargo->fechaInicio', '$oAfiliaLargo->fechaFin', '$oAfiliaLargo->razonSocial', '$oAfiliaLargo->nombreComercial', '$oAfiliaLargo->telefonoComercial', '$oAfiliaLargo->direccionComercial', '$oAfiliaLargo->ubigeoComercial', '$oAfiliaLargo->giroNegocioID', '$oAfiliaLargo->giroNegocioNombre', '$oAfiliaLargo->moneda', '$oAfiliaLargo->promedioVentas', '$oAfiliaLargo->cantidadVentas', '$oAfiliaLargo->tieneLineaTelf', '$oAfiliaLargo->tipoLineaTelf', '$oAfiliaLargo->numeroLineaTelf', '$oAfiliaLargo->proveedorLineaTelf', '$oAfiliaLargo->direccionIP', '$oAfiliaLargo->cuentaBancaria', '$oAfiliaLargo->tipoCuenta', '$oAfiliaLargo->entidadBancaria', '$oAfiliaLargo->rlegalNombres', '$oAfiliaLargo->rlegalApellidos', '$oAfiliaLargo->rlegalTipoDocumento', '$oAfiliaLargo->rlegalNroDocumento', '$oAfiliaLargo->rlegalFechaNacimiento', '$oAfiliaLargo->rlegalSexo', '$oAfiliaLargo->rlegalTelefono', '$oAfiliaLargo->rlegalCelular', '$oAfiliaLargo->emailComercio', '$oAfiliaLargo->horarioAtencion', '$oAfiliaLargo->deseaCalveWeb', '$oAfiliaLargo->esContactoRLegal', '$oAfiliaLargo->contacto1Nombres', '$oAfiliaLargo->contacto1Apellidos', '$oAfiliaLargo->contacto1Cargo', '$oAfiliaLargo->contacto1Telefono1', '$oAfiliaLargo->contacto1Telefono2', '$oAfiliaLargo->contacto1Email', '$oAfiliaLargo->contacto2Nombres', '$oAfiliaLargo->contacto2Apellidos', '$oAfiliaLargo->contacto2Cargo', '$oAfiliaLargo->contacto2Telefono1', '$oAfiliaLargo->contacto2Telefono2', '$oAfiliaLargo->contacto2Email')";

        return parent::Execute($query);
    }

    public static function  Delete($oAfiliaLargo){
        //Update data to table
        $query = "DELETE crm_afiliacion_largo
            WHERE 
                afiliadoID='$oAfiliaLargo->afiliadoID'";

        if(!parent::Execute($query))
            return false;
        else
            return CrmAfiliacion::Delete(new eCrmAfiliacion($oAfiliaLargo->afiliadoID));
    }

}
?>