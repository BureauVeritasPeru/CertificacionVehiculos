<?php
require_once("base/Database.php");

class GnvRestriccion extends Database
{

	public static function  getItem($restriccionID){
		$query = "	SELECT *
    FROM gnv_restriccion
    WHERE restriccionID='$restriccionID' ";
    return parent::GetObject(parent::GetResult($query));
  }

  public static function  getItembyCert($precertID){
    $query = "  SELECT *
    FROM gnv_restriccion
    WHERE precertID='$precertID' ";
    return parent::GetObject(parent::GetResult($query));
  }

  public static function  getList(){
    $query = " 	SELECT *
    FROM gnv_restriccion
    ORDER BY restriccionID";
    return parent::GetCollection(parent::GetResult($query));
  }

  public static function  getList_Paging(){
    $query = "	
    SELECT *
    FROM gnv_restriccion";
    if(self::$orderBy=="") self::$orderBy="restriccionID";
      return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  AddNew($oRestriccion){
        //Search the max Id
      $query = " 	SELECT MAX(restriccionID) FROM gnv_restriccion";
      $result = parent::GetResult($query);
      $oRestriccion->restriccionID = parent::fetchScalar($result)+1;
        //Insert data to table
      $query = " 	INSERT INTO gnv_restriccion(restriccionID, precertID, placaRest, observacionesRest, registerDate)
      VALUES('$oRestriccion->restriccionID','$oRestriccion->precertID','$oRestriccion->placaRest', '$oRestriccion->observacionesRest',NOW())";
      return parent::Execute($query);
    }

    public static function  Delete($oRestriccion){
      $query = " 	DELETE FROM gnv_restriccion 
      WHERE restriccionID ='$oRestriccion->restriccionID'
      AND estado = 1";
      return parent::Execute($query);
    }


  }
  ?>