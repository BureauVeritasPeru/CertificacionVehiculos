<?php
	/**
	 * Object represents table 'cms_media'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-09 20:46	 
	 */
	class eCmsMedia{
		
		var $mediaID;
		var $groupID;
		var $mediaName;
		var $mediaType;
		var $registerDate;
		
		var $basePath;

		public function __construct($mediaID=null, $groupID=null, $mediaName=null, $mediaType=null, $registerDate=null)
		{
			$this->mediaID 		= $mediaID;
			$this->groupID 		= $groupID;
			$this->mediaName 	= $mediaName;
			$this->mediaType 	= $mediaType;
			$this->registerDate	= $registerDate;
		}

		public function append($basePath=null)
		{
			$this->basePath 	= $basePath;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>