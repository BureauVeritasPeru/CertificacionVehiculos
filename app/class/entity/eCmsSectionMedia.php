<?php
	/**
	 * Object represents table 'cms_section_media'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-09 20:46	 
	 */
	class eCmsSectionMedia{
		
		var $sectionID;
		var $mediaID;
		var $langID;
		var $position;
		var $reference;

		public function __construct($sectionID=null, $mediaID=null, $langID=null, $position=null, $reference=null)
		{
			$this->sectionID 	= $sectionID;
			$this->mediaID 		= $mediaID;
			$this->langID 		= $langID;
			$this->position 	= $position;
			$this->reference	= $reference;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}
		
	}
?>