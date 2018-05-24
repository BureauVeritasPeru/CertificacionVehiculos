<?php
require_once("base/Database.php");

class CmsSectionLang extends Database
{
	var $mediaList;
	var $paramList;
	var $metaList;

	public static function  getItem($sectionID, $langID){
		$query = "
		SELECT 
			sec.sectionID, slan.langID, slan.title, slan.subTitle, slan.description, slan.resumen, slan.media, slan.parameter, slan.metaTag, slan.showContent, slan.staticURL, sec.parentSectionID, sec.sectionName, sec.position, sec.isEditable, slan.active
		FROM 
			cms_section AS sec
		LEFT JOIN cms_section_lang AS slan
			ON slan.sectionID=sec.sectionID
			AND IFNULL(slan.langID, 0)  = '$langID'
		WHERE
			sec.sectionID = '$sectionID'
		";

		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getWebItem($sectionID, $langID){
		$query = "
		SELECT 
			sec.sectionID, slan.langID, slan.title, slan.subTitle, slan.description, slan.resumen, slan.media, slan.parameter, slan.metaTag, slan.showContent, slan.staticURL, sec.parentSectionID, sec.sectionName, sec.position, sec.isEditable, slan.active
		FROM 
			cms_section AS sec
		LEFT JOIN cms_section_lang AS slan
			ON slan.sectionID=sec.sectionID
			AND IFNULL(slan.langID, 0) = '$langID'
		WHERE
			sec.sectionID = '$sectionID' 
		";

		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getWebItem_StaticURL($staticURL){
		$query = "
		SELECT 
			sec.sectionID, slan.langID, slan.title, slan.subTitle, slan.description, slan.resumen, slan.media, slan.parameter, slan.metaTag, slan.showContent, slan.staticURL, sec.parentSectionID, sec.sectionName, sec.position, sec.isEditable, slan.active
		FROM 
			cms_section AS sec
		LEFT JOIN cms_section_lang AS slan
			ON slan.sectionID=sec.sectionID
		WHERE
			slan.staticURL = '$staticURL' 
		";

		return parent::GetObject(parent::GetResult($query));
	}
	
	public static function  getList($langID){
		$query ="
		SELECT 
			sec.sectionID, slan.langID, slan.title, slan.subTitle, slan.description, slan.resumen, slan.media, slan.parameter, slan.metaTag, slan.showContent, slan.staticURL, sec.parentSectionID, sec.sectionName, sec.position, sec.isEditable, slan.active
		FROM 
			cms_section AS sec
		LEFT JOIN cms_section_lang AS slan
			ON slan.sectionID=sec.sectionID
			AND IFNULL(slan.langID, 0) 		= '$langID'
		";
		
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getWebList($parentSectionID, $langID){
		$query ="
		SELECT 
			sec.sectionID, slan.langID, slan.title, slan.subTitle, slan.description, slan.resumen, slan.media, slan.parameter, slan.metaTag, slan.showContent, slan.staticURL, sec.parentSectionID, sec.sectionName, sec.position, sec.isEditable, slan.active
		FROM 
			cms_section AS sec
		LEFT JOIN cms_section_lang AS slan
			ON slan.sectionID=sec.sectionID
			AND IFNULL(slan.langID, 0)      ='$langID'
		WHERE
			slan.active = '1' AND
			IFNULL(sec.parentSectionID, 0)  ='$parentSectionID'
		";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  Update($oSectionLang){
	
		$query = "
		SELECT COUNT(*) FROM cms_section_lang
		WHERE
			sectionID 					= '$oSectionLang->sectionID'
			AND IFNULL(langID, 0) 		= '$oSectionLang->langID'
		";
		$result=parent::GetResult($query);
        if(parent::fetchScalar($result)>0){
			//Update data to table
			$query = "UPDATE cms_section_lang SET 
						title		='$oSectionLang->title',
						subTitle	='$oSectionLang->subTitle',
						description ='$oSectionLang->description',
						resumen		='$oSectionLang->resumen',
						media		='".XMLParser::ParseArray($oSectionLang->media)."',
						parameter	='".XMLParser::ParseArray($oSectionLang->parameter)."',
						metaTag		='".XMLParser::ParseArray($oSectionLang->metaTag)."',
						showContent	='$oSectionLang->showContent',
						staticURL	=fcms_parseUrlName('$oSectionLang->staticURL'),
						active		='$oSectionLang->active'
					WHERE 
						sectionID	='$oSectionLang->sectionID' AND
						langID		='$oSectionLang->langID'";
			return parent::Execute($query);
		}
		else
			return self::AddNew_SectionLang($oSectionLang);

	}

	public static function  AddNew_SectionLang($oSectionLang){
		//Insert data to table
		$query = "INSERT INTO cms_section_lang (sectionID, langID, title, description, resumen, media, parameter, metaTag, showContent, staticURL, active)
					VALUES ('$oSectionLang->sectionID','$oSectionLang->langID','$oSectionLang->title','$oSectionLang->description','$oSectionLang->resumen','".XMLParser::ParseArray($oSectionLang->media)."','".XMLParser::ParseArray($oSectionLang->parameter)."','".XMLParser::ParseArray($oSectionLang->metaTag)."','$oSectionLang->showContent', fcms_parseUrlName('$oSectionLang->staticURL'), '$oSectionLang->active')
		";
		return parent::Execute($query);
	}
	
	/**/
	public static function getWebListParam($p){
		$query = "
		SELECT 
			sec.sectionID, slan.title";
		
		if( isset( $p['fields'] ) && $p['fields']!='' )	
			$query .="," . $p['fields'] ;

		$query .="
		FROM 
			cms_section AS sec
		LEFT JOIN cms_section_lang AS slan
			ON slan.sectionID=sec.sectionID";

		if( isset( $p['langID'] ) && $p['langID']!='' )	
			$query .=" AND IFNULL(slan.langID, 0) = '" . $p['langID'] . "'";

		$query .=
		"WHERE
			slan.active ='1' 
			and sec.isEditable =1";

		if( isset( $p['sectionsID'] ) && $p['sectionsID']!='' )	
			$query .=" AND sec.sectionID in (" . $p['sectionsID'] . ")";

//echo $query;
		return parent::GetCollection(parent::GetResult($query));
	}
}
?>