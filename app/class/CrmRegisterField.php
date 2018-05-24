<?php
require_once("base/Database.php");

class CrmRegisterField extends Database
{
	public static function  getItem($registerID, $fieldID){
		$query = "SELECT reg.registerID, reg.fieldID, reg.value, reg.textValue, fld.fieldName, fld.fieldType, fld.options
				FROM crm_register_field AS reg
				INNER JOIN crm_form_field AS fld
					ON reg.fieldID=fld.fieldID
				WHERE 
					reg.registerID='$registerID' AND reg.fieldID='$fieldID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList($registerID){
		$query ="SELECT reg.registerID, reg.fieldID, reg.value, reg.textValue, fld.fieldName, fld.fieldType, fld.options
				FROM crm_register_field AS reg
				INNER JOIN crm_form_field AS fld
					ON reg.fieldID=fld.fieldID
				WHERE 
					reg.registerID='$registerID'
				ORDER BY reg.registerID";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oRegField){
		//Insert data into the table
		$query = "insert into crm_register_field  (registerID, fieldID, value, textValue )
				  VALUES ('$oRegField->registerID', '$oRegField->fieldID', '$oRegField->value', '$oRegField->textValue')";

		return parent::Execute($query);
	}
	
	public static function getValue($obj, $formID=NULL){
		switch($obj->fieldType){
		case 1: return $obj->value;
			break;
		case 2: return $obj->textValue;
			break;
		case 3:
			$options=XMLParser::getArray($obj->options);
			return $options[$obj->value];
			break;
		case 4:
			$langID=1; //Espaniol por defecto (apply fix)
			$oParameter=CmsParameterLang::getItem($obj->value, $langID);
			return ($oParameter!=NULL)? $oParameter->parameterName: '';
			break;
		case 5:
			return '[ <a href="'.SEO::get_HTTPSite().'userfiles/form/'.$formID.'/'.$obj->value.'" target="_blank">Descargar</a> ]';
			break;
		}
	
	}
	
}

?>