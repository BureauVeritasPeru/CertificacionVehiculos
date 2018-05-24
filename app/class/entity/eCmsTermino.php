<?php
	/**
	 * Object represents table 'termino'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-04-07 16:59	 
	 */
	class eCmsTermino{
		
		public $terminoID;
		public $groupID;
		public $alias;
		public $varName;
		public $inputType;

		public function __construct($terminoID=null, $groupID=null, $alias=null, $varName=null, $inputType=null)
		{
			$this->terminoID 	= $terminoID;
			$this->groupID 		= $groupID;
			$this->alias 		= $alias;
			$this->varName		= $varName;
			$this->inputType	= $inputType;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
?>