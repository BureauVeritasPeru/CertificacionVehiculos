<?php
require_once("base/Database.php");

class CmsContentLang extends Database
{
	var $mediaList;
	var $paramList;
	var $metaList;

	public static function  getItem($contentID, $langID){
		$query = "
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.description3, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, sch.isPage, fcms_childSchema(cont.schemaID) AS childSchema
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0) = '$langID'
		WHERE
			cont.contentID 	= '$contentID'
		";

		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getWebItem($contentID, $langID){
		$query = "
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.description3, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, sch.isPage
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0)  = '$langID'
		WHERE
			cont.contentID 	= '$contentID' AND
			clan.active = 1
		";

		return parent::GetObject(parent::GetResult($query));
	}


	public static function  getWebItem_StaticURL($staticURL){
		$query = "
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.description3, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, sch.isPage
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
		WHERE
			clan.staticURL	= '$staticURL' AND
			clan.active		= 1
		";

		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList($parentContentID, $sectionID, $langID){
		$query ="
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.description3, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, sch.isPage
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0)  = '$langID'
		WHERE
				sch.sectionID       = '$sectionID'
			AND IFNULL(cont.parentContentID,0)  = '$parentContentID'
		ORDER BY
			cont.position
		";
		
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging($parentContentID, $sectionID, $langID, $filter=NULL){
		$query ="
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, fcms_childSchema(cont.schemaID) AS childSchema, fcms_childContentLang(cont.contentID, clan.langID) AS childContentLang
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0) 		= '$langID'
		WHERE
				sch.sectionID 					= '$sectionID'
			AND IFNULL(cont.parentContentID,0)	= '$parentContentID'
		";
		if(isset($filter)) $query .=" AND clan.title LIKE '%$filter%'";

		if(self::$orderBy=="") self::$orderBy="cont.position ASC";

		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function getWebList($parentContentID, $sectionID, $langID, $orderBy=NULL, $showInHome=false){
		$query ="
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, sch.isPage
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0) = '$langID'
		WHERE
				sch.sectionID   = '$sectionID'
			AND IFNULL(cont.parentContentID,0)  = '$parentContentID'
			AND IFNULL(clan.active, 0)  = '1'
			".(($showInHome)?"AND IFNULL(clan.showInHome, 0)    = '$showInHome'": "")."
		ORDER BY
			".(($orderBy!=NULL)? $orderBy: "cont.position")."
		";

		return parent::GetCollection(parent::GetResult($query));
	}
        public static function getWebListTiendas($parentContentID, $sectionID, $langID, $orderBy=NULL, $showInHome=false,$region=null){
		$query ="
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, sch.isPage
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0) = '$langID'
		WHERE
				sch.sectionID   = '$sectionID'
			AND IFNULL(cont.parentContentID,0)  = '$parentContentID'
			AND IFNULL(clan.active, 0)  = '1'
                        ".($region!=''? " AND ExtractValue(clan.parameter, '//root/ListItem[@Alias = \"region\"]/@Value')='$region'" :"")."
			".(($showInHome)?"AND IFNULL(clan.showInHome, 0)    = '$showInHome'": "")."
		ORDER BY
			".(($orderBy!=NULL)? $orderBy: "cont.position")."
		";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function getWebList_Menu($parentContentID, $sectionID, $langID){
		$query ="
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, sch.isPage
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0)  = '$langID'
		WHERE
				sch.sectionID   = '$sectionID'
			AND IFNULL(cont.parentContentID,0)  = '$parentContentID'
			AND IFNULL(clan.active, 0)      = '1'
			AND sch.isPage                  = '1'
		ORDER BY
			cont.position";

		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function getWebListSections($langID){
		$query ="SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, sch.isPage
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0) = '$langID'
		WHERE
				sch.sectionID   = '$sectionID'
			AND IFNULL(cont.parentContentID,0)  = '$parentContentID'
			AND IFNULL(clan.active, 0)          = '1'
		ORDER BY
			cont.position
		";
		
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getWebList_Paging($parentContentID, $sectionID, $langID, $orderBy=NULL, $showInHome=false){
		$query ="
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0) = '$langID'
		WHERE
				sch.sectionID = '$sectionID'
			AND IFNULL(cont.parentContentID,0) = '$parentContentID'
			AND IFNULL(clan.active, 0)  = '1'
			".(($showInHome)?"AND IFNULL(clan.showInHome, 0) = '$showInHome'": "")."
		ORDER BY
			".(($orderBy!=NULL)? $orderBy: "cont.position")."
		";
		
		return parent::GetCollection(parent::GetResultPaging($query,5));
	}

	public static function  getWebList_Template($templateID, $sectionID, $langID, $orderBy=NULL, $showInHome=false){
		$query ="
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, sch.isPage
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0)  = '$langID'
		WHERE
				sch.sectionID = '$sectionID'
			AND IFNULL(sch.templateID,0) = '$templateID'
			AND IFNULL(clan.active, 0)		= '1'
			".(($showInHome)?"AND IFNULL(clan.showInHome, 0) = '$showInHome'": "")."
		ORDER BY
			".(($orderBy!=NULL)? $orderBy: "cont.position")."
		";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getWebList_ParentTemplate($parentTemplateID, $sectionID, $langID, $orderBy=NULL, $showInHome=false){
		$query ="
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, sch.isPage
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0) = '$langID'
		WHERE
				sch.sectionID = '$sectionID'
			AND IFNULL(cont.parentContentID,0)  IN (SELECT contentID FROM cms_content AS c INNER JOIN cms_schema AS q WHERE q.schemaID=c.schemaID AND q.templateID='$parentTemplateID' AND q.sectionID='$sectionID')
			AND IFNULL(clan.active, 0)  = '1'
			".(($showInHome)?"AND IFNULL(clan.showInHome, 0)    = '$showInHome'": "")."
		ORDER BY
			".(($orderBy!=NULL)? $orderBy: "cont.position")."
		";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getWebList_Template_ParentSection($templateID, $parentSectionID, $langID){
		$query ="
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, sch.isPage
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		INNER JOIN cms_section AS sec
			ON sch.sectionID=sec.sectionID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0)  = '$langID'
		WHERE
				sec.parentSectionID = '$parentSectionID'
			AND IFNULL(sch.templateID,0) = '$templateID'
			AND IFNULL(clan.active, 0)  = '1'
		ORDER BY
			cont.position
		";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getWebList_Schema($schemaID, $langID){
		$query ="
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, sch.isPage
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0) = '$langID'
		WHERE
                        sch.schemaID = '$schemaID'
			AND IFNULL(clan.active, 0)  = '1'
		ORDER BY
			cont.position
		";

		return parent::GetCollection(parent::GetResult($query));
	}

    public static function  getList_Widgets($langID, $sectionID){
		$query ="
		SELECT 
			cont.contentID, clan.langID, CONCAT(IFNULL(slan.title, sec.sectionName), fcms_pathContent(cont.contentID, clan.langID)) AS title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active
			FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		INNER JOIN cms_section AS sec
			ON sec.sectionID=sch.sectionID
		LEFT JOIN cms_section_lang AS slan
			ON slan.sectionID=sch.sectionID
			AND IFNULL(slan.langID, 0) = '$langID'
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0)  = '$langID'
		WHERE
			sch.isPage = '1' AND
                        sec.sectionID = '$sectionID'
		ORDER BY
			sec.sectionID,
			cont.parentContentID,
			cont.position
		";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getWebList_ArrayID($contentIDs, $langID){
		$query ="
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID, sch.isPage
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0) = '$langID'
		WHERE
				cont.contentID IN ($contentIDs)
			AND IFNULL(clan.active, 0)  = '1'
		ORDER BY
			cont.position
		";

		return parent::GetCollection(parent::GetResult($query));
	}

	/***************************************************************************************************************************************************/
	public static function  getList_All($langID){

		$query ="
		SELECT 
			cont.contentID, clan.langID, CONCAT(IFNULL(slan.title, sec.sectionName), fcms_pathContent(cont.contentID, clan.langID)) AS title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active
			FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		INNER JOIN cms_section AS sec
			ON sec.sectionID=sch.sectionID
		LEFT JOIN cms_section_lang AS slan
			ON slan.sectionID=sch.sectionID
			AND IFNULL(slan.langID, 0) = '$langID'
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0)  = '$langID'
		WHERE
			sch.isPage = '1'
		ORDER BY
			sec.sectionID,
			cont.parentContentID,
			cont.position
		";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getCount_ChildSchema($schemaID, $parentContentID, $langID){
		$query ="
                SELECT COUNT(*) as cntContent
                FROM 
                        cms_content AS cont
                INNER JOIN cms_schema AS schm
                        ON cont.schemaID=schm.schemaID
                INNER JOIN cms_content_lang AS clan
                        ON cont.contentID=clan.contentID
                WHERE
                            cont.schemaID = '$schemaID'
                        AND IFNULL(cont.parentContentID,0) = '$parentContentID'
                        AND clan.langID = '$langID'
                ";
		
		return ($row = parent::fetchArray(parent::GetResult($query))) ? $row[0] : 0;
	}
	/***************************************************************************************************************************************************/
	
	public static function  AddNew($oContentLang){
		$oContent=new eCmsContent(0, $oContentLang->parentContentID, $oContentLang->schemaID, $oContentLang->title, 0);
		$oContent->append($oContentLang->sectionID);
		if(CmsContent::AddNew($oContent)){
			$oContentLang->contentID=$oContent->contentID;
			return self::AddNew_ContentLang($oContentLang);
		}
		
		return false;
	}
	
	public static function  Update($oContentLang){
		//Validate if exists
		$query = "
                SELECT COUNT(*) FROM cms_content_lang
                WHERE contentID = '$oContentLang->contentID' AND 
                        IFNULL(langID, 0) = '$oContentLang->langID'
		";
		$result=parent::GetResult($query);
        $commit=(parent::fetchScalar($result)>0) ? self::Update_ContentLang($oContentLang) : self::AddNew_ContentLang($oContentLang);
		return $commit;
	}

	public static function  Delete($oContentLang){
		$oContent=new eCmsContent($oContentLang->contentID, $oContentLang->parentContentID, $oContentLang->schemaID, $oContentLang->contentName, $oContentLang->position);
		$query = "DELETE FROM cms_content_lang 
				WHERE contentID= '$oContentLang->contentID' AND IFNULL(langID, 0)= '$oContentLang->langID'";
		if(parent::Execute($query))
			return CmsContent::Delete($oContent);
		else
			return false;
	}

	public static function  AddNew_ContentLang($oContentLang){
		//Parse qoutes, slashes
		TextParser::ParseEntityQuotes($oContentLang);

		$query = "CALL cms_contentlang_insert('$oContentLang->contentID', '$oContentLang->langID', '$oContentLang->title', '$oContentLang->subTitle', '$oContentLang->subTitle2', '$oContentLang->description', '$oContentLang->description2', '$oContentLang->description3', '$oContentLang->resumen', '$oContentLang->date', '$oContentLang->linkType', '$oContentLang->linkContentID', '$oContentLang->linkURL', '$oContentLang->linkTarget', '$oContentLang->staticURL', '".XMLParser::ParseArray($oContentLang->media)."', '".XMLParser::ParseArray($oContentLang->parameter)."', '".XMLParser::ParseArray($oContentLang->metaTag)."', '$oContentLang->showInHome', '$oContentLang->active')";
		return parent::Execute($query);
	}

	public static function  Update_ContentLang($oContentLang){
		//Parse qoutes, slashes
		TextParser::ParseEntityQuotes($oContentLang);

		//Update data to table
		$query = "CALL cms_contentlang_update('$oContentLang->contentID', '$oContentLang->langID', '$oContentLang->title', '$oContentLang->subTitle', '$oContentLang->subTitle2', '$oContentLang->description', '$oContentLang->description2', '$oContentLang->description3', '$oContentLang->resumen', '$oContentLang->date', '$oContentLang->linkType', '$oContentLang->linkContentID', '$oContentLang->linkURL', '$oContentLang->linkTarget', '$oContentLang->staticURL', '".XMLParser::ParseArray($oContentLang->media)."', '".XMLParser::ParseArray($oContentLang->parameter)."',  '".XMLParser::ParseArray($oContentLang->metaTag)."', '$oContentLang->showInHome', '$oContentLang->active');";
		return parent::Execute($query);
	}
	

	/*
	* Modulo: Glosario
	* Primer caracter del campo title
	*/
	public static function getWebList_Glosario($parentContentID, $sectionID, $langID, $letter){
		$query ="
		SELECT 
			cont.contentID, clan.langID, clan.title, clan.subTitle, clan.subTitle2, clan.description, clan.description2, clan.resumen, clan.date, clan.linkType, clan.linkContentID, clan.linkURL, clan.linkTarget, clan.staticURL, clan.media, clan.parameter, clan.metaTag, clan.registerDate, clan.showInHome, clan.active, 
			cont.parentContentID, cont.schemaID, cont.contentName, cont.position, sch.sectionID, sch.templateID
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0) = '$langID'
		WHERE
				sch.sectionID = '$sectionID'
			AND IFNULL(cont.parentContentID,0) = '$parentContentID'
			AND IFNULL(clan.active, 0) = '1'
			AND clan.title LIKE '$letter%'
		ORDER BY
			cont.position";

		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function getWebList_Letter($parentContentID, $sectionID, $langID){
		$query ="
		SELECT 
                        LEFT(clan.title,1) as letter
		FROM 
			cms_content AS cont
		INNER JOIN cms_schema AS sch
			ON sch.schemaID=cont.schemaID
		LEFT JOIN cms_content_lang AS clan
			ON clan.contentID=cont.contentID
			AND IFNULL(clan.langID, 0)  = '$langID'
		WHERE
				sch.sectionID  = '$sectionID'
			AND IFNULL(cont.parentContentID,0)  = '$parentContentID'
			AND IFNULL(clan.active, 0)  = '1'
		GROUP BY
			LEFT(clan.title,1)
		ORDER BY
			cont.position";

		$arrLetter =array();
		$result=parent::GetResult($query);
		while($row = parent::fetchArray($result)){
			$arrLetter[] =TextParser::UpperCase($row['letter']);
        }

		return $arrLetter;
	}

}
?>