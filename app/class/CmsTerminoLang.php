<?php
require_once("base/Database.php");

class CmsTerminoLang extends Database
{

	public static function  getItem($terminoID, $langID){
		$query = "SELECT term.terminoID, term.groupID, tlan.langID, term.alias, IF(tlan.terminoName IS null, term.alias, tlan.terminoName) AS terminoName, term.varName, term.inputType, IF(tlan.terminoName IS null, 1, 0) AS nullValue
		FROM cms_termino AS term
		LEFT JOIN cms_termino_lang AS tlan
			ON tlan.terminoID=term.terminoID
			AND IFNULL(tlan.langID, 0) = '$langID'
		WHERE term.terminoID='$terminoID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList($groupID, $langID){
		$query = "SELECT term.terminoID, term.groupID, tlan.langID, term.alias, IF(tlan.terminoName IS null, term.alias, tlan.terminoName) AS terminoName, term.varName, term.inputType, IF(tlan.terminoName IS null, 1, 0) AS nullValue
		FROM cms_termino AS term
		LEFT JOIN cms_termino_lang AS tlan
			ON tlan.terminoID=term.terminoID
			AND IFNULL(tlan.langID, 0) = '$langID'
		WHERE term.groupID='$groupID'
		ORDER BY term.alias";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging($groupID, $langID){
		$query = "SELECT term.terminoID, term.groupID, tlan.langID, term.alias, IF(tlan.terminoName IS null, term.alias, tlan.terminoName) AS terminoName, term.varName, term.inputType, IF(tlan.terminoName IS null, 1, 0) AS nullValue
		FROM cms_termino AS term
		LEFT JOIN cms_termino_lang AS tlan
			ON tlan.terminoID=term.terminoID
			AND IFNULL(tlan.langID, 0) = '$langID'
		WHERE term.groupID='$groupID'
		";
		if(self::$orderBy=="") self::$orderBy="term.alias ASC";
		
		return parent::GetCollection(parent::GetResultPaging($query));
	}
	
	public static function  getWebList($groupID, $langID){
		$query = "SELECT term.terminoID, term.groupID, tlan.langID, term.alias, IF(tlan.terminoName IS null, term.alias, tlan.terminoName) AS terminoName, term.varName, term.inputType, IF(tlan.terminoName IS null, 1, 0) AS nullValue
		FROM cms_termino AS term
		LEFT JOIN cms_termino_lang AS tlan
			ON tlan.terminoID=term.terminoID
			AND IFNULL(tlan.langID, 0) = '$langID'
		WHERE term.groupID='$groupID'
		ORDER BY term.alias";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oTerminoLang){
		$oTermino=new eCmsTermino(0, $oTerminoLang->groupID, $oTerminoLang->terminoName, $oTerminoLang->varName, $oTerminoLang->inputType);
		if(CmsTermino::AddNew($oTermino)){
			$oTerminoLang->terminoID=$oTermino->terminoID;
			return self::AddNew_TerminoLang($oTerminoLang);
		}
		
		return false;
	}
	
	public static function  Update($oTerminoLang){
		//Validate if exists
		$query = "
			SELECT COUNT(*) FROM cms_termino_lang
			WHERE terminoID = '$oTerminoLang->terminoID' AND 
				IFNULL(langID, 0) = '$oTerminoLang->langID'
		";
		$result=parent::GetResult($query);
        $commit=(parent::fetchScalar($result)>0) ? self::Update_TerminoLang($oTerminoLang) : self::AddNew_TerminoLang($oTerminoLang);
		return $commit;
	}

	
	
	public static function  AddNew_TerminoLang($oTerminoLang){
		//Insert data to table
		$query = "INSERT INTO cms_termino_lang(terminoID, langID, terminoName)
				VALUES('$oTerminoLang->terminoID', '$oTerminoLang->langID', '$oTerminoLang->terminoName')";
		
		return parent::Execute($query);
	}

	public static function  Update_TerminoLang($oTerminoLang){
		//Update data to table
		$query = "UPDATE cms_termino_lang SET 
					terminoName		='$oTerminoLang->terminoName'
				WHERE 
					terminoID		='$oTerminoLang->terminoID' AND
					langID			='$oTerminoLang->langID'";
		return parent::Execute($query);
	}

	public static function  Delete($oTerminoLang){
		$oTermino=new eCmsTermino($oTerminoLang->terminoID, $oTerminoLang->groupID, $oTerminoLang->terminoName, $oTerminoLang->varName, $oTerminoLang->inputType);
		$query = "DELETE FROM cms_termino_lang 
				WHERE terminoID= '$oTerminoLang->terminoID'";
		if(parent::Execute($query))
			return CmsTermino::Delete($oTermino);
		else
			return false;
	}

}

?>