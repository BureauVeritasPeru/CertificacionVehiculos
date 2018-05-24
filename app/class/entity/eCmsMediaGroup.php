<?php
	/**
	 * Object represents table 'cms_media_group'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-09 20:46	 
	 */
	class eCmsMediaGroup{
		
		var $groupID;
		var $groupName;
		var $alias;
		var $typeID;
		var $basePath;
		var $active;

		public function __construct($groupID=null, $groupName=null, $alias=null, $typeID=null, $basePath=null, $active=null)
		{
			$this->groupID 		= $groupID;
			$this->groupName 	= $groupName;
			$this->alias 		= $alias;
			$this->typeID 		= $typeID;
			$this->basePath 	= $basePath;
			$this->active		= $active;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>