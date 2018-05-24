<?php
require_once("base/Database.php");

class CrmSede extends Database
{

	public static function  getItem($sedeID){
		$query = "	SELECT *
					FROM crm_sede
					WHERE sedeID='$sedeID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = " 	SELECT *
					FROM crm_sede
				   	ORDER BY sedeID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query = "	SELECT *
					FROM crm_sede";
		if(self::$orderBy=="") self::$orderBy="sedeID";

		return parent::GetCollection(parent::GetResultPaging($query));
	}

    public static function  getListByTaller($tallerID, $orderBy=NULL){
        $query = "	SELECT *
            		FROM crm_sede
               		WHERE tallerID ='$tallerID'
            		ORDER BY
                	".(($orderBy!=NULL)? $orderBy: "sedeID")."";
        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getWebListByTaller($tallerID){
        $query = "  SELECT sedeID,descripcion
                    FROM crm_sede
                    WHERE tallerID ='$tallerID'
                    ORDER BY descripcion";
        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  AddNew($oSede){
        //Search the max Id
        $query = " 	SELECT MAX(sedeID) FROM crm_sede";
        $result = parent::GetResult($query);
        $oSede->sedeID = parent::fetchScalar($result)+1;
        //$oSede->varName    = $oSede->sedeID;
        //Insert data to table
        $query = " 	INSERT INTO crm_sede(sedeID, tallerID, descripcion, direccion, telefono, ubigeo, estado)
                	VALUES('$oSede->sedeID','$oSede->tallerID','$oSede->descripcion', '$oSede->direccion', '$oSede->telefono', '$oSede->ubigeo', '$oSede->estado')";
        return parent::Execute($query);
    }

    public static function  Update($oSede){
        //Update data to table
        $query = " 	UPDATE crm_sede SET 
                            descripcion	='$oSede->descripcion',
                            direccion   ='$oSede->direccion',
                            telefono    ='$oSede->telefono',
                            ubigeo      ='$oSede->ubigeo',
                            estado		='$oSede->estado'
                	WHERE sedeID   =$oSede->sedeID";
        return parent::Execute($query);
                    //echo $query;
    }

    public static function  Delete($oSede){
        $query = " 	DELETE FROM crm_sede 
                	WHERE sedeID ='$oSede->sedeID'";
        parent::Execute($query);
    }
    
    public static function  DeleteByTaller($tallerID){
        $query = " 	DELETE FROM crm_sede 
                	WHERE tallerID ='$tallerID'";
        parent::Execute($query);
    }
}
?>