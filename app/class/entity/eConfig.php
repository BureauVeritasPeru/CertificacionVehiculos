<?php
	/**
	 * Object represents table 'config'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	 
	class eConfig{
		
		public $configID;
		public $description;
		public $inputType;
		public $varName;
		public $value;
		public $editable;

		public function __construct($configID=null, $description=null, $inputType=null, $varName=null, $value=null, $editable=null)
		{
			$this->configID 	= $configID;
			$this->description 	= $description;
			$this->inputType	= $inputType;
			$this->varName		= $varName;
			$this->value		= $value;
			$this->editable		= $editable;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>