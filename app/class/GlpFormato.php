<?php
require_once("base/Database.php");

class GlpFormato extends Database
{

	public static function  getItem($formatoID){
		$query = "	SELECT *
    FROM glp_formato
    WHERE formatoID='$formatoID' ";
    return parent::GetObject(parent::GetResult($query));
  }

  public static function  getList(){
    $query = " 	SELECT *
    FROM glp_formato
    ORDER BY formatoID";
    return parent::GetCollection(parent::GetResult($query));
  }

  public static function  getList_Paging(){
    $query = "	
    SELECT f.formatoID, f.userID, CONCAT(a.firstName,' ',a.lastName) AS nombreCompleto, f.userAdmID, CONCAT(ad.firstName,' ',ad.lastName) AS nombreCompletoAdm, f.fechaCreacion, f.estado 
    FROM glp_formato f INNER JOIN crm_user a
    ON f.userID = a.userID INNER JOIN adm_user ad
    ON f.userAdmID = ad.userID";
    if(self::$orderBy=="") self::$orderBy="formatoID";
      return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  AddNew($oFormato){
        //Search the max Id
        //$query = " 	SELECT MAX(formatoID) FROM glp_formato";
        //$result = parent::GetResult($query);
        //$oFormato->formatoID = parent::fetchScalar($result)+1;
        //$oFormato->varName    = $oFormato->formatoID;
        //Insert data to table
      $query = " 	INSERT INTO glp_formato(formatoID, userID, userAdmID, fechaCreacion, estado)
      VALUES('$oFormato->formatoID','$oFormato->userID','$oFormato->userAdmID', '$oFormato->fechaCreacion', '$oFormato->estado')";
      return parent::Execute($query);
    }

    public static function  Update($oFormato){
    //Update data to table
      $query = " 	UPDATE glp_formato SET 
      userID	='$oFormato->userID',
      userAdmID ='$oFormato->userAdmID'
      WHERE formatoID   =$oFormato->formatoID
      AND estado = 1";
      return parent::Execute($query);
    }

    public static function  UpdateState2($formatoID){
    //Update data to table
      $query = "  UPDATE glp_formato SET 
      estado =2
      WHERE formatoID   =$formatoID";
      return parent::Execute($query);
    //echo $query;
    }

    public static function  UpdateState1($formatoID){
    //Update data to table
      $query = "  UPDATE glp_formato SET 
      estado =1
      WHERE formatoID   =$formatoID";
      return parent::Execute($query);
    //echo $query;
    }

    public static function  UpdateState0($formatoID){
    //Update data to table
      $query = "  UPDATE glp_formato SET 
      estado =0
      WHERE formatoID   =$formatoID";
      return parent::Execute($query);
    //echo $query;
    }

    public static function  Delete($oFormato){
      $query = " 	DELETE FROM glp_formato 
      WHERE formatoID ='$oFormato->formatoID'
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