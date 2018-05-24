<?php
require_once("base/Database.php");

class CrmEmbarcacion extends Database
{

	public static function  getItem($embarcacionID){
		$query = "SELECT * FROM crm_embarcacion 
		WHERE
		embarcacionID='$embarcacionID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemCodigo($matriculaEmbarcacion){
		$query = "SELECT * FROM crm_embarcacion 
		WHERE
		matriculaEmbarcacion='$matriculaEmbarcacion'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemNumeral($numeral){
		$query = "SELECT * FROM crm_embarcacion 
		WHERE
		numeralEmbarcacion='$numeral'";
		return parent::GetObject(parent::GetResult($query));
	}
	public static function  getList(){
		$query = "SELECT * FROM crm_embarcacion
		ORDER BY numeralEmbarcacion, nombreEmbarcacion";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging($numeralEmbarcacion){
		$query ="SELECT embarcacionID, numeralEmbarcacion , nombreEmbarcacion, matriculaEmbarcacion, capbod_m3, state
		FROM crm_embarcacion
		WHERE 1=1";
		if ($numeralEmbarcacion!='')
			$query .= " AND numeralEmbarcacion = '$numeralEmbarcacion'";
		
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getWebList(){
		$query = "SELECT * FROM crm_embarcacion
		ORDER BY numeralEmbarcacion, nombreEmbarcacion";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oEmbarcacion){
		//Search the max Id
		$query = "SELECT MAX(embarcacionID) FROM crm_embarcacion";
		$result = parent::GetResult($query);
		$oEmbarcacion->embarcacionID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO crm_embarcacion(embarcacionID,numeralEmbarcacion,nombreEmbarcacion,matriculaEmbarcacion,casco,regimen,tipoPreservacion,eslora,manga,puntal,capbod_m3,capbod_tm,resolucion,permisoPesca,permisoZarpe,codigoPago,transmisor,armador,precinto,aparejo,especieChi,especieChd,pmceNorteCentro,pmceSur,nominadaNorteCentro,nominadaSur,convenioNorteCentro,convenioSur,grupoNorteCentro,grupoSur,fechaRegistro,fechaActualizacion,state)
		VALUES('$oEmbarcacion->embarcacionID','$oEmbarcacion->numeralEmbarcacion','$oEmbarcacion->nombreEmbarcacion','$oEmbarcacion->matriculaEmbarcacion','$oEmbarcacion->casco','$oEmbarcacion->regimen','$oEmbarcacion->tipoPreservacion','$oEmbarcacion->eslora','$oEmbarcacion->manga','$oEmbarcacion->puntal','$oEmbarcacion->capbod_m3','$oEmbarcacion->capbod_tm','$oEmbarcacion->resolucion','$oEmbarcacion->permisoPesca','$oEmbarcacion->permisoZarpe','$oEmbarcacion->codigoPago','$oEmbarcacion->transmisor','$oEmbarcacion->armador','$oEmbarcacion->precinto','$oEmbarcacion->aparejo','$oEmbarcacion->especieChi','$oEmbarcacion->especieChd','$oEmbarcacion->pmceNorteCentro','$oEmbarcacion->pmceSur','$oEmbarcacion->nominadaNorteCentro','$oEmbarcacion->nominadaSur','$oEmbarcacion->convenioNorteCentro','$oEmbarcacion->convenioSur','$oEmbarcacion->grupoNorteCentro','$oEmbarcacion->grupoSur',NOW(),NOW(),'$oEmbarcacion->state')";
		return parent::Execute($query);
	}

	public static function  Update($oEmbarcacion){
		//Update data to table
		$query = "UPDATE crm_embarcacion SET 
		numeralEmbarcacion  = '$oEmbarcacion->numeralEmbarcacion',
		nombreEmbarcacion  = '$oEmbarcacion->nombreEmbarcacion',
		matriculaEmbarcacion  = '$oEmbarcacion->matriculaEmbarcacion',
		casco  = '$oEmbarcacion->casco',
		regimen  = '$oEmbarcacion->regimen',
		tipoPreservacion  = '$oEmbarcacion->tipoPreservacion',
		eslora  = '$oEmbarcacion->eslora',
		manga  = '$oEmbarcacion->manga',
		puntal  = '$oEmbarcacion->puntal',
		capbod_m3  = '$oEmbarcacion->capbod_m3',
		capbod_tm  = '$oEmbarcacion->capbod_tm',
		resolucion  = '$oEmbarcacion->resolucion',
		permisoPesca  = '$oEmbarcacion->permisoPesca',
		permisoZarpe  = '$oEmbarcacion->permisoZarpe',
		codigoPago  = '$oEmbarcacion->codigoPago',
		transmisor  = '$oEmbarcacion->transmisor',
		armador  = '$oEmbarcacion->armador',
		precinto  = '$oEmbarcacion->precinto',
		aparejo  = '$oEmbarcacion->aparejo',
		especieChi  = '$oEmbarcacion->especieChi',
		especieChd  = '$oEmbarcacion->especieChd',
		pmceNorteCentro  = '$oEmbarcacion->pmceNorteCentro',
		pmceSur  = '$oEmbarcacion->pmceSur',
		nominadaNorteCentro  = '$oEmbarcacion->nominadaNorteCentro',
		nominadaSur  = '$oEmbarcacion->nominadaSur',
		convenioNorteCentro  = '$oEmbarcacion->convenioNorteCentro',
		convenioSur  = '$oEmbarcacion->convenioSur',
		grupoNorteCentro  = '$oEmbarcacion->grupoNorteCentro',
		grupoSur  = '$oEmbarcacion->grupoSur',
		fechaActualizacion  = NOW(),
		state  = '$oEmbarcacion->state'
		WHERE 
		embarcacionID	=$oEmbarcacion->embarcacionID";
		return parent::Execute($query);
	}

	public static function  Delete($oEmbarcacion){
		$query = "DELETE FROM crm_embarcacion WHERE embarcacionID='$oEmbarcacion->embarcacionID'";
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


		