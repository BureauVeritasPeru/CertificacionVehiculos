<?php
	/**
	 * Object represents table 'cms_content_media'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-09 20:46	 
	 */
	class eCmsMediaLang{
		
		var $mediaID;
		var $langID;
		var $title;
		var $alt;
		var $description;

		var $groupID;
		var $mediaType;
		var $groupName;
		var $basePath;
		var $mediaName;
		
		public function __construct($mediaID=null, $langID=null, $title=null, $alt=null, $description=null)
		{
			$this->mediaID 		= $mediaID;
			$this->langID 		= $langID;
			$this->title 		= $title;
			$this->alt 			= $alt;
			$this->description	= $description;
			
		}

		public function append($groupID=null, $mediaType=null, $groupName=null, $basePath=null, $mediaName=null)
		{
			$this->groupID 		= $groupID;
			$this->mediaType 	= $mediaType;
			$this->groupName 	= $groupName;
			$this->basePath 	= $basePath;
			$this->mediaName 	= $mediaName;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>