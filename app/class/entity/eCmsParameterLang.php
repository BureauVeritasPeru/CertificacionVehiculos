<?php
	/**
	 * Object represents table 'parameter_lang'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eCmsParameterLang{
		
		public $parameterID;
		public $langID;
		public $parameterName;
		public $description;
		public $attribute;
		public $active;

		public $parentParameterID;
		public $groupID;
		public $position;
		
		public $nullValue;

		public function __construct($parameterID=null, $langID=null, $parameterName=null, $description=null, $attribute=null, $active=null)
		{
			$this->parameterID 	= $parameterID;
			$this->langID 		= $langID;
			$this->parameterName= $parameterName;
			$this->description 	= $description;
			$this->attribute 	= $attribute;
			$this->active 		= $active;
			
			return $this;
		}

		public function append($groupID, $position)
		{
			//Aditional parameters to load list
			$this->groupID		= $groupID;
			$this->position		= $position;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>