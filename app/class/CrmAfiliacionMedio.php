<?php
require_once("base/Database.php");

class CrmAfiliacionMedio extends Database
{

    public static function  getItem($afiliadoID){
        $query = "SELECT * FROM crm_afiliacion_medio 
        WHERE afiliadoID='$afiliadoID'";
        
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getItemRUC($ruc){
        $query = "SELECT * FROM crm_afiliacion_medio 
        WHERE ruc='$ruc'";
        
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList_Paging($criterio, $fechaIni, $fechaFin, $estado){
        $criterio=str_replace("", "%", $criterio);
        $fIni=date("Y-m-d", $fechaIni)." 00:00:00";
        $fFin=date("Y-m-d", $fechaFin)." 23:59:59";
        
        $query = "SELECT * FROM crm_afiliacion_medio
            WHERE
                NombreAdministracion LIKE '%$criterio%' AND
                (fechaRegistro>='$fIni' AND fechaFin<='$fFin') AND
            estado='$estado'
            ORDER BY afiliadoID";
        
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getWebList(){
        $query = "SELECT * FROM crm_afiliacion_medio
            ORDER BY afiliadoID";
        
        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  addNew($oAfiliaMedio){
        $oAfiliaMedio->afiliadoID = CrmAfiliacion::generateNewID(); //Generate new ID
        //Insert data to table
        $query = "INSERT INTO crm_afiliacion_medio(afiliadoID, IdProducto, Ruc, CuentaBancaria, IdTipoCuentaBancaria, IdEntidadBancaria, TipoConexion, NombreAdministracion, IdGiroNegocio, GiroNegocio, UbigeoA, TelefonoA, TipoViaA, DireccionA, MismaDireccion, UbigeoC, TelefonoC, TipoViaC, DireccionC, NombreRepLegal, ApellidosRepLegal, TipoDocRepLegal, NumeroDocRepLegal, SexoRepLegal, TelefonoRepLegal, MovilRepLegal, EmailRepLegal, MismoContacto, NombreContacto, ApellidosContacto, TipoDocContacto, NumeroDocContacto, SexoContacto, TelefonoContacto, MovilContacto, EmailContacto)
                VALUES('$oAfiliaMedio->afiliadoID', '$oAfiliaMedio->IdProducto', '$oAfiliaMedio->Ruc', '$oAfiliaMedio->CuentaBancaria', '$oAfiliaMedio->IdTipoCuentaBancaria', '$oAfiliaMedio->IdEntidadBancaria', '$oAfiliaMedio->TipoConexion', '$oAfiliaMedio->NombreAdministracion', '$oAfiliaMedio->IdGiroNegocio', '$oAfiliaMedio->GiroNegocio', '$oAfiliaMedio->UbigeoA', '$oAfiliaMedio->TelefonoA', '$oAfiliaMedio->TipoViaA', '$oAfiliaMedio->DireccionA', '$oAfiliaMedio->MismaDireccion', '$oAfiliaMedio->UbigeoC', '$oAfiliaMedio->TelefonoC', '$oAfiliaMedio->TipoViaC', '$oAfiliaMedio->DireccionC', '$oAfiliaMedio->NombreRepLegal', '$oAfiliaMedio->ApellidosRepLegal', '$oAfiliaMedio->TipoDocRepLegal', '$oAfiliaMedio->NumeroDocRepLegal', '$oAfiliaMedio->SexoRepLegal', '$oAfiliaMedio->TelefonoRepLegal', '$oAfiliaMedio->MovilRepLegal', '$oAfiliaMedio->EmailRepLegal', '$oAfiliaMedio->MismoContacto', '$oAfiliaMedio->NombreContacto', '$oAfiliaMedio->ApellidosContacto', '$oAfiliaMedio->TipoDocContacto', '$oAfiliaMedio->NumeroDocContacto', '$oAfiliaMedio->SexoContacto', '$oAfiliaMedio->TelefonoContacto', '$oAfiliaMedio->MovilContacto', '$oAfiliaMedio->EmailContacto')";
        //echo $query; exit;
        return parent::Execute($query);
    }

    public static function  Delete($oAfiliaMedio){
        //Update data to table
        $query = "DELETE crm_afiliacion_medio
            WHERE 
                afiliadoID='$oAfiliaMedio->afiliadoID'";

        if(!parent::Execute($query))
            return false;
        else
            return CrmAfiliacion::Delete(new eCrmAfiliacion($oAfiliaMedio->afiliadoID));
    }

}

?>