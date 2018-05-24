<?php
require_once("base/Database.php");

class CmsScheme extends Database
{
	public static function getItem($schemeID){
		$oItem=null;
		$query = "
		SELECT sch.schemeID, sch.parentSchemeID, sch.sectionID, sch.templateID, sch.iterations, sch.position, sch.publication, sch.isPage, sch.active, 
		tpl.templateName, tpl.imgIcon, tpl.admSource, tpl.webSource, IFNULL(sch.alias, tpl.alias) AS alias, tpl.comments, fcms_childScheme(sch.schemeID) AS childScheme
		FROM    cms_scheme AS sch
		INNER JOIN cms_template AS tpl
			ON sch.templateID = tpl.templateID
		WHERE   
			sch.schemeID='$schemeID'
		ORDER BY sch.position
		";
            return parent::GetObject(parent::GetResult($query));
	}

	public static function getList($parentSchemeID, $sectionID){
		$query ="
		SELECT sch.schemeID, sch.parentSchemeID, sch.sectionID, sch.templateID, sch.iterations, sch.position, sch.publication, sch.isPage, sch.active,
		tpl.templateName, tpl.imgIcon, tpl.admSource, tpl.webSource, IFNULL(sch.alias, tpl.alias) AS alias, tpl.comments, fcms_childScheme(sch.schemeID) AS childScheme
		FROM    cms_scheme AS sch
		INNER JOIN cms_template AS tpl
			ON sch.templateID = tpl.templateID
		WHERE   
			IFNULL(sch.parentSchemeID,0) = '$parentSchemeID'
                        AND sch.sectionID = '$sectionID'
                        AND sch.active = 1
		ORDER BY sch.position
		";
            return parent::GetCollection(parent::GetResult($query));
	}

	
}

?>