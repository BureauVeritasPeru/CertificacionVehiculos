<?php
require_once("base/Database.php");

class CrmManageImage extends Database
{

	public static function  getItem($photoID){
		$query = "SELECT * FROM crm_manage_image 
		WHERE
		photoID='$photoID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemFilter($precertID,$fotoID){
		$query = "SELECT * FROM crm_manage_image 
		WHERE
		precertID='$precertID'
		AND
		fotoID='$fotoID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getCountFilter($precertID,$fotoID){
		$query = "SELECT count(*) as archivo FROM crm_manage_image 
		WHERE
		precertID='$precertID'
		AND
		fotoID='$fotoID'";
		return parent::GetObject(parent::GetResult($query));
	}
	
	public static function  getList(){
		$query = "SELECT * FROM crm_manage_image
		ORDER BY photoID";
		//echo $query;
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getListFilter($precertID,$fotoID){
		$query = "SELECT * FROM crm_manage_image
		WHERE
		precertID=$precertID
		AND
		fotoID=$fotoID";
		//echo $query;
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oPhoto){
		//Search the max Id
		$query = "SELECT MAX(photoID) FROM crm_manage_image";
		$result = parent::GetResult($query);
		$oPhoto->photoID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO crm_manage_image(photoID,precertID,fotoID,archivo,fechaRegistro)
		VALUES('$oPhoto->photoID','$oPhoto->precertID','$oPhoto->fotoID','$oPhoto->archivo',NOW())";
		return parent::Execute($query);
	}


	public static function  Update($oPhoto){
		//Update data to table
		$query = "UPDATE crm_manage_image SET 
		archivo				=	'$oPhoto->archivo'
		WHERE 
		photoID	=$oPhoto->photoID";
		return parent::Execute($query);
		//echo $query;
	}

	public static function  Delete($oPhoto){
		$query = "DELETE FROM crm_manage_image WHERE photoID='$oPhoto'";
		return parent::Execute($query);
	}

	public static function  getRoute($fotoID){
		switch($fotoID){
			case '116' : return "foto/cilindro/"; break;
			case '118' : return "foto/conmutador/"; break;
			case '115' : return "foto/motor/"; break;
			case '117' : return "foto/tuberia/"; break;
		}
		return "";
	}

}

?>







