<?php
require_once("base/Database.php");

class CmsMediaLang extends Database
{

	public static function  GetItem($mediaID, $langID){
		$query ="SELECT media.mediaID, '$langID' as langID, mlang.title, mlang.alt, mlang.description,
			mgroup.groupID, media.mediaType, mgroup.groupName, mgroup.basePath, media.mediaName
		FROM cms_media AS media
		INNER JOIN cms_media_group AS mgroup
			ON media.groupID=mgroup.groupID
		LEFT JOIN cms_media_lang AS mlang
			ON media.mediaID=mlang.mediaID AND mlang.langID='$langID'
		WHERE 
			media.mediaID ='$mediaID'
		ORDER BY mediaID";
		return parent::GetObject(parent::GetResult($query));
	}
	
	public static function  GetList($groupID, $langID){
		$query ="SELECT media.mediaID, mlang.langID, mlang.title, mlang.alt, mlang.description,
			mgroup.groupID, media.mediaType, mgroup.groupName, mgroup.basePath, media.mediaName
		FROM cms_media AS media
		INNER JOIN cms_media_group AS mgroup
			ON media.groupID=mgroup.groupID
		LEFT JOIN cms_media_lang AS mlang
			ON media.mediaID=mlang.mediaID AND mlang.langID='$langID'
		WHERE 
			mgroup.groupID ='$groupID'
		ORDER BY mediaID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  GetItem_Content($contentID, $langID, $alias){
		$query = "SELECT media.mediaID, '$langID' as langID, mlang.title, mlang.alt, mlang.description,
			mgroup.groupID, media.mediaType, mgroup.groupName, mgroup.basePath, media.mediaName 
		FROM cms_media AS media
		INNER JOIN cms_media_group AS mgroup
			ON media.groupID=mgroup.groupID
		LEFT JOIN cms_media_lang AS mlang
			ON media.mediaID=mlang.mediaID AND mlang.langID='$langID'
		WHERE 
			media.mediaID IN (SELECT ExtractValue(media, '//root/ListItem[@Alias = \"$alias\"]/@Value') AS mediaID
							FROM cms_content_lang WHERE contentID='$contentID')";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  GetList_ContentMedia($parentContentID, $langID, $alias){
		$query = "SELECT media.mediaID, '$langID' as langID, mlang.title, mlang.alt, mlang.description,
			mgroup.groupID, media.mediaType, mgroup.groupName, mgroup.basePath, media.mediaName 
		FROM cms_media AS media
		INNER JOIN cms_media_group AS mgroup
			ON media.groupID=mgroup.groupID
		LEFT JOIN cms_media_lang AS mlang
			ON media.mediaID=mlang.mediaID AND mlang.langID='$langID'
		WHERE 
			media.mediaID IN (SELECT ExtractValue(clan.media, '//root/ListItem[@Alias = \"$alias\"]/@Value') AS mediaID
							FROM cms_content_lang AS clan INNER JOIN cms_content AS cont ON cont.contentID=clan.contentID
							WHERE cont.parentContentID='$parentContentID')";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  GetList_ContentGallery($parentContentID, $langID, $alias){
		$query = "SELECT media.mediaID, clang.langID, clang.title, media.mediaName AS alt, clang.description,
			mgroup.groupID, media.mediaType, mgroup.groupName, mgroup.basePath, media.mediaName 
		FROM cms_media AS media
		INNER JOIN cms_content_lang AS clang
			ON media.mediaID = ExtractValue(clang.media, '//root/ListItem[@Alias = \"$alias\"]/@Value')
			AND clang.langID='$langID'
		INNER JOIN cms_media_group AS mgroup
			ON media.groupID=mgroup.groupID
		WHERE 
			clang.contentID IN (SELECT contentID FROM cms_content WHERE parentContentID='$parentContentID')";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  AddNew($oMediaLang){
		//Insert data to table
		$sql = "INSERT INTO cms_media_lang(mediaID, langID, title, alt, description)
				VALUES('$oMediaLang->mediaID', '$oMediaLang->langID', '$oMediaLang->title', '$oMediaLang->alt', '$oMediaLang->description')";

		return parent::Execute($sql);
	}

	public static function  Update($oMediaLang){
		//Insert data to table
		$sql = "UPDATE cms_media_lang
				SET 
					title		='$oMediaLang->title',
					alt			='$oMediaLang->alt',
					description	='$oMediaLang->description'
				WHERE 
					mediaID ='$oMediaLang->mediaID' AND
					langID='$oMediaLang->langID'";

		return parent::Execute($sql);
	}

	public static function  Delete($oMediaLang){
		//Delete item from table
		$sql = "DELETE FROM cms_media_lang
				WHERE mediaID='$oMediaLang->mediaID'";

		return parent::Execute($sql);
	}
}

?>