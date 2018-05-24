<?php
require_once("base/Database.php");

class CmsParameterLang extends Database
{

	public static function  getItem($parameterID, $langID){
		$query = "SELECT param.parameterID, param.groupID, plan.langID, IF(plan.parameterName IS null, param.alias, plan.parameterName) AS parameterName, param.position, plan.description, plan.attribute, plan.active, IF(plan.parameterID IS null, 1, 0) AS nullValue
		FROM cms_parameter AS param
		LEFT JOIN cms_parameter_lang AS plan
			ON plan.parameterID=param.parameterID
			AND IFNULL(plan.langID, 0) = '$langID'
		WHERE param.parameterID='$parameterID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList($groupID, $langID){
		$query = "SELECT param.parameterID, param.groupID, plan.langID, IF(plan.parameterName IS null, param.alias, plan.parameterName) AS parameterName, param.position, plan.description, plan.attribute, plan.active, IF(plan.parameterID IS null, 1, 0) AS nullValue
		FROM cms_parameter AS param
		LEFT JOIN cms_parameter_lang AS plan
			ON plan.parameterID=param.parameterID
			AND IFNULL(plan.langID, 0) = '$langID'
		WHERE param.groupID='$groupID'
		ORDER BY param.alias";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging($groupID, $langID){
		$query = "SELECT param.parameterID, param.groupID, plan.langID, IF(plan.parameterName IS null, param.alias, plan.parameterName) AS parameterName, param.position, plan.description, plan.attribute, plan.active, IF(plan.parameterID IS null, 1, 0) AS nullValue
		FROM cms_parameter AS param
		LEFT JOIN cms_parameter_lang AS plan
			ON plan.parameterID=param.parameterID
			AND IFNULL(plan.langID, 0) = '$langID'
		WHERE param.groupID='$groupID'
		";
		if(self::$orderBy=="") self::$orderBy="param.alias ASC";
		
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getListParent_Paging($groupID, $parentParameterID, $langID){
		$query = "SELECT param.parameterID, param.groupID, plan.langID, IF(plan.parameterName IS null, param.alias, plan.parameterName) AS parameterName, param.position, plan.description, plan.attribute, plan.active, IF(plan.parameterID IS null, 1, 0) AS nullValue
		FROM cms_parameter AS param
		LEFT JOIN cms_parameter_lang AS plan
			ON plan.parameterID=param.parameterID
			AND IFNULL(plan.langID, 0) = '$langID'
		WHERE param.groupID='$groupID' AND parentParameterID='$parentParameterID'
		";
		if(self::$orderBy=="") self::$orderBy="param.alias ASC";
		
		return parent::GetCollection(parent::GetResultPaging($query));
	}
	
	public static function  getWebList($groupID, $langID){
		$query = "SELECT param.parameterID, param.groupID, plan.langID, IF(plan.parameterName IS null, param.alias, plan.parameterName) AS parameterName, param.position, plan.description, plan.attribute, plan.active, IF(plan.parameterID IS null, 1, 0) AS nullValue
		FROM cms_parameter AS param
		LEFT JOIN cms_parameter_lang AS plan
			ON plan.parameterID=param.parameterID
			AND IFNULL(plan.langID, 0) = '$langID'
		WHERE param.groupID='$groupID' AND active='1'
		ORDER BY plan.parameterName";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getWebListParent($groupID, $parentParameterID, $langID){
		$query = "SELECT param.parameterID, param.groupID, plan.langID, IF(plan.parameterName IS null, param.alias, plan.parameterName) AS parameterName, param.position, plan.description, plan.attribute, plan.active, IF(plan.parameterID IS null, 1, 0) AS nullValue
		FROM cms_parameter AS param
		LEFT JOIN cms_parameter_lang AS plan
			ON plan.parameterID=param.parameterID
			AND IFNULL(plan.langID, 0) = '$langID'
		WHERE param.groupID='$groupID' AND parentParameterID='$parentParameterID' AND active='1'
		";
		if(self::$orderBy=="") self::$orderBy="plan.parameterName ASC";
		
		return parent::GetCollection(parent::GetResultPaging($query));
	}
	
	public static function  AddNew($oParameterLang){
		$oParameter=new eCmsParameter(0, $oParameterLang->parentParameterID, $oParameterLang->groupID, $oParameterLang->parameterName, 0);
		if(CmsParameter::AddNew($oParameter)){
			$oParameterLang->parameterID=$oParameter->parameterID;
			return self::AddNew_ParameterLang($oParameterLang);
		}
		
		return false;
	}
	
	public static function  Update($oParameterLang){
		//Validate if exists
		$query = "
			SELECT COUNT(*) FROM cms_parameter_lang
			WHERE parameterID = '$oParameterLang->parameterID' AND 
				IFNULL(langID, 0) = '$oParameterLang->langID'
		";
		$result=parent::GetResult($query);
        $commit=(parent::fetchScalar($result)>0) ? self::Update_ParameterLang($oParameterLang) : self::AddNew_ParameterLang($oParameterLang);
		return $commit;
	}

	
	
	public static function  AddNew_ParameterLang($oParameterLang){
		
		//Insert data to table
		$query = "INSERT INTO cms_parameter_lang(parameterID, langID, parameterName, description, attribute, active)
				VALUES('$oParameterLang->parameterID', 1, '$oParameterLang->parameterName', '$oParameterLang->description', '".XMLParser::ParseArray($oParameterLang->attribute)."', '$oParameterLang->active')";
		
		return parent::Execute($query);
	}

	public static function  Update_ParameterLang($oParameterLang){
		//Update data to table
		$query = "UPDATE cms_parameter_lang SET 
					parameterName			='$oParameterLang->parameterName',
					description		='$oParameterLang->description',
					attribute		='".XMLParser::ParseArray($oParameterLang->attribute)."',
					active			='$oParameterLang->active'
				WHERE 
					parameterID		=$oParameterLang->parameterID AND
					langID			=$oParameterLang->langID";
		return parent::Execute($query);
	}

	public static function  Delete($oParameterLang){
		$oParameter=new eCmsParameter($oParameterLang->parameterID, $oParameterLang->groupID, $oParameterLang->parameterName, $oParameterLang->position);
		$query = "DELETE FROM cms_parameter_lang 
				WHERE parameterID= '$oParameterLang->parameterID'";
		if(parent::Execute($query))
			return CmsParameter::Delete($oParameter);
		else
			return false;
	}
	
	public static function  getmoduleID($groupID){
		switch($groupID){
			case 1: $moduleID=15;break;
			case 2: $moduleID=16;break;
			case 3: $moduleID=17;break;
			default:$moduleID=0;break;
		}
		return $moduleID;
	}

}

?>