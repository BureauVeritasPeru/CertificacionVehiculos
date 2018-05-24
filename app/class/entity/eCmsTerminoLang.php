<?php
	/**
	 * Object represents table 'termino_lang'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eCmsTerminoLang{
		
		public $terminoID;
		public $langID;
		public $terminoName;
		public $description;
		public $attribute;
		public $active;

		public $groupID;
		public $alias;
		public $varName;
		public $inputType;
		
		public $nullValue;

		public function __construct($terminoID=null, $langID=null, $terminoName=null, $description=null, $attribute=null, $active=null)
		{
			$this->terminoID 	= $terminoID;
			$this->langID 		= $langID;
			$this->terminoName= $terminoName;
			$this->description 	= $description;
			$this->attribute 	= $attribute;
			$this->active 		= $active;
			
			return $this;
		}

		public function append($groupID, $varName, $inputType)
		{
			//Aditional terminos to load list
			$this->groupID		= $groupID;
			$this->varName		= $varName;
			$this->inputType	= $inputType;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>