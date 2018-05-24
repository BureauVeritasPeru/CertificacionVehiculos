<?php
require_once("base/Database.php");

class CrmContacto extends Database
{

	public static function  getItem($contactoID){
		$query = "	SELECT *
					FROM crm_contacto
					WHERE contactoID='$contactoID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = " 	SELECT *
					FROM crm_contacto
				   	ORDER BY contactoID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query = "	SELECT *
					FROM crm_contacto";
		if(self::$orderBy=="") self::$orderBy="contactoID";

		return parent::GetCollection(parent::GetResultPaging($query));
	}

    public static function  getListByTaller($tallerID, $orderBy=NULL){
        $query = "	SELECT *
            		FROM crm_contacto
               		WHERE tallerID ='$tallerID'
            		ORDER BY
                	".(($orderBy!=NULL)? $orderBy: "contactoID")."";
        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  AddNew($oContacto){
        //Search the max Id
        $query = " 	SELECT MAX(contactoID) FROM crm_contacto";
        $result = parent::GetResult($query);
        $oContacto->contactoID = parent::fetchScalar($result)+1;
        //$oContacto->varName    = $oContacto->contactoID;
        //Insert data to table
        $query = " 	INSERT INTO crm_contacto(contactoID, tallerID, nombreCompleto, direccion, telefono, estado)
                	VALUES('$oContacto->contactoID','$oContacto->tallerID','$oContacto->nombreCompleto', '$oContacto->direccion', '$oContacto->telefono', '$oContacto->estado')";
        return parent::Execute($query);
    }

    public static function  Update($oContacto){
        //Update data to table
        $query = " 	UPDATE crm_contacto SET 
                            nombreCompleto	='$oContacto->nombreCompleto',
                            direccion   ='$oContacto->direccion',
                            telefono    ='$oContacto->telefono',
                            estado		='$oContacto->estado'
                	WHERE contactoID   =$oContacto->contactoID";
        return parent::Execute($query);
                    //echo $query;
    }

    public static function  Delete($oContacto){
        $query = " 	DELETE FROM crm_contacto 
                	WHERE contactoID ='$oContacto->contactoID'";
        parent::Execute($query);
    }
    
    public static function  DeleteByTaller($tallerID){
        $query = " 	DELETE FROM crm_contacto 
                	WHERE tallerID ='$tallerID'";
        parent::Execute($query);
    }
}
?>