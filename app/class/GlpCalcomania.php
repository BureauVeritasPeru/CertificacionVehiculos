<?php
require_once("base/Database.php");

class GlpCalcomania extends Database
{

	public static function  getItem($calcomaniaID){
		$query = "	SELECT *
					FROM glp_calcomania
					WHERE calcomaniaID='$calcomaniaID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = " 	SELECT *
					FROM glp_calcomania
				   	ORDER BY calcomaniaID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query = "	
                    SELECT f.calcomaniaID, f.userID, CONCAT(a.firstName,' ',a.lastName) AS nombreCompleto, f.userAdmID, CONCAT(ad.firstName,' ',ad.lastName) AS nombreCompletoAdm, f.fechaCreacion, f.estado 
                    FROM glp_calcomania f INNER JOIN crm_user a
                    ON f.userID = a.userID INNER JOIN adm_user ad
                    ON f.userAdmID = ad.userID";
		if(self::$orderBy=="") self::$orderBy="calcomaniaID";
		return parent::GetCollection(parent::GetResultPaging($query));
	}

    public static function  AddNew($oCalcomania){
        //Search the max Id
        //$query = " 	SELECT MAX(calcomaniaID) FROM glp_calcomania";
        //$result = parent::GetResult($query);
        //$oCalcomania->calcomaniaID = parent::fetchScalar($result)+1;
        //$oCalcomania->varName    = $oCalcomania->calcomaniaID;
        //Insert data to table
        $query = " 	INSERT INTO glp_calcomania(calcomaniaID, userID, userAdmID, fechaCreacion, estado)
                	VALUES('$oCalcomania->calcomaniaID','$oCalcomania->userID','$oCalcomania->userAdmID', '$oCalcomania->fechaCreacion', '$oCalcomania->estado')";
        return parent::Execute($query);
    }

    public static function  Update($oCalcomania){
        //Update data to table
        $query = " 	UPDATE glp_calcomania SET 
                            userID	='$oCalcomania->userID',
                            userAdmID ='$oCalcomania->userAdmID'
                	WHERE calcomaniaID   =$oCalcomania->calcomaniaID
                    AND estado = 1";
        return parent::Execute($query);
                    //echo $query;
    }

    public static function  UpdateState2($calcomaniaID){
    //Update data to table
    $query = "  UPDATE glp_calcomania SET 
                        estado =2
              WHERE calcomaniaID   =$calcomaniaID";
    return parent::Execute($query);
    //echo $query;
    }

    public static function  UpdateState1($calcomaniaID){
    //Update data to table
    $query = "  UPDATE glp_calcomania SET 
                        estado =1
              WHERE calcomaniaID   =$calcomaniaID";
    return parent::Execute($query);
    //echo $query;
    }

    public static function  Delete($oCalcomania){
        $query = " 	DELETE FROM glp_calcomania 
                	WHERE calcomaniaID ='$oCalcomania->calcomaniaID'
                    AND estado = 1";
        return parent::Execute($query);
    }

    public static function  getState($state){
        switch($state){
            case 2:     return "Usado"; break;
            case 1:     return "Activo"; break;
            case 0:     return "Anulado"; break;
        }
        return "";
    }
}
?>