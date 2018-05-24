<?php
require_once("base/Database.php");

class CrmChata extends Database
{

	public static function  getItem($chataID){
		$query = "SELECT * FROM crm_chata 
		WHERE
		chataID='$chataID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemCHI($chiID){
		$query = "SELECT * FROM crm_chata 
		WHERE
		chiID='$chiID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getActa($acta){
		$query = "SELECT * FROM crm_chata 
		WHERE
		numeroActaDesembarque='$acta'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getActaxID($ID){
		$query = "SELECT * FROM crm_chata 
		WHERE
		ChiID='$ID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = "SELECT * FROM crm_chata
		ORDER BY nombrePlanta,puertoPlanta";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging( ){
		$query ="SELECT chataID,chiID,plantaID,nombrePlanta, puertoPlanta, zonaPlanta, numeroActaDesembarque, pescaDeclarada, cierrePuerto,inspectorID,nombreInspector,obsInusual,fechaRegistro
		FROM crm_chata";
		
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getWebList(){
		$query = "SELECT * FROM crm_chata
		ORDER BY nombrePlanta,puertoPlanta";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oChata){
		//Search the max Id
		$query = "SELECT MAX(chataID) FROM crm_chata";
		$result = parent::GetResult($query);
		$oChata->chataID = parent::fetchScalar($result)+1;


		$query2 = "SELECT MAX(chiID) FROM crm_chi";
		$result2 = parent::GetResult($query2);
		$oChata->chiID = parent::fetchScalar($result2);

		//Insert data to table
		$query = "INSERT INTO crm_chata(chataID,chiID,plantaID,nombrePlanta, puertoPlanta, zonaPlanta, numeroActaDesembarque, pescaDeclarada, cierrePuerto, inspectorID, nombreInspector, obsInusual,fechaRegistro,pregunta1,pregunta2,pregunta3,pregunta4,pregunta5)
		VALUES('$oChata->chataID', '$oChata->chiID', '$oChata->plantaID', '$oChata->nombrePlanta', '$oChata->puertoPlanta', '$oChata->zonaPlanta','$oChata->numeroActaDesembarque', '$oChata->pescaDeclarada', '$oChata->cierrePuerto', '$oChata->inspectorID', '$oChata->nombreInspector', '$oChata->obsInusual', NOW(),'$oChata->pregunta1','$oChata->pregunta2','$oChata->pregunta3','$oChata->pregunta4','$oChata->pregunta5')";
		return parent::Execute($query);
		//echo $query;
	}

	public static function  Update($oChata){
		//Update data to table
		$query = "UPDATE crm_chata SET 
		plantaID				 ='$oChata->plantaID',
		nombrePlanta			 ='$oChata->nombrePlanta',
		puertoPlanta			 ='$oChata->puertoPlanta',
		zonaPlanta				 ='$oChata->zonaPlanta',
		numeroActaDesembarque    ='$oChata->numeroActaDesembarque',
		pescaDeclarada			 ='$oChata->pescaDeclarada',
		cierrePuerto			 ='$oChata->cierrePuerto',
		inspectorID				 ='$oChata->inspectorID',
		obsInusual    			 ='$oChata->obsInusual',
		pregunta1    		     ='$oChata->pregunta1',
		pregunta2			     ='$oChata->pregunta2',
		pregunta3			     ='$oChata->pregunta3',
		pregunta4				 ='$oChata->pregunta4',
		pregunta5    			 ='$oChata->pregunta5'
		
		WHERE 
		chiID	=$oChata->chiID";
		return parent::Execute($query);
	}

	public static function  Delete($chataID){
		$query = "DELETE FROM crm_chata WHERE chataID='$chataID'";
		return parent::Execute($query);
	}

	public static function  getState($state){
		switch($state){
			case 1: 	return "Activo"; break;
			case 2: 	return "Bloqueado"; break;
			case 0: 	return "Inactivo"; break;
		}
		return "";
	}

}

?>