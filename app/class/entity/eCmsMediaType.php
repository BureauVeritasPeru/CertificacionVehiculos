<?php
	/**
	 * Object represents table 'cms_media_type'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-09 20:46	 
	 */
	class eCmsMediaType{
		
		var $typeID;
		var $typeName;
		var $allowed;
		var $active;

		public function __construct($typeID=null, $typeName=null, $allowed=null, $active=null)
		{
			$this->typeID 		= $typeID;
			$this->typeName 	= $typeName;
			$this->allowed 		= $allowed;
			$this->active		= $active;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>