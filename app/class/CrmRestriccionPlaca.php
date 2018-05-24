<?php
require_once("base/Database.php");

class CrmRestriccionPlaca extends Database
{

	public static function  getItem($restriccionID){
		$query = "	SELECT *
    FROM crm_placa_restriccion
    WHERE restriccionID='$restriccionID' ";
    return parent::GetObject(parent::GetResult($query));
  }

  public static function  getItembyPlaca($placa){
    $query = "  SELECT *
    FROM crm_placa_restriccion
    WHERE placa='$placa' AND
    state = 1";
    return parent::GetObject(parent::GetResult($query));
  }

  public static function  getList(){
    $query = " 	SELECT *
    FROM crm_placa_restriccion
    ORDER BY restriccionID";
    return parent::GetCollection(parent::GetResult($query));
  }

  public static function  getList_Paging(){
    $query = "	
    SELECT *
    FROM crm_placa_restriccion";
    if(self::$orderBy=="") self::$orderBy="restriccionID";
      return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  AddNew($oRestriccion){
        //Search the max Id
      $query = " 	SELECT MAX(restriccionID) FROM crm_placa_restriccion";
      $result = parent::GetResult($query);
      $oRestriccion->restriccionID = parent::fetchScalar($result)+1;
        //Insert data to table
      $query = " 	INSERT INTO crm_placa_restriccion(restriccionID,placa,observaciones,state,registerDate)
      VALUES('$oRestriccion->restriccionID','$oRestriccion->placa','$oRestriccion->observaciones', '$oRestriccion->state',NOW())";
      return parent::Execute($query);
    }

    public static function  Update($oRestriccion){
    //Update data to table
      $query = " 	UPDATE crm_placa_restriccion SET 
      placa	='$oRestriccion->placa',
      observaciones ='$oRestriccion->observaciones',
      state = '$oRestriccion->state'
      WHERE restriccionID   =$oRestriccion->restriccionID
      AND estado = 1";
      return parent::Execute($query);
    }

    public static function  Delete($oRestriccion){
      $query = " 	DELETE FROM crm_placa_restriccion 
      WHERE restriccionID ='$oRestriccion->restriccionID'";
      return parent::Execute($query);
    }

    public static function  getState($state){
      switch($state){
        case 2:     return "Bloqueado"; break;
        case 1:     return "Activo"; break;
        case 0:     return "Anulado"; break;
      }
      return "";
    }
  }
  ?>