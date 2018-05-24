<?php
	/**
	 * Object represents table 'cms_lang'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eCmsLang{
		
		public $langID;
		public $langCode;
		public $langName;
		public $alias;
		public $isDefault;
		public $active;

		public function __construct($langID=null, $langCode=null, $langName=null, $alias=null, $isDefault=null, $active=null)
		{
			$this->langID 		= $langID;
			$this->langCode 	= $langCode;
			$this->langName 	= $langName;
			$this->alias 		= $alias;
			$this->isDefault 	= $isDefault;
			$this->active		= $active;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>