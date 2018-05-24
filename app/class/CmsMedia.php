<?php
require_once("base/Database.php");

class CmsMedia extends Database
{

	public static function  getItem($mediaID){
		$query = "SELECT media.mediaID, media.groupID, media.mediaName, media.mediaType, media.registerDate, mgroup.basePath
				FROM cms_media AS media
				INNER JOIN cms_media_group AS mgroup
					ON mgroup.groupID=media.groupID
				WHERE media.mediaID='$mediaID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList($groupID){
		$query ="SELECT mediaID, groupID, mediaName, mediaType, registerDate
		FROM cms_media
		WHERE groupID='$groupID'
		ORDER BY mediaName";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  AddNew($oMedia){
		//Search the max Id
		$sql = "SELECT MAX(mediaID) FROM cms_media";
		$result = parent::GetResult($sql);
		$oMedia->mediaID = parent::fetchScalar($result)+1;
		$oMedia->mediaType=self::getMediaType($oMedia->mediaName);

		//Insert data to table
		$sql = "INSERT INTO cms_media(mediaID, groupID, mediaName, mediaType, registerDate)
				VALUES('$oMedia->mediaID', '$oMedia->groupID', '$oMedia->mediaName', '$oMedia->mediaType', NOW())";

		return parent::Execute($sql);
	}

	public static function  Delete($oMedia){

		//Delete item from table
		$sql = "DELETE FROM cms_media
				WHERE mediaID='$oMedia->mediaID'
				";

		return parent::Execute($sql);
	}
	
	public static function getArrayFileTypes(){
		$arrType=array(
			'image'		=> '*.gif;*.jpg;*.jpeg;*.png;*.bmp',
			'document'	=> '*.doc;*.docx;*.xls;*.xlsx;*.ppt;*.pptx;*.pps;*ppsx;*.pdf;*.txt',
			'animation'	=> '*.swf;*.fla',
			'web-file'	=> '*.html;*.asp;*.php;*.css;*.js;*.xml',
			'video'		=> '*.avi;*.flv;*.mpg;*.mpeg;*.mp4;*.mov;*.wmv',
			'audio'		=> '*.wav;*.mp3;*.asf;*.wma;*.aif',
			'zip-file'	=> '*.zip;*.rar;*.7z;*.tar;*.gzip'
		);
		return $arrType;
	}

	public static function getMediaType($mediaName){
	
		$mediaType	='unknown';

		$arrExts =  pathinfo(strtolower($mediaName)); 
		$fileExt = $arrExts['extension']; 
		$arrType=self::getArrayFileTypes();
	
		while ($ext = current($arrType)) {
			preg_match('/'.$fileExt.'/', $ext, $result);
			if(count($result)>0){
				$mediaType=key($arrType);
				break;
			}
			next($arrType);
		}

		return $mediaType;
	}
}

?>