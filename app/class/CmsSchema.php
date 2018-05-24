<?php
require_once("base/Database.php");

class CmsSchema extends Database
{
	public static function getItem($schemaID){
		$oItem=null;
		$query = "
		SELECT sch.schemaID, sch.parentSchemaID, sch.sectionID, sch.templateID, sch.iterations, sch.position, sch.publication, sch.isPage, sch.active, 
		tpl.templateName, tpl.imgIcon, tpl.admSource, tpl.webSource, IFNULL(sch.alias, tpl.alias) AS alias, tpl.comments, fcms_childSchema(sch.schemaID) AS childSchema
		FROM    cms_schema AS sch
		INNER JOIN cms_template AS tpl
			ON sch.templateID = tpl.templateID
		WHERE   
			sch.schemaID='$schemaID'
		ORDER BY sch.position
		";
            return parent::GetObject(parent::GetResult($query));
	}

	public static function getList($parentSchemaID, $sectionID){
		$query ="
		SELECT sch.schemaID, sch.parentSchemaID, sch.sectionID, sch.templateID, sch.iterations, sch.position, sch.publication, sch.isPage, sch.active,
		tpl.templateName, tpl.imgIcon, tpl.admSource, tpl.webSource, IFNULL(sch.alias, tpl.alias) AS alias, tpl.comments, fcms_childSchema(sch.schemaID) AS childSchema
		FROM    cms_schema AS sch
		INNER JOIN cms_template AS tpl
			ON sch.templateID = tpl.templateID
		WHERE   
			IFNULL(sch.parentSchemaID,0) = '$parentSchemaID'
                        AND sch.sectionID = '$sectionID'
                        AND sch.active = 1
		ORDER BY sch.position
		";
            return parent::GetCollection(parent::GetResult($query));
	}

	
}

?>