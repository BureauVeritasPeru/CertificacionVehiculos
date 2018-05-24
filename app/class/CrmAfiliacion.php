<?php
require_once("base/Database.php");

class CrmAfiliacion extends Database
{

    public static function  getItem($afiliacionID){
        $query = "SELECT * FROM crm_afiliacion 
        WHERE afiliacionID='$afiliacionID'";
        
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  addNew($oAfiliacion){
        global $WEBSITE;
        //Search the max Id
        $query = "SELECT MAX(afiliadoID) FROM crm_afiliacion";
        $result = parent::GetResult($query);
        $oAfiliacion->afiliadoID = parent::fetchScalar($result);
        $oAfiliacion->afiliadoID = ($oAfiliacion->afiliadoID==0) ? $WEBSITE["AFILIADO_INIT"]+1 : $oAfiliacion->afiliadoID+1;
            
        //Insert data to table
        $query = "INSERT INTO crm_afiliacion(`afiliadoID`, `fechaRegistro`, `estado`)
                VALUES('$oAfiliacion->afiliadoID', NOW(), '$oAfiliacion->estado')";

        return parent::Execute($query);
    }

    public static function  generateNewID(){
        $oAfiliacion=new eCrmAfiliacion();
        if(!CrmAfiliacion::addNew($oAfiliacion))
            return NULL;
        else
            return $oAfiliacion->afiliadoID;
    }

    public static function  Update($oAfiliacion){
        //Update data to table
        $query = "UPDATE crm_afiliacion SET 
                estado ='$oAfiliacion->estado'
            WHERE 
                afiliadoID='$oAfiliacion->afiliadoID'";

        return parent::Execute($query);
    }

    public static function  Delete($oAfiliacion){
        //Update data to table
        $query = "DELETE crm_afiliacion
            WHERE 
                afiliadoID='$oAfiliacion->afiliadoID'";

        return parent::Execute($query);
    }

}
?>