<?php
require_once("base/Database.php");

class CrmManagePhoto extends Database
{

	public static function  getItem($photoID){
		$query = "SELECT * FROM crm_manage_photo 
		WHERE
		photoID='$photoID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemFilter($certificadoID,$documentoID){
		$query = "SELECT * FROM crm_manage_photo 
		WHERE
		certificadoID='$certificadoID'
		AND
		documentoID='$documentoID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getCountFilter($certificadoID,$documentoID){
		$query = "SELECT count(*) as archivo FROM crm_manage_photo 
		WHERE
		certificadoID='$certificadoID'
		AND
		documentoID='$documentoID'";
		return parent::GetObject(parent::GetResult($query));
	}
	
	public static function  getList(){
		$query = "SELECT * FROM crm_manage_photo
		ORDER BY photoID";
		//echo $query;
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getListFilter($certificadoID,$documentoID){
		$query = "SELECT * FROM crm_manage_photo
		WHERE
		certificadoID=$certificadoID
		AND
		documentoID=$documentoID";
		//echo $query;
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oPhoto){
		//Search the max Id
		$query = "SELECT MAX(photoID) FROM crm_manage_photo";
		$result = parent::GetResult($query);
		$oPhoto->photoID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO crm_manage_photo(photoID,certificadoID,documentoID,archivo,fechaRegistro)
		VALUES('$oPhoto->photoID','$oPhoto->certificadoID','$oPhoto->documentoID','$oPhoto->archivo',NOW())";
		return parent::Execute($query);
	}


	public static function  Update($oPhoto){
		//Update data to table
		$query = "UPDATE crm_manage_photo SET 
		archivo				=	'$oPhoto->archivo'
		WHERE 
		photoID	=$oPhoto->photoID";
		return parent::Execute($query);
		//echo $query;
	}

	public static function  Delete($oPhoto){
		$query = "DELETE FROM crm_manage_photo WHERE photoID='$oPhoto'";
		return parent::Execute($query);
	}

	public static function  getRoute($documentoID){
		switch($documentoID){
			case "42" : return "form/cargo_certificado/"; break;
			case "44" : return "form/certificado_reductor/"; break;
			case "43" : return "form/certificado_tanque/"; break;
			case "48" : return "form/checklist/"; break;
			case "41" : return "form/copia_soat_dni/"; break;
			case "40" : return "form/tarjeta_propiedad/"; break;
			case "45" : return "form/declaracion_jurada/"; break;
			case "46" : return "form/fotografias/"; break;
			case "47" : return "form/vouchers/"; break;
		}
		return "";
	}

}

?>







