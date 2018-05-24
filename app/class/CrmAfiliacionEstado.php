<?php
require_once("base/Database.php");

class CrmAfiliacionEstado extends Database
{

    public static function  getItem($afiliadoID, $fecha){
        $query = "SELECT * FROM crm_afiliacion_estado
        WHERE afiliadoID='$afiliadoID' AND fecha='$fecha'";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getWebList($afiliadoID){
        $query = "SELECT * FROM crm_afiliacion_estado
        WHERE afiliadoID='$afiliadoID'
        ORDER BY configID";
        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getItem_Ultimo($afiliadoID){
        $query = "SELECT * FROM crm_afiliacion_estado
        WHERE afiliadoID='$afiliadoID'
            ORDER BY fecha DESC
            LIMIT 0, 1";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  addNew($oAfiliacionEstado){
        //Insert data to table
        $query = "INSERT INTO crm_afiliacion_estado(`afiliadoID`,   `fecha`,  `codigoAfiliado`,  `estadoID`,  `descripcionEstado`,  `usuarioID`,  `descripcionUsuario`,  `estacion`)
                VALUES('$oAfiliacionEstado->afiliadoID', '$oAfiliacionEstado->fecha', '$oAfiliacionEstado->codigoAfiliado', '$oAfiliacionEstado->estadoID', '$oAfiliacionEstado->descripcionEstado', '$oAfiliacionEstado->usuarioID', '$oAfiliacionEstado->descripcionUsuario', '$oAfiliacionEstado->estacion')";
        //echo $query;
        //exit;
        return parent::Execute($query);
    }

    public static function  Update($oAfiliacionEstado, $fecha){
        //Update data to table
        $query = "UPDATE crm_afiliacion_estado SET
            `codigoAfiliado`    ='$oAfiliacionEstado->codigoAfiliado',
            `estadoID`          ='$oAfiliacionEstado->estadoID',
            `descripcionEstado` ='$oAfiliacionEstado->descripcionEstado',
            `usuarioID`         ='$oAfiliacionEstado->usuarioID',
            `descripcionUsuario`='$oAfiliacionEstado->descripcionUsuario',
            `estacion`          ='$oAfiliacionEstado->estacion'
                        WHERE 
                                afiliadoID='$oAfiliacionEstado->afiliadoID' AND
            fecha='$oAfiliacionEstado->fecha'
                                ";
        return parent::Execute($query);
    }

    public static function  Delete($oAfiliacionEstado){
        //Update data to table
        $query = "DELETE crm_afiliacion_estado
        WHERE 
            afiliadoID='$oAfiliacionEstado->afiliadoID' AND
            fecha='$oAfiliacionEstado->fecha'
            ";
        return parent::Execute($query);
    }

}

?>