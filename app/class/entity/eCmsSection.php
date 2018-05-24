<?php
	/**
	 * Object represents table 'cms_section'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eCmsSection{
		
		public $sectionID;
		public $parentSectionID;
		public $sectionName;
		public $position;
		public $isEditable;

		public function __construct($sectionID=null, $parentSectionID=null, $sectionName=null, $position=null, $isMinisite=null, $isEditable=null)
		{
			$this->sectionID 		= $sectionID;
			$this->parentSectionID 	= $parentSectionID;
			$this->sectionName 		= $sectionName;
			$this->position 		= $position;
			$this->isEditable 		= $isEditable;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>