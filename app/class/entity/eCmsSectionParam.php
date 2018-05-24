<?php
	/**
	 * Object represents table 'cms_section_param'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-09 20:46	 
	 */
	class eCmsSectionParam{
		
		var $sectionID;
		var $langID;
		var $key;
		var $value;
		var $position;

		public function __construct($sectionID=null, $langID=null, $key=null, $value=null, $position=null)
		{
			$this->sectionID 	= $sectionID;
			$this->langID 		= $langID;
			$this->key			= $key;
			$this->value 		= $value;
			$this->position 	= $position;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>